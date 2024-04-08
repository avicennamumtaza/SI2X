<?php

namespace App\Http\Controllers;

use App\DataTables\PengajuanDokumenDataTable;
use App\Models\PengajuanDokumen;
use Illuminate\Http\Request;

class PengajuanDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('global.pengajuandokumen');
    }

    public function list(PengajuanDokumenDataTable $dataTable) {
        return $dataTable->render('auth.rt.pengajuandokumen');
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
        //
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
    public function destroy(string $id_pengajuandokumen)
    {
        $pengajuanDokumen = PengajuanDokumen::findOrFail($id_pengajuandokumen);
        $pengajuanDokumen->delete();
        return redirect()->back()->with('success', 'Data Pengajuan Dokumen berhasil dihapus!');
    }
}
