<?php

namespace App\Http\Controllers;

use App\DataTables\LaporanKeuanganDataTable;
use App\Models\LaporanKeuangan;
use Illuminate\Http\Request;

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
            'id_laporankeuangan' => 'required',
            'is_income' => 'required',
            'nominal' => 'required',
            'detail_laporan' => 'required',
            'tanggal_laporan' => 'required',
        ]);

        $laporanKeuangan = new LaporanKeuangan();
        $laporanKeuangan->id_laporankeuangan = $request->id_laporankeuangan;
        $laporanKeuangan->is_income = $request->is_income;
        $laporanKeuangan->nominal = $request->nominal;
        $laporanKeuangan->detail = $request->detail;
        $laporanKeuangan->tanggal = $request->tanggal;
        $laporanKeuangan->saldo = $request->saldo;
        $laporanKeuangan->pihak_terlibat = $request->pihak_terlibat;
        $laporanKeuangan->save();

        return redirect()->back()->with('success', 'Laporan Keuangan berhasil dipublish!');
    }

    public function edit(LaporanKeuangan $laporanKeuangan)
    {
        $laporanKeuangan = LaporanKeuangan::findOrFail($laporanKeuangan->id_laporankeuangan);
        return view('laporankeuangan.edit', compact('laporanKeuangan'));
    }

    public function update(Request $request, LaporanKeuangan $laporanKeuangan)
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

        $laporanKeuangan->update($request->all());

        return redirect()->route('laporankeuangan.manage')
            ->with('success', 'Laporan keuangan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_laporankeuangan)
    {
        $laporankeuangan = LaporanKeuangan::findOrFail($id_laporankeuangan);
        $laporankeuangan->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }    
}
