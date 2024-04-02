<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    public function submitUmkm(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_umkm' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            // Tambahkan validasi untuk input lainnya jika diperlukan
        ]);

        // Simpan data UMKM ke dalam database
        $umkm = new Umkm();
        $umkm->nama = $request->nama_umkm;
        $umkm->deskripsi = $request->deskripsi;
        // Tambahkan penyimpanan untuk input lainnya jika diperlukan
        $umkm->save();

        // Redirect atau tampilkan respons berhasil
        return redirect()->back()->with('success', 'UMKM berhasil diajukan!');
    }
}
