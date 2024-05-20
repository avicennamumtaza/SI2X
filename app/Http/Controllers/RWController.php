<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RW;
use App\DataTables\RWDataTable;


class RWController extends Controller
{
    public function index()
    {
        $rws = RW::all();
        return view('global.rw')->with('rws', $rws);
        // $pengumumans = Pengumuman::all();
        // return view('auth.rw.pengumuman', compact('pengumumans'));
    }
    
    public function list(RWDataTable $dataTable) {
        return $dataTable->render('auth.rw.pendataan_rw');
    }

    // public function create()
    // {
    //     return view('auth.rw.pengumuman.create');
    // }

    public function store(Request $request)
    {
        // Validasi data input dari form
        $request->validate([
            'no_rw' => 'required',
            'nik_rw' => 'required|min:15|max:17',
            'wa_rt' => 'required|min:11|max:14',
        ]);

        $rw = new RW();
        $rw->no_rw = $request->no_rw;
        $rw->nik_rw = $request->nik_rw;
        $rw->wa_rw = $request->wa_rw;
        $rw->save();

        return redirect()->back()->with('success', 'Pengumuman berhasil dipublish!');
    }

    public function edit(RW $rw)
    {
        return view('rw.edit', compact('rw'));
    }

    public function update(Request $request, RW $rw)
    {
        $request->validate([
            'no_rw' => 'required', // (tidak bisa mengubah no_rw as primary key, cek view)
            'nik_rw' => 'required|min:15|max:17',
            'wa_rt' => 'required|min:11|max:14',
        ]);

        $rw->update($request->all());

        return redirect()->route('rw.manage')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(RW $rw)
    {
        $rw->delete();

        return redirect()->back()
            ->with('success', 'Pengumuman berhasil dihapus.');
    }
}
