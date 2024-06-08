<?php

namespace App\Http\Controllers;

use App\DataTables\LaporanKeuanganDataTable;
use App\Models\LaporanKeuangan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class LaporanKeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporankeuangans = 
        // Cache::remember('globalLaporanKeuangan' . request('page', 1), 600, function() {
            // return 
            LaporanKeuangan::orderBy('updated_at', 'desc')->paginate(10);
        // });
        
        // });
        $saldo = Cache::remember('globalSaldo', 600, function () {
            return LaporanKeuangan::latest('updated_at')->value('saldo');
        });

        foreach ($laporankeuangans as $laporankeuangan) {
            $laporankeuangan->tanggal = Carbon::parse($laporankeuangan->tanggal)->format('d-m-Y');
        }

        return view('global.laporankeuangan')->with('laporankeuangans', $laporankeuangans)->with('saldo', $saldo);
    }

    public function list(LaporanKeuanganDataTable $dataTable)
    {
        $latestRow = LaporanKeuangan::latest()->first();
        $laporanKeuangans = LaporanKeuangan::all();
        $saldo = LaporanKeuangan::latest('updated_at')->value('saldo');
        // $latestUpdate = LaporanKeuangan::latest('updated_at')->value('updated_at');
        // dd($saldo);

        return $dataTable->render('auth.rw.laporankeuangan', compact('latestRow', 'saldo', 'laporanKeuangans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data input dari form
        $request->validate([
            // 'id_laporankeuangan' => 'required', (???)
            'status_pemasukan' => 'required',
            'nominal' => 'required|integer|min_digits:3|max_digits:10',
            'pihak_terlibat' => 'required|string|min:2|max:49',
            'detail' => 'required|string',
            'tanggal' => 'required|date',
        ], [
            'status_pemasukan.required' => 'Jenis laporan wajib diisi!',
            'nominal.required' => 'Nominal wajib diisi.',
            'nominal.integer' => 'Nominal harus berupa bilangan bulat.',
            'nominal.min_digits' => 'Nominal harus memiliki panjang minimal :min digit.',
            'nominal.max_digits' => 'Nominal harus memiliki panjang maksimal :max digit.',
            'pihak_terlibat.required' => 'Pihak terlibat wajib diisi.',
            'pihak_terlibat.string' => 'Pihak terlibat harus berupa teks.',
            'pihak_terlibat.min' => 'Pihak terlibat harus memiliki panjang minimal :min karakter.',
            'pihak_terlibat.max' => 'Pihak terlibat harus memiliki panjang maksimal :max karakter.',
            'detail.required' => 'Detail wajib diisi.',
            'detail.string' => 'Detail harus berupa teks.',
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.date' => 'Tanggal harus dalam format tanggal yang benar.',
        ]);

        // Mengambil data terbaru kolom saldo
        $latestSaldo = LaporanKeuangan::latest('updated_at')->value('saldo');
        // dd($latestSaldo);

        try {
            $laporanKeuangan = new LaporanKeuangan();
            $laporanKeuangan->status_pemasukan = $request->status_pemasukan;
            $laporanKeuangan->nominal = $request->nominal;
            $laporanKeuangan->detail = $request->detail;
            $laporanKeuangan->tanggal = $request->tanggal;
            if ($laporanKeuangan->status_pemasukan == 0) {
                $laporanKeuangan->saldo = $latestSaldo - $laporanKeuangan->nominal;
                if ($laporanKeuangan->saldo < 0) {
                    # code...
                    return redirect()->back()->with('error', 'Saldo tidak boleh kurang dari nol!');
                }
            } else if ($laporanKeuangan->status_pemasukan == 1) {
                $laporanKeuangan->saldo = $latestSaldo + $laporanKeuangan->nominal;
            }
            $laporanKeuangan->pihak_terlibat = $request->pihak_terlibat;
            $laporanKeuangan->save();
            return redirect()->back()->with('success', 'Laporan Keuangan berhasil ditambahkan!');
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function edit(LaporanKeuangan $laporankeuangan)
    {
        $laporankeuangan = Laporankeuangan::findOrFail($laporankeuangan->id_laporankeuangan);
        return view('laporankeuangan.edit', compact('laporankeuangan'));
    }

    public function update(Request $request, LaporanKeuangan $laporankeuangan)
    {
        $request->validate([
            'status_pemasukan' => 'required',
            'pihak_terlibat' => 'required|string|min:2|max:49',
            'detail' => 'required|string',
            'tanggal' => 'required|date',
        ], [
            'status_pemasukan.required' => 'Jenis laporan wajib diisi!',
            'pihak_terlibat.required' => 'Pihak terlibat wajib diisi.',
            'pihak_terlibat.string' => 'Pihak terlibat harus berupa teks.',
            'pihak_terlibat.min' => 'Pihak terlibat harus memiliki panjang minimal :min karakter.',
            'pihak_terlibat.max' => 'Pihak terlibat harus memiliki panjang maksimal :max karakter.',
            'detail.required' => 'Detail wajib diisi.',
            'detail.string' => 'Detail harus berupa teks.',
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.date' => 'Tanggal harus dalam format tanggal yang benar.',
        ]);

        try {
            // Mengambil data terbaru kolom saldo
            $latestRow = LaporanKeuangan::orderBy('updated_at', 'desc')->take(2)->get();
            // dd($latestRow);
            $latestSaldo = $latestRow->skip(1)->value('saldo');
            // dd($latestSaldo);

            $laporankeuangan->nominal = $request->nominal;
            $laporankeuangan->pihak_terlibat = $request->pihak_terlibat;
            $laporankeuangan->status_pemasukan = $request->status_pemasukan;
            // dd($request->status_pemasukan);

            if ($laporankeuangan->status_pemasukan == 0) {
                $laporankeuangan->saldo = $latestSaldo - $laporankeuangan->nominal;
                if ($laporankeuangan->saldo < 0) {
                    # code...
                    return redirect()->back()->with('error', 'Saldo tidak boleh kurang dari nol!');
                }
            } elseif ($laporankeuangan->status_pemasukan == 1) {
                $laporankeuangan->saldo = $latestSaldo + $laporankeuangan->nominal;
            }
            // $laporankeuangan->update($request->all());
            $laporankeuangan->save();

            return redirect()->route('laporankeuangan.manage')
                ->with('success', 'Laporan Keuangan berhasil diperbarui.');
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_laporankeuangan)
    {
        try {
            $laporankeuangan = LaporanKeuangan::findOrFail($id_laporankeuangan);
            confirmDelete('Apakah Anda yakin ingin menghapus data ini?', 'Data yang sudah terhapus tidak bisa dikembalikan');
            // PESAN DI ATAS BELUM BISA MUNCUL, JADI NILAI DEFAULT confirmDelete DISET TRUEEE"
            if (confirmDelete('Apakah Anda yakin ingin menghapus data ini?', 'Data yang sudah terhapus tidak bisa dikembalikan')) {
                $laporankeuangan->delete();
                return redirect()->back()->with('success', 'Data berhasil dihapus!');
            }
            return redirect()->back()->with('warning', 'Penghapusan data dibatalkan');
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function export()
    {
        $penduduk = LaporanKeuangan::all()->sortByDesc('tanggal');;
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Menulis header
        $sheet->setCellValue('A1', 'Tanggal');
        $sheet->setCellValue('B1', 'Jenis');
        $sheet->setCellValue('C1', 'Pihak terlibat');
        $sheet->setCellValue('D1', 'Detail');
        $sheet->setCellValue('E1', 'Nominal');
        $sheet->setCellValue('F1', 'Saldo Akhir');

        $rowNumber = 2;
        foreach ($penduduk as $row) {
            $sheet->setCellValue('A' . $rowNumber, $row->tanggal);
            $sheet->setCellValue('B' . $rowNumber, $row->status_pemasukan ? 'Pemasukan' : 'Pengeluaran');
            $sheet->setCellValue('C' . $rowNumber, $row->pihak_terlibat);
            $sheet->setCellValue('D' . $rowNumber, $row->detail);
            $sheet->setCellValue('E' . $rowNumber, $row->nominal);
            $sheet->setCellValue('F' . $rowNumber, $row->saldo);
            $sheet->setCellValue('G' . $rowNumber, $row->alamat);
            $rowNumber++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'laporanKeuangan.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($temp_file);

        return response()->download($temp_file, $fileName)->deleteFileAfterSend(true);
    }
}
