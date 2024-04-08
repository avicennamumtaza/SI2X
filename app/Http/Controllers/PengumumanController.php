<?php

namespace App\Http\Controllers;

use App\DataTables\PengumumanDataTable;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumumans = Pengumuman::all();
        return view('global.pengumuman')->with('pengumumans', $pengumumans);
        // $pengumumans = Pengumuman::all();
        // return view('auth.rw.pengumuman', compact('pengumumans'));
    }
    
    public function list(PengumumanDataTable $dataTable) {
        return $dataTable->render('auth.rw.pengumuman');
    }

    // public function create()
    // {
    //     return view('auth.rw.pengumuman.create');
    // }

    public function store(Request $request)
    {
        // Validasi data input dari form
<<<<<<< HEAD
        $request->validate([
            'judul_pengumuman' => 'required',
=======
        $validated = $request->validate([
            'nama_pengumuman' => 'required',
>>>>>>> 6c2f43f2807464a9392743ac4b4964caea67a03b
            'desc_pengumuman' => 'required',
            'tanggal_pengumuman' => 'required',
        ]);
        
        try {
            Pengumuman::create([
                'judul' => $validated['nama_pengumuman'],
                'deskripsi' => $validated['desc_pengumuman'],
                'tanggal' => $validated['tanggal_pengumuman'],
                'foto' => $request->foto_pengumuman,
            ]);
            return redirect()->back()->with('success', 'Pengumuman berhasil dipublish!');
        } catch (\Exception $e) {
            Alert::error('Oops!', $e->getMessage());
            return redirect()->back();
        }

        // $pengumuman = new Pengumuman();
        // $pengumuman->judul = $request->nama_pengumuman;
        // $pengumuman->deskripsi = $request->desc_pengumuman;
        // $pengumuman->tanggal = $request->tanggal_pengumuman;
        // $pengumuman->foto = $request->foto_pengumuman;
        // $pengumuman->save();

<<<<<<< HEAD
        $pengumuman = new Pengumuman();
        $pengumuman->judul = $request->judul_pengumuman;
        $pengumuman->deskripsi = $request->desc_pengumuman;
        $pengumuman->tanggal = $request->tanggal_pengumuman;
        $pengumuman->foto = $request->foto_pengumuman;
        $pengumuman->save();

        return redirect()->back()->with('success', 'Pengumuman berhasil dipublish!');
=======
        // return redirect()->back()->with('success', 'Pengumuman berhasil dipublish!');
>>>>>>> 6c2f43f2807464a9392743ac4b4964caea67a03b
    }

    // public function edit(Pengumuman $pengumuman)
    // {
    //     return view('pengumuman.edit', compact('pengumuman'));
    // }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal_pengumuman' => 'required',
            'foto_pengumuman' => 'required',
        ]);

        try {
            // Temukan UMKM yang akan diperbarui
            $pengumuman = Pengumuman::findOrFail($id);

            // Perbarui data UMKM dengan data yang baru
            $pengumuman->update([
                'judul' => $request->judul_pengumuman,
                'deskripsi' => $request->desc_pengumuman,
                'tanggal' => $request->tanggal_pengumuman,
                'foto' => $request->foto_pengumuman,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Pengumuman berhasil diperbarui.');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika terjadi kesalahan
            return redirect()->back()->with('error', $e->getMessage());
        }
        // $pengumuman->update($request->all());

        // return redirect()->route('pengumuman.manage')
        //     ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();

        return redirect()->back()
            ->with('success', 'Pengumuman berhasil dihapus.');
    }
}