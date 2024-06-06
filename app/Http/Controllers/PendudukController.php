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
use App\Models\Rt;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PendudukController extends Controller
{
    public function getLansia()
    {
        $date = \Carbon\Carbon::now()->subYears(66)->format('Y-m-d');
        $penduduk = Penduduk::where('tanggal_lahir', '<=', $date)->select(['nik', 'nama', 'tempat_lahir', 'tanggal_lahir'])->paginate(25);
        return view('auth.rw.ulansia', compact('penduduk'));
    }

    public function getProduktif()
    {
        $dateMin = \Carbon\Carbon::now()->subYears(65)->format('Y-m-d');
        $dateMax = \Carbon\Carbon::now()->subYears(15)->format('Y-m-d');
        $penduduk = Penduduk::whereBetween('tanggal_lahir', [$dateMin, $dateMax])->select(['nik', 'nama', 'tempat_lahir', 'tanggal_lahir'])->paginate(25);
        return view('auth.rw.uprod', compact('penduduk'));
    }

    public function getAnak()
    {
        $date = \Carbon\Carbon::now()->subYears(15)->format('Y-m-d');
        $penduduk = Penduduk::where('tanggal_lahir', '>', $date)->select(['nik', 'nama', 'tempat_lahir', 'tanggal_lahir'])->paginate(25);
        return view('auth.rw.uanak', compact('penduduk'));
    }

    public function list(PendudukDataTable $dataTable)
    {
        // $no_rts = Rt::pluck('no_rt');
        $nkks = Keluarga::pluck('nkk');
        $goldar = GolDar::cases();
        $sp = StatusPernikahan::cases();
        $agamas = Agama::cases();
        $jk = JenisKelamin::cases();
        $pekerjaans = Pekerjaan::cases();
        $pendidikans = Pendidikan::cases();

        return $dataTable->render('auth.rw.penduduk', compact('nkks', 'goldar', 'pekerjaans', 'pendidikans', 'sp', 'jk', 'agamas'));
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
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'alamat' => 'required|string|min:5',
            'jenis_kelamin' => [Rule::enum(JenisKelamin::class)],
            'agama' => [Rule::enum(Agama::class)],
            'pendidikan' => [Rule::enum(Pendidikan::class)],
            'pekerjaan' => [Rule::enum(Pekerjaan::class)],
            // 'golongan_darah' => 'required|string|max:2',
            'golongan_darah' =>  [Rule::enum(GolDar::class)],
            'status_pernikahan' => [Rule::enum(StatusPernikahan::class)],
            'status_pendatang' => 'required',
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.string' => 'NIK harus berupa teks.',
            'nik.min' => 'NIK harus memiliki panjang minimal :min digit.',
            'nik.max' => 'NIK harus memiliki panjang maksimal :max digit.',
            'nik.unique' => 'NIK sudah digunakan.',
        
            'nkk.required' => 'Nomor Kartu Keluarga (NKK) wajib diisi.',
            'nkk.string' => 'Nomor Kartu Keluarga (NKK) harus berupa teks.',
            'nkk.min' => 'Nomor Kartu Keluarga (NKK) harus memiliki panjang minimal :min digit.',
            'nkk.max' => 'Nomor Kartu Keluarga (NKK) harus memiliki panjang maksimal :max digit.',
        
            'no_rt.required' => 'Nomor RT wajib diisi.',
            'no_rt.string' => 'Nomor RT harus berupa teks.',
            'no_rt.max' => 'Nomor RT harus memiliki panjang maksimal :max digit.',
        
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama harus memiliki panjang maksimal :max karakter.',
        
            'tempat_lahir.required' => 'Tempat Lahir wajib diisi.',
            'tempat_lahir.string' => 'Tempat Lahir harus berupa teks.',
            'tempat_lahir.min' => 'Tempat Lahir harus memiliki panjang minimal :min karakter.',
            'tempat_lahir.max' => 'Tempat Lahir harus memiliki panjang maksimal :max karakter.',
        
            'tanggal_lahir.required' => 'Tanggal Lahir wajib diisi.',
            'tanggal_lahir.date' => 'Tanggal Lahir harus berupa tanggal yang valid (format bulan/tanggal/tahun).',
            'tanggal_lahir.before_or_equal' => 'Tanggal Lahir tidak boleh di masa depan.',
        
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',
            'alamat.min' => 'Alamat harus memiliki panjang minimal :min karakter.',
        
            'jenis_kelamin.required' => 'Jenis Kelamin wajib diisi.',
            'jenis_kelamin.enum' => 'Jenis Kelamin tidak valid.',
        
            'agama.required' => 'Agama wajib diisi.',
            'agama.enum' => 'Agama tidak valid.',
        
            'pendidikan.required' => 'Pendidikan wajib diisi.',
            'pendidikan.enum' => 'Pendidikan tidak valid.',
        
            'pekerjaan.required' => 'Pekerjaan wajib diisi.',
            'pekerjaan.enum' => 'Pekerjaan tidak valid.',
        
            'golongan_darah.required' => 'Golongan Darah wajib diisi.',
            'golongan_darah.enum' => 'Golongan Darah tidak valid.',
        
            'status_pernikahan.required' => 'Status Pernikahan wajib diisi.',
            'status_pernikahan.enum' => 'Status Pernikahan tidak valid.',
        
            'status_pendatang.required' => 'Status Pendatang wajib diisi.',
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

        $validated = $request->validate([
            'nik' => 'required|string|min:15|max:17|unique:penduduk,nik,' . $penduduk->nik . ',nik',
            'nkk' => 'required|string|min:15|max:17',
            'no_rt' => 'required|string|max:2',
            'nama' => 'required|string|max:49',
            'tempat_lahir' => 'required|string|min:2|max:49',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'alamat' => 'required|string|min:5',
            'jenis_kelamin' => [Rule::enum(JenisKelamin::class)],
            'agama' => [Rule::enum(Agama::class)],
            'pendidikan' => [Rule::enum(Pendidikan::class)],
            'pekerjaan' => [Rule::enum(Pekerjaan::class)],
            'golongan_darah' => [Rule::enum(GolDar::class)],
            'status_pernikahan' => [Rule::enum(StatusPernikahan::class)],
            'status_pendatang' => 'required',
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.string' => 'NIK harus berupa teks.',
            'nik.min' => 'NIK harus memiliki panjang minimal :min digit.',
            'nik.max' => 'NIK harus memiliki panjang maksimal :max digit.',
            'nik.unique' => 'NIK sudah digunakan.',
        
            'nkk.required' => 'Nomor Kartu Keluarga (NKK) wajib diisi.',
            'nkk.string' => 'Nomor Kartu Keluarga (NKK) harus berupa teks.',
            'nkk.min' => 'Nomor Kartu Keluarga (NKK) harus memiliki panjang minimal :min digit.',
            'nkk.max' => 'Nomor Kartu Keluarga (NKK) harus memiliki panjang maksimal :max digit.',
        
            'no_rt.required' => 'Nomor RT wajib diisi.',
            'no_rt.string' => 'Nomor RT harus berupa teks.',
            'no_rt.max' => 'Nomor RT harus memiliki panjang maksimal :max digit.',
        
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama harus memiliki panjang maksimal :max karakter.',
        
            'tempat_lahir.required' => 'Tempat Lahir wajib diisi.',
            'tempat_lahir.string' => 'Tempat Lahir harus berupa teks.',
            'tempat_lahir.min' => 'Tempat Lahir harus memiliki panjang minimal :min karakter.',
            'tempat_lahir.max' => 'Tempat Lahir harus memiliki panjang maksimal :max karakter.',
        
            'tanggal_lahir.required' => 'Tanggal Lahir wajib diisi.',
            'tanggal_lahir.date' => 'Tanggal Lahir harus berupa tanggal yang valid.',
            'tanggal_lahir.before_or_equal' => 'Tanggal Lahir tidak boleh di masa depan.',
        
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',
            'alamat.min' => 'Alamat harus memiliki panjang minimal :min karakter.',
        
            'jenis_kelamin.required' => 'Jenis Kelamin wajib diisi.',
            'jenis_kelamin.enum' => 'Jenis Kelamin tidak valid.',
        
            'agama.required' => 'Agama wajib diisi.',
            'agama.enum' => 'Agama tidak valid.',
        
            'pendidikan.required' => 'Pendidikan wajib diisi.',
            'pendidikan.enum' => 'Pendidikan tidak valid.',
        
            'pekerjaan.required' => 'Pekerjaan wajib diisi.',
            'pekerjaan.enum' => 'Pekerjaan tidak valid.',
        
            'golongan_darah.required' => 'Golongan Darah wajib diisi.',
            'golongan_darah.enum' => 'Golongan Darah tidak valid.',
        
            'status_pernikahan.required' => 'Status Pernikahan wajib diisi.',
            'status_pernikahan.enum' => 'Status Pernikahan tidak valid.',
        
            'status_pendatang.required' => 'Status Pendatang wajib diisi.',
        ]);

        try {
            $penduduk->update([
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
            return redirect()->back()->with('success', 'Data Penduduk berhasil diperbarui!');
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function destroy(Penduduk $penduduk)
    {
        $penduduk->delete();

        return redirect()->back()
            ->with('success', 'Penduduk berhasil dihapus.');
    }

    public function import(Request $request)
    {
        $file = $request->file('file');

        if (!$file) {
            Alert::error('Error', 'File tidak ditemukan.');
            return redirect()->back();
        }

        // Membaca file yang diupload
        $spreadsheet = IOFactory::load($file->getPathname());
        $sheet = $spreadsheet->getActiveSheet();
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        for ($row = 2; $row <= $highestRow; $row++) {
            $data = [];
            for ($col = 'A'; $col <= $highestColumn; $col++) {
                $data[] = $sheet->getCell($col . $row)->getValue();
            }

            try {
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
                    'nik' => 'required|min:15|max:17|unique:penduduk,nik',
                    'nkk' => 'required|min:15|max:17',
                    'no_rt' => 'required|max:2',
                    'nama' => 'required|max:49',
                    'tempat_lahir' => 'required|min:2|max:49',
                    'tanggal_lahir' => 'required|date',
                    'alamat' => 'required|min:5',
                    'jenis_kelamin' => [Rule::enum(JenisKelamin::class)],
                    'agama' => [Rule::enum(Agama::class)],
                    'pendidikan' => [Rule::enum(Pendidikan::class)],
                    'pekerjaan' => [Rule::enum(Pekerjaan::class)],
                    'golongan_darah' => [Rule::enum(GolDar::class)],
                    'status_pernikahan' => [Rule::enum(StatusPernikahan::class)],
                    'status_pendatang' => 'required',
                ])->validate();

                // Log data yang valid
                Log::info('Data valid:', $validated);

                // Jika validasi berhasil, buat entri baru di database
                Penduduk::create($validated);
            } catch (\Exception $e) {
                Log::error('Kesalahan pada baris ' . ($row - 1) . ': ' . $e->getMessage());
                Alert::error('Kesalahan pada baris ' . ($row - 1), $e->getMessage());
                return redirect()->back();
            }
        }

        return redirect()->back()->with('success', 'Excel berhasil diimpor.');
    }

    public function export()
    {
        $penduduk = Penduduk::all();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Menulis header
        $sheet->setCellValue('A1', 'NIK');
        $sheet->setCellValue('B1', 'Nomor KK');
        $sheet->setCellValue('C1', 'Nomor RT');
        $sheet->setCellValue('D1', 'Nama Lengkap');
        $sheet->setCellValue('E1', 'Tempat Lahir');
        $sheet->setCellValue('F1', 'Tanggal Lahir');
        $sheet->setCellValue('G1', 'Alamat');
        $sheet->setCellValue('H1', 'Jenis Kelamin');
        $sheet->setCellValue('I1', 'Agama');
        $sheet->setCellValue('J1', 'Pendidikan');
        $sheet->setCellValue('K1', 'Pekerjaan');
        $sheet->setCellValue('L1', 'Golongan Darah');
        $sheet->setCellValue('M1', 'Status Pernikahan');
        $sheet->setCellValue('N1', 'Status Pendatang');

        $rowNumber = 2;
        foreach ($penduduk as $row) {
            $sheet->setCellValue('A' . $rowNumber, $row->nik);
            $sheet->setCellValue('B' . $rowNumber, $row->nkk);
            $sheet->setCellValue('C' . $rowNumber, $row->no_rt);
            $sheet->setCellValue('D' . $rowNumber, $row->nama);
            $sheet->setCellValue('E' . $rowNumber, $row->tempat_lahir);
            $sheet->setCellValue('F' . $rowNumber, $row->tanggal_lahir);
            $sheet->setCellValue('G' . $rowNumber, $row->alamat);
            $sheet->setCellValue('H' . $rowNumber, $row->jenis_kelamin->getDescription());
            $sheet->setCellValue('I' . $rowNumber, $row->agama->getDescription());
            $sheet->setCellValue('J' . $rowNumber, $row->pendidikan->getDescription());
            $sheet->setCellValue('K' . $rowNumber, $row->pekerjaan->getDescription());
            $sheet->setCellValue('L' . $rowNumber, $row->golongan_darah->getDescription());
            $sheet->setCellValue('M' . $rowNumber, $row->status_pernikahan->getDescription());
            $sheet->setCellValue('N' . $rowNumber, $row->status_pendatang ? 'Pendatang' : 'Asli');
            $rowNumber++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'penduduk.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($temp_file);

        return response()->download($temp_file, $fileName)->deleteFileAfterSend(true);
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