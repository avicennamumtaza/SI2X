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
        // Validasi data input dari form
        $request->validate([
            'no_rw' => 'required',
            'nik_rw' => 'required',
            'jumlah_rt' => 'required',
            'jumlah_keluarga_rw' => 'required',
            'jumlah_penduduk_rw' => 'required',
        ]);

        // Simpan data pengumuman ke dalam database
        // Pengumuman::create([
        //     'nama_pengumuman' => $request->nama_pengumuman,
        //     'desc_pengumuman' => $request->desc_pengumuman,
        //     'tanggal_pengumuman' => $request->tanggal_pengumuman,
        // ]);

        $rw = new Rw();
        $rw->no_rw = $request->no_rw;
        $rw->nik_rw = $request->nik_rw;
        $rw->jumlah_rt = $request->jumlah_rt;
        $rw->jumlah_keluarga_rw = $request->jumlah_keluarga_rw;
        $rw->jumlah_penduduk_rw = $request->jumlah_penduduk_rw;
        $rw->save();

        return redirect()->back()->with('success', 'Pengumuman berhasil dipublish!');
    }

    public function edit(Rw $rw)
    {
        return view('rw.edit', compact('rw'));
    }

    public function update(Request $request, Rw $rw)
    {
        $request->validate([
            'no_rw' => 'required',
            'nik_rw' => 'required',
            'jumlah_rt' => 'required',
            'jumlah_keluarga_rw' => 'required',
            'jumlah_penduduk_rw' => 'required',
        ]);

        $rw->update($request->all());

        return redirect()->route('rw.manage')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Rw $rw)
    {
        $rw->delete();

        return redirect()->back()
            ->with('success', 'Pengumuman berhasil dihapus.');
    }
}
