<?php

namespace App\Http\Controllers;

use App\DataTables\LaporanKeuanganDataTable;
use App\Models\LaporanKeuangan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;


class LaporanKeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $this->authorize('isRt');
        // return view('global.laporankeuangan');
        $laporankeuangans = LaporanKeuangan::all();
        $latestLaporanKeuangan = LaporanKeuangan::latest()->first();
        $saldo = $latestLaporanKeuangan->saldo;

        foreach ($laporankeuangans as $laporankeuangan) {
            $laporankeuangan->tanggal = Carbon::parse($laporankeuangan->tanggal)->format('d-m-Y');
        }
        
        return view('global.laporankeuangan')->with('laporanKeuangans', $laporankeuangans)->with('saldo', $saldo);

    }

    public function list(LaporanKeuanganDataTable $dataTable)
    {
        $latestRow = LaporanKeuangan::latest()->first();
        return $dataTable->render('auth.rw.laporankeuangan', compact('latestRow'));
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
            'status_pemasukan.required' => 'Status pendapatan/wyidrawajib diisi.',
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
        $latestSaldo = LaporanKeuangan::latest()->value('saldo');

        try {
            $laporanKeuangan = new LaporanKeuangan();
            // $laporanKeuangan->id_laporankeuangan = $request->id_laporankeuangan;
            $laporanKeuangan->status_pemasukan = $request->status_pemasukan;
            $laporanKeuangan->nominal = $request->nominal;
            $laporanKeuangan->detail = $request->detail;
            $laporanKeuangan->tanggal = $request->tanggal;
            if (!$laporanKeuangan->status_pemasukan || $laporanKeuangan->status_pemasukan == 0) {
                $laporanKeuangan->saldo = $latestSaldo - $laporanKeuangan->nominal;
            } else if ($laporanKeuangan->status_pemasukan === true || $laporanKeuangan->status_pemasukan == 1) {
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

    // public function update(Request $request, LaporanKeuangan $laporankeuangan)
    // {
    //     $request->validate([
    //         // 'id_laporankeuangan' => 'required', // (tidak bisa mengedit id as primary key, cek view)
    //         'pihak_terlibat' => 'required|string|min:2|max:49',
    //         // 'saldo' => 'required', // (tidak bisa mengedit saldo, cek view)
    //         'status_pemasukan' => 'required',
    //         'nominal' => 'required|integer|min_digits:3|max_digits:10',
    //         'detail' => 'required|string',
    //         'tanggal' => 'required|date',
    //     ], [
    //         'pihak_terlibat.required' => 'Pihak terlibat wajib diisi.',
    //         'pihak_terlibat.string' => 'Pihak terlibat harus berupa teks.',
    //         'pihak_terlibat.min' => 'Pihak terlibat harus memiliki panjang minimal :min karakter.',
    //         'pihak_terlibat.max' => 'Pihak terlibat harus memiliki panjang maksimal :max karakter.',
    //         'status_pemasukan.required' => 'Status pendapatan/wyidrawajib diisi.',
    //         'nominal.required' => 'Nominal wajib diisi.',
    //         'nominal.integer' => 'Nominal harus berupa bilangan bulat.',
    //         'nominal.min_digits' => 'Nominal harus memiliki panjang minimal :min digit.',
    //         'nominal.max_digits' => 'Nominal harus memiliki panjang maksimal :max digit.',
    //         'detail.required' => 'Detail wajib diisi.',
    //         'detail.string' => 'Detail harus berupa teks.',
    //         'tanggal.required' => 'Tanggal wajib diisi.',
    //         'tanggal.date' => 'Tanggal harus dalam format tanggal yang benar.',
    //     ]);

    //     try {
    //         // Setel nilai atribut laporan keuangan berdasarkan request
    //         $laporankeuangan->pihak_terlibat = $request->pihak_terlibat;
    //         $laporankeuangan->status_pemasukan = $request->status_pemasukan;
    //         $laporankeuangan->nominal = $request->nominal;
    //         $laporankeuangan->detail = $request->detail;
    //         $laporankeuangan->tanggal = $request->tanggal;

    //         // Lakukan perhitungan saldo
    //         $latestSaldo = $laporankeuangan->saldo;
    //         if (!$request->status_pemasukan || $request->status_pemasukan == 0) {
    //             $laporankeuangan->saldo = $latestSaldo - $request->nominal;
    //         } else if ($request->status_pemasukan === true || $request->status_pemasukan == 1) {
    //             $laporankeuangan->saldo = $latestSaldo + $request->nominal;
    //         }

    //         // Simpan perubahan ke dalam database
    //         $laporankeuangan->save();

    //         return redirect()->route('laporankeuangan.manage')
    //             ->with('success', 'Laporan Keuangan berhasil diperbarui.');
    //     } catch (\Exception $e) {
    //         Alert::error('Error', $e->getMessage());
    //         return redirect()->back();
    //     }
    // }

    public function update(Request $request, LaporanKeuangan $laporankeuangan)
    {

        $request->validate([
            // 'id_laporankeuangan' => 'required', // (tidak bisa mengedit id as primary key, cek view)
            'pihak_terlibat' => 'required|string|min:2|max:49',
            // 'saldo' => 'required', // (tidak bisa mengedit saldo, cek view)
            // 'status_pemasukan' => 'required',
            // 'nominal' => 'required|integer|min_digits:3|max_digits:10',
            'detail' => 'required|string',
            'tanggal' => 'required|date',
        ], [
            'pihak_terlibat.required' => 'Pihak terlibat wajib diisi.',
            'pihak_terlibat.string' => 'Pihak terlibat harus berupa teks.',
            'pihak_terlibat.min' => 'Pihak terlibat harus memiliki panjang minimal :min karakter.',
            'pihak_terlibat.max' => 'Pihak terlibat harus memiliki panjang maksimal :max karakter.',
            // 'status_pemasukan.required' => 'Status pendapatan/wyidrawajib diisi.',
            // 'nominal.required' => 'Nominal wajib diisi.',
            // 'nominal.integer' => 'Nominal harus berupa bilangan bulat.',
            // 'nominal.min_digits' => 'Nominal harus memiliki panjang minimal :min digit.',
            // 'nominal.max_digits' => 'Nominal harus memiliki panjang maksimal :max digit.',
            'detail.required' => 'Detail wajib diisi.',
            'detail.string' => 'Detail harus berupa teks.',
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.date' => 'Tanggal harus dalam format tanggal yang benar.',
        ]);

        try {
            $laporankeuangan->update($request->all());
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
}