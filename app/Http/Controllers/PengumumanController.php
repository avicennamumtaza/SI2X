<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumumans = Pengumuman::all();
        return view('auth.rw.pengumuman', compact('pengumumans'));
    }

    // public function create()
    // {
    //     return view('auth.rw.pengumuman.create');
    // }

    public function store(Request $request)
    {
        // Validasi data input dari form
        $request->validate([
            'nama_pengumuman' => 'required',
            'desc_pengumuman' => 'required',
            'tanggal_pengumuman' => 'required',
        ]);

        // Simpan data pengumuman ke dalam database
        // Pengumuman::create([
        //     'nama_pengumuman' => $request->nama_pengumuman,
        //     'desc_pengumuman' => $request->desc_pengumuman,
        //     'tanggal_pengumuman' => $request->tanggal_pengumuman,
        // ]);

        $pengumuman = new Pengumuman();
        $pengumuman->no_rw = 6;
        $pengumuman->judul = $request->nama_pengumuman;
        $pengumuman->deskripsi = $request->desc_pengumuman;
        $pengumuman->tanggal_pengumuman = $request->tanggal_pengumuman;
        $pengumuman->save();
        
        return redirect()->back()->with('success', 'Pengumuman berhasil diajukan!');
    }

    public function edit(Pengumuman $pengumuman)
    {
        return view('pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal_pengumuman' => 'required',
        ]);

        $pengumuman->update($request->all());

        return redirect()->route('pengumuman.index')
                         ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();

        return redirect()->route('pengumuman.index')
                         ->with('success', 'Pengumuman berhasil dihapus.');
    }
}