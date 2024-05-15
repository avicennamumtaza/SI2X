<?php

namespace App\Http\Controllers;

use App\DataTables\PengumumanDataTable;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
            $validated = $request->validate([
                'judul_pengumuman' => 'required|min:5|max:49',
                'deskripsi' => 'required',
                'tanggal_pengumuman' => 'required|date',
                'foto_pengumuman' => 'required|mimes:png,jpg,jpeg',
            ]);

            $foto_pengumuman = $request->file('foto_pengumuman');
            $foto_pengumuman_ext = $foto_pengumuman->getClientOriginalExtension();;
            $foto_pengumuman_filename = $validated['judul_pengumuman'] . date('ymdhis') . "." . $foto_pengumuman_ext;
    
            
            try {
                Pengumuman::create([
                    'judul' => $validated['judul_pengumuman'],
                    'deskripsi' => $validated['deskripsi'],
                    'tanggal' => $validated['tanggal_pengumuman'],
                    'foto_pengumuman' => $foto_pengumuman_filename,
                ]);
                $foto_pengumuman->move(public_path('Foto Pengumuman'), $foto_pengumuman_filename);
                return redirect()->back()->with('success', 'Pengumuman berhasil dipublish!');
            } catch (\Exception $e) {
                Alert::error('Oops!', $e->getMessage());
                return redirect()->back();
            }
    }

    public function edit(Pengumuman $pengumuman)
    {
        // $pengumuman = Pengumuman::findOrFail($pengumuman->id_pengumuman);
        return view('pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $validated = $request->validate([
            'judul_pengumuman' => 'required|min:5|max:49',
            'deskripsi' => 'required',
            'tanggal_pengumuman' => 'required|date',
            'foto_pengumuman' => 'image|mimes:jpeg,jpg,png',
         ]);

        $pengumuman->update([
            'judul' => $validated['judul_pengumuman'],
            'deskripsi' => $validated['deskripsi'],
            'tanggal' => $validated['tanggal_pengumuman'],
            // 'foto' => $request->foto_pengumuman,
            // 'foto_pengumuman' => $validated['foto_pengumuman'],
        ]);

        if($request->hasFile('foto_pengumuman') ){         
            $foto_pengumuman = $request->file('foto_pengumuman');
            $foto_pengumuman_ext = $foto_pengumuman->getClientOriginalExtension();;
            $foto_pengumuman_filename = $validated['judul_pengumuman'] . date('ymdhis') . "." . $foto_pengumuman_ext;
            
            // Hapus foto lama dari sistem penyimpanan
        if ($pengumuman->foto_pengumuman) {
            File::delete(public_path('Foto Pengumuman') . '/' . $pengumuman->foto_pengumuman);
        }
         // Simpan foto baru ke sistem penyimpanan
         $foto_pengumuman->move(public_path('Foto Pengumuman'), $foto_pengumuman_filename);
         $pengumuman->update(['foto_pengumuman' => $foto_pengumuman_filename]);
        
        }

        return redirect()->route('pengumuman.manage')->with('success', 'Pengumuman berhasil dipublish.');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        File::delete(public_path('Foto Pengumuman') . '/' . $pengumuman->foto_pengumuman);
        $pengumuman->delete();
        return redirect()->back()
            ->with('success', 'Pengumuman berhasil dihapus.');
    }
}