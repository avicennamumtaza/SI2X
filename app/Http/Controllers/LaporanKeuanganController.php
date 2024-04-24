<?php

namespace App\Http\Controllers;

use App\DataTables\LaporanKeuanganDataTable;
use App\Models\LaporanKeuangan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LaporanKeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $this->authorize('isRt');
        return view('global.laporankeuangan');
    }

    public function list(LaporanKeuanganDataTable $dataTable)
    {
        return $dataTable->render('auth.rw.laporankeuangan');
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
            'is_income' => 'required',
            'nominal' => 'required|integer|min_digits:3|max_digits:10',
            'pihak_terlibat' => 'required|string|min:2|max:49',
            'detail' => 'required|string',
            'tanggal' => 'required|date',
        ], [
            'is_income.required' => 'Status pendapatan/wyidrawajib diisi.',
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

        try {
            $laporanKeuangan = new LaporanKeuangan();
            // $laporanKeuangan->id_laporankeuangan = $request->id_laporankeuangan;
            $laporanKeuangan->is_income = $request->is_income;
            $laporanKeuangan->nominal = $request->nominal;
            $laporanKeuangan->detail = $request->detail;
            $laporanKeuangan->tanggal = $request->tanggal;
            $laporanKeuangan->saldo = $request->saldo;
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
            // 'id_laporankeuangan' => 'required', // (tidak bisa mengedit id as primary key, cek view)
            'pihak_terlibat' => 'required|string|min:2|max:49',
            // 'saldo' => 'required', // (tidak bisa mengedit saldo, cek view)
            'is_income' => 'required',
            'nominal' => 'required|integer|min_digits:3|max_digits:10',
            'detail' => 'required|string',
            'tanggal' => 'required|date',
        ], [
            'pihak_terlibat.required' => 'Pihak terlibat wajib diisi.',
            'pihak_terlibat.string' => 'Pihak terlibat harus berupa teks.',
            'pihak_terlibat.min' => 'Pihak terlibat harus memiliki panjang minimal :min karakter.',
            'pihak_terlibat.max' => 'Pihak terlibat harus memiliki panjang maksimal :max karakter.',
            'is_income.required' => 'Status pendapatan/wyidrawajib diisi.',
            'nominal.required' => 'Nominal wajib diisi.',
            'nominal.integer' => 'Nominal harus berupa bilangan bulat.',
            'nominal.min_digits' => 'Nominal harus memiliki panjang minimal :min digit.',
            'nominal.max_digits' => 'Nominal harus memiliki panjang maksimal :max digit.',
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
