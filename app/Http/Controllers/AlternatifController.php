<?php

namespace App\Http\Controllers;

use App\DataTables\AlternatifDataTable;
use App\DataTables\BansosDataTable;
use App\Models\Alternatif;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function list(AlternatifDataTable $dataTable)
    {
        return $dataTable->render('auth.rw.bansos');
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
     * Calculate the resources.
     */
    public function spk()
    {
        return view('auth.rw.spk');
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
    public function destroy(Alternatif $alternatif)
    {
        $alternatif->delete();

        return redirect()->back()
            ->with('success', 'Data calon penerima bansos berhasil dihapus.');
    }
}
