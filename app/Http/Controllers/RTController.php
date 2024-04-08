<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rt;
use App\DataTables\RTDataTable;

class RTController extends Controller
{
    public function index()
    {
        $rts = Rt::all();
        return view('global.rt')->with('rts', $rts);
        // $pengumumans = Pengumuman::all();
        // return view('auth.rw.pengumuman', compact('pengumumans'));
    }
    
    public function list(RTDataTable $dataTable) {
        return $dataTable->render('auth.rw.pendataan_rt');
    }

    // public function create()
    // {
    //     return view('auth.rw.pengumuman.create');
    // }

    public function store(Request $request)
    {
        // Validasi data input dari form
        $request->validate([
            'no_rt' => 'required',
            'nik_rt' => 'required',
            'jumlah_keluarga_rt' => 'required',
            'jumlah_penduduk_rt' => 'required',
        ]);

        // Simpan data pengumuman ke dalam database
        // Pengumuman::create([
        //     'nama_pengumuman' => $request->nama_pengumuman,
        //     'desc_pengumuman' => $request->desc_pengumuman,
        //     'tanggal_pengumuman' => $request->tanggal_pengumuman,
        // ]);

        $rt = new Rt();
        $rt->no_rt = $request->no_rt;
        $rt->nik_rt = $request->nik_rt;
        $rt->jumlah_keluarga_rt = $request->jumlah_keluarga_rt;
        $rt->jumlah_penduduk_rt = $request->jumlah_penduduk_rt;
        $rt->save();

        return redirect()->back()->with('success', 'Pengumuman berhasil dipublish!');
    }

    public function edit(Rt $rt)
    {
        return view('rt.edit', compact('rt'));
    }

    public function update(Request $request, Rt $rt)
    {
        $request->validate([
            'no_rt' => 'required',
            'nik_rt' => 'required',
            'jumlah_keluarga_rt' => 'required',
            'jumlah_penduduk_rt' => 'required',
        ]);

        $rt->update($request->all());

        return redirect()->route('rt.manage')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Rt $rt)
    {
        $rt->delete();

        return redirect()->back()
            ->with('success', 'Pengumuman berhasil dihapus.');
    }
}
