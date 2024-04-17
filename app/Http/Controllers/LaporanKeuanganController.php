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
            // 'id_laporankeuangan' => 'required',
            'is_income' => 'required',
            'nominal' => 'required',
            'detail' => 'required',
            'tanggal' => 'required',
        ]);

        try {
            $laporanKeuangan = new LaporanKeuangan();
            $laporanKeuangan->id_laporankeuangan = $request->id_laporankeuangan;
            $laporanKeuangan->is_income = $request->is_income;
            $laporanKeuangan->nominal = $request->nominal;
            $laporanKeuangan->detail = $request->detail;
            $laporanKeuangan->tanggal = $request->tanggal;
            $laporanKeuangan->saldo = $request->saldo;
            $laporanKeuangan->pihak_terlibat = $request->pihak_terlibat;
            $laporanKeuangan->save();
            return redirect()->back()->with('success', 'Data Penduduk berhasil ditambahkan!');
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
            'id_laporankeuangan' => 'required',
            'nominal' => 'required',
            'detail' => 'required',
            'tanggal' => 'required',
            'pihak_terlibat' => 'required',
            'saldo' => 'required',
            'is_income' => 'required',
        ]);

        try {
            $laporankeuangan->update($request->all());
            return redirect()->route('laporankeuangan.manage')
                ->with('success', 'Laporan keuangan berhasil diperbarui.');
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
