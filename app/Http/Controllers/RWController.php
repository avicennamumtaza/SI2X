<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rw;
use App\DataTables\RWDataTable;


class RWController extends Controller
{
    public function index()
    {
        $rws = Rw::all();
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
        $request->validate([
            'no_rw' => 'required',
            'nik_rw' => 'required|min:15|max:17',
            'wa_rt' => 'required|min:11|max:14',
        ]);

        $rw = new Rw();
        $rw->no_rw = $request->no_rw;
        $rw->nik_rw = $request->nik_rw;
        $rw->wa_rw = $request->wa_rw;
        $rw->save();

        return redirect()->back()->with('success', 'Data RW berhasil ditambahkan!');
    }

    public function edit(Rw $rw)
    {
        return view('rw.edit', compact('rw'));
    }

    public function update(Request $request, Rw $rw)
    {
        $request->validate([
            'no_rw' => 'required|unique:rw,no_rw,'.$rw->no_rw.',no_rw', // (tidak bisa mengubah no_rw as primary key, cek view)
            'nik_rw' => 'required|min:15|max:17|unique:rw,nik_rw,'. $rw->no_rw .',no_rw',
            'wa_rw' => 'required|min:11|max:14',
        ]);

        $rw->update($request->all());

        return redirect()->route('rw.manage')
            ->with('success', 'Data RW berhasil diperbarui.');
    }

    public function destroy(Rw $rw)
    {
        $rw->delete();

        return redirect()->back()
            ->with('success', 'Data RW berhasil dihapus.');
    }
}