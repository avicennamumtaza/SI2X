<?php

namespace App\Http\Controllers;

use App\DataTables\PendudukDataTable;
use App\Enums\GolDar as GolDar;
use App\Enums\StatusPernikahan as StatusPernikahan;
use App\Enums\JenisKelamin as JenisKelamin;
use App\Enums\Agama as Agama;
use App\Enums\Pekerjaan as Pekerjaan;
use App\Enums\Pendidikan as Pendidikan;
use App\Models\Keluarga;
use App\Models\Penduduk;
use App\Models\RT;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PendudukController extends Controller
{
    public function list(PendudukDataTable $dataTable)
    {
        $no_rts = RT::pluck('no_rt');
        $nkks = Keluarga::pluck('nkk');
        $goldar = GolDar::cases();
        $sp = StatusPernikahan::cases();
        $agamas = Agama::cases();
        $jk = JenisKelamin::cases();
        $pekerjaans = Pekerjaan::cases();
        $pendidikans = Pendidikan::cases();

        return $dataTable->render('auth.rw.penduduk', compact('no_rts', 'nkks', 'goldar', 'pekerjaans', 'pendidikans', 'sp', 'jk', 'agamas'));
        // return $dataTable->render('auth.rw.penduduk', ['goldar' => GolDar::cases()]);
    }
    // public function edit(Penduduk $penduduk)
    // {
    //     $penduduk = Penduduk::findOrFail($penduduk->nik);
    //     return view('penduduk.edit', compact('penduduk'));
    // }
    public function show(Penduduk $penduduk)
    {
    $penduduk = Penduduk::find($penduduk->nik);

    //ubah nilai status_pendatang
    $penduduk->status_pendatang = $penduduk->status_pendatang == 0 ? 'domisili' : 'non domisili';

    // Hitung umur
    $tanggal_lahir = Carbon::parse($penduduk->tanggal_lahir);
    $umur = $tanggal_lahir->age;

    return view('penduduk.show', compact('penduduk', 'umur'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nik' => 'required|string|min:15|max:17|unique:penduduk,nik',
            'nkk' => 'required|string|min:15|max:17',
            'no_rt' => 'required|string|max:2',
            'nama' => 'required|string|max:49',
            'tempat_lahir' => 'required|string|min:2|max:49',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|min:5',
            'jenis_kelamin' => [Rule::enum(JenisKelamin::class)],
            'agama' => [Rule::enum(Agama::class)],
            'pendidikan' => [Rule::enum(Pendidikan::class)],
            'pekerjaan' => [Rule::enum(Pekerjaan::class)],
            // 'golongan_darah' => 'required|string|max:2',
            'golongan_darah' =>  [Rule::enum(GolDar::class)],
            'status_pernikahan' => [Rule::enum(StatusPernikahan::class)],
            'status_pendatang' => 'required',
            // Tambahkan validasi untuk input lainnya jika diperlukan
        ]);

        try {
            Penduduk::create([
                'nik' => $validated['nik'],
                'nkk' => $validated['nkk'],
                'no_rt' => $validated['no_rt'],
                'nama' => $validated['nama'],
                'tempat_lahir' => $validated['tempat_lahir'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'alamat' => $validated['alamat'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'agama' => $validated['agama'],
                'pendidikan' => $validated['pendidikan'],
                'pekerjaan' => $validated['pekerjaan'],
                'golongan_darah' => $validated['golongan_darah'],
                'status_pernikahan' => $validated['status_pernikahan'],
                'status_pendatang' => $validated['status_pendatang'],
            ]);
            return redirect()->back()->with('success', 'Data Penduduk berhasil ditambahkan!');
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->back();
        }
    }
    public function edit(Penduduk $penduduk)
    {
        $penduduk = Penduduk::findOrFail($penduduk->nik);
        return view('penduduk.edit', compact('penduduk'));
    }

    public function update(Request $request, Penduduk $penduduk)
    {

        $request->validate([
            'nik' => 'required|string|min:15|max:17|unique:penduduk,nik,' . $penduduk->nik . ',nik', // gbisa edit primary key
            'nkk' => 'required|string|min:15|max:17',
            'no_rt' => 'required|string|max:2',
            'nama' => 'required|string|max:49',
            'tempat_lahir' => 'required|string|min:2|max:49',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|min:5',
            'jenis_kelamin' => [Rule::enum(JenisKelamin::class)],
            'agama' => [Rule::enum(Agama::class)],
            'pendidikan' => [Rule::enum(Pendidikan::class)],
            'pekerjaan' => [Rule::enum(Pekerjaan::class)],
            'golongan_darah' =>  [Rule::enum(GolDar::class)],
            'status_pernikahan' => [Rule::enum(StatusPernikahan::class)],
            'status_pendatang' => 'required',
        ]);

        $penduduk->update($request->all());

        return redirect()->route('penduduk.manage')
            ->with('success', 'Penduduk berhasil diperbarui.');
    }

    public function destroy(Penduduk $penduduk)
    {
        $penduduk->delete();

        return redirect()->back()
            ->with('success', 'Penduduk berhasil dihapus.');
    }

    //impor csv
    public function import(Request $request)
    {

        $file = $request->file('file');

        if (!$file) {
            Alert::error('Error', 'File tidak ditemukan.');
            return redirect()->back();
        }

        $fileContents = file($file->getPathname());

        foreach ($fileContents as $key => $line) {
            try {
                $data = str_getcsv($line);

                // if (count($data) !== 14) {
                //     throw new \Exception('CSV tidak valid. Setiap baris harus memiliki 14 kolom.');
                // }

                // Validasi input per baris
                $validated = Validator::make([
                    'nik' => $data[0],
                    'nkk' => $data[1],
                    'no_rt' => $data[2],
                    'nama' => $data[3],
                    'tempat_lahir' => $data[4],
                    'tanggal_lahir' => $data[5],
                    'alamat' => $data[6],
                    'jenis_kelamin' => $data[7],
                    'agama' => $data[8],
                    'pendidikan' => $data[9],
                    'pekerjaan' => $data[10],
                    'golongan_darah' => $data[11],
                    'status_pernikahan' => $data[12],
                    'status_pendatang' => $data[13]
                ], [
                    'nik' => 'required|string|min:15|max:17|unique:penduduk,nik',
                    'nkk' => 'required|string|min:15|max:17',
                    'no_rt' => 'required|string|max:2',
                    'nama' => 'required|string|max:49',
                    'tempat_lahir' => 'required|string|min:2|max:49',
                    'tanggal_lahir' => 'required|date',
                    'alamat' => 'required|string|min:5',
                    'jenis_kelamin' => [Rule::enum(JenisKelamin::class)],
                    'agama' => [Rule::enum(Agama::class)],
                    'pendidikan' => [Rule::enum(Pendidikan::class)],
                    'pekerjaan' => [Rule::enum(Pekerjaan::class)],
                    'golongan_darah' => [Rule::enum(GolDar::class)],
                    'status_pernikahan' => [Rule::enum(StatusPernikahan::class)],
                    'status_pendatang' => 'required',
                ])->validate();

                // Jika validasi berhasil, buat entri baru di database
                Penduduk::create($validated);
            } catch (\Exception $e) {
                // Alert::error('Error', '. Pesan: ' . $e->getMessage());
                Alert::error('Kesalahan pada baris ' . $key+1 , '' . $e->getMessage());
                // Alert::error('Kesalahan pada baris ' . $key+1 , '' . function () {
                //     foreach ($e->getMessage() as $singleE) {
                //         $singleE;
                //     }
                // });
                return redirect()->back();
            }
        }

        return redirect()->back()->with('success', 'CSV berhasil diimpor.');
    }

    public function export()
    {
        $penduduk = Penduduk::all();
        $filename = 'penduduk.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, [
            'nik',
            'nkk',
            'no_rt',
            'nama',
            'tempat_lahir',
            'tanggal_lahir',
            'alamat',
            'jenis_kelamin',
            'agama',
            'pendidikan',
            'pekerjaan',
            'golongan_darah',
            'status_pernikahan',
            'status_pendatang'
            // Tambahkan kolom lagi jika diperlukan
        ]);

        foreach ($penduduk as $row) {
            fputcsv($handle, [
                $row->nik,
                $row->nkk,
                $row->no_rt,
                $row->nama,
                $row->tempat_lahir,
                $row->tanggal_lahir,
                $row->alamat,
                $row->jenis_kelamin->getDescription(),
                $row->agama->getDescription(),
                $row->pendidikan->getDescription(),
                $row->pekerjaan->getDescription(),
                $row->golongan_darah->getDescription(),
                $row->status_pernikahan->getDescription(),
                $row->status_pendatang
                // Tambahkan kolom lagi jika diperlukan
            ]);
        }

        fclose($handle);

    $headers = [
        'Content-Type' => 'text/csv',
    ];

        return Response::download($filename, 'penduduk.csv', $headers);
    }
}





    // //impor csv
    // public function import(Request $request)
    // {
    //     $file = $request->file('file');

    //     if (!$file) {
    //         Alert::error('Error', 'File tidak ditemukan.');
    //         return redirect()->back();
    //     }

    //     $fileContents = file($file->getPathname());

    //     foreach ($fileContents as $key => $line) {
    //         try {
    //             $data = str_getcsv($line);

    //             if (count($data) !== 14) {
    //                 throw new \Exception('CSV tidak valid. Setiap baris harus memiliki 14 kolom.');
    //             }

    //             // Validasi input per baris
    //             $validator = Validator::make([
    //                 'nik' => $data[0],
    //                 'nkk' => $data[1],
    //                 'no_rt' => $data[2],
    //                 'nama' => $data[3],
    //                 'tempat_lahir' => $data[4],
    //                 'tanggal_lahir' => $data[5],
    //                 'alamat' => $data[6],
    //                 'jenis_kelamin' => $data[7],
    //                 'agama' => $data[8],
    //                 'pendidikan' => $data[9],
    //                 'pekerjaan' => $data[10],
    //                 'golongan_darah' => $data[11],
    //                 'status_pernikahan' => $data[12],
    //                 'status_pendatang' => $data[13]
    //             ], [
    //                 'nik' => 'required|string|min:15|max:17|unique:penduduk,nik',
    //                 'nkk' => 'required|string|min:15|max:17',
    //                 'no_rt' => 'required|string|max:2',
    //                 'nama' => 'required|string|max:49',
    //                 'tempat_lahir' => 'required|string|min:2|max:49',
    //                 'tanggal_lahir' => 'required|date',
    //                 'alamat' => 'required|string|min:5',
    //                 'jenis_kelamin' => [Rule::enum(JenisKelamin::class)],
    //                 'agama' => [Rule::enum(Agama::class)],
    //                 'pendidikan' => [Rule::enum(Pendidikan::class)],
    //                 'pekerjaan' => [Rule::enum(Pekerjaan::class)],
    //                 // 'golongan_darah' => 'required|string|max:2',
    //                 'golongan_darah' =>  [Rule::enum(GolDar::class)],
    //                 'status_pernikahan' => [Rule::enum(StatusPernikahan::class)],
    //                 'status_pendatang' => 'required',
    //             ]);

    //             $validator->validate();

    //             // Jika validasi berhasil, buat entri baru di database
    //             Penduduk::create($validator->validated());
    //         } catch (\Exception $e) {
    //             $errors = $validator->errors()->all();
    //             $errorMessage = 'Kesalahan pada baris ' . ($key + 1) . ': ' . implode(', ', $errors);
    //             Alert::error('Error', $errorMessage);
    //             return redirect()->back();
    //         }
    //     }

    //     return redirect()->back()->with('success', 'CSV berhasil diimpor.');
    // }