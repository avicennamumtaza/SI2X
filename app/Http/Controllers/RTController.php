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
            'no_rt' => 'required|unique:rt,no_rt',
            'nik_rt' => 'required|min:15|max:17|unique:rt,nik_rt',
            'wa_rt' => 'required|min:11|max:14',
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
        $rt->wa_rt = $request->wa_rt;
        $rt->save();

        return redirect()->back()->with('success', 'Data RT Berhasil ditambahkan!');
    }

    public function edit(Rt $rt)
    {
        $rt = Rt::findOrFail($rt->no_rt);
        return view('rt.edit', compact('rt'));
    }

    public function update(Request $request, Rt $rt)
    {
        $request->validate([
            'no_rt' => 'required|unique:rt,no_rt,'. $rt->no_rt .',no_rt', // (tidak bisa mengubah no_rt as primary key, cek view)
            'nik_rt' => 'required|min:15|max:17|unique:rt,nik_rt,'. $rt->no_rt .',no_rt',
            'wa_rt' => 'required|min:11|max:14',
        ]);

        $rt->update($request->all());

        return redirect()->route('rt.manage')
            ->with('success', 'Data RT Berhasil diperbarui.');
    }

    public function destroy(Rt $rt)
    {
        $rt->delete();

        return redirect()->back()
            ->with('success', 'Data RT Berhasil dihapus.');
    }
}
