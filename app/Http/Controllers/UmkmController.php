<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    public function index()
    {
        $umkms = Umkm::where('status_umkm', 'Diterima')->get();
        return view('global.umkm')->with('umkms', $umkms);
        // return view('global.umkm');
    }
    // Fungsi tambahan untuk menampilkan seluruh data UMKM
    public function list()
    {
        $umkms = Umkm::all();
        return view('auth.rw.umkm')->with('umkms', $umkms);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        // Validasi input
        $request->validate([
            'nik_pemilik' => 'required|string|max:17',
            'nama_umkm' => 'required|string|max:50',
            'foto_umkm' => 'required|string|max:50',
            'desc_umkm' => 'required|string',
            'wa_umkm' => 'required|string',
            // Tambahkan validasi untuk input lainnya jika diperlukan
        ]);

        // Simpan data UMKM ke dalam database
        $umkm = new Umkm();
        $umkm->nama_umkm = $request->nama_umkm;
        $umkm->nik_pemilik = $request->nik_pemilik;
        $umkm->foto_umkm = $request->foto_umkm;
        $umkm->desc_umkm = $request->desc_umkm;
        $umkm->wa_umkm = $request->wa_umkm;
        $umkm->no_rw = 6;
        $umkm->status_umkm = 'Baru';
        $umkm->save();

        return redirect()->back()->with('success', 'UMKM berhasil diajukan!');
    }
    public function destroy($id)
    {
        $umkm = Umkm::findOrFail($id);
        $umkm->delete();
        return redirect()->back()->with('success', 'UMKM berhasil dihapus!');
    }
}
