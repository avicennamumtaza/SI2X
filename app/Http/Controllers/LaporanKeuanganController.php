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

        // Simpan data pengumuman ke dalam database
        // Pengumuman::create([
        //     'nama_pengumuman' => $request->nama_pengumuman,
        //     'desc_pengumuman' => $request->desc_pengumuman,
        //     'tanggal_pengumuman' => $request->tanggal_pengumuman,
        // ]);

        $laporanKeuangan = new LaporanKeuangan();
        $laporanKeuangan->id_laporankeuangan = $request->id_laporankeuangan;
        $laporanKeuangan->is_income = $request->is_income;
        $laporanKeuangan->nominal = $request->nominal;
        $laporanKeuangan->detail_laporan = $request->detail_laporan;
        $laporanKeuangan->tanggal_laporan = $request->tanggal_laporan;
        $laporanKeuangan->save();

        return redirect()->back()->with('success', 'Laporan Keuangan berhasil dipublish!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
