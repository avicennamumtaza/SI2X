<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    public function submitUmkm(Request $request)
    {
        // dd($request->all());
        // Validasi input
        $request->validate([
            'nik_pemilik' => 'required|string|max:17',
            'nama_umkm' => 'required|string|max:50',
            'foto_umkm' => 'required|string|max:50',
            'desc_umkm' => 'required|string',
            // Tambahkan validasi untuk input lainnya jika diperlukan
        ]);

        // Simpan data UMKM ke dalam database
        $umkm = new Umkm();
        $umkm->nama_umkm = $request->nama_umkm;
        $umkm->nik_pemilik = $request->nik_pemilik;
        $umkm->foto_umkm = $request->foto_umkm;
        $umkm->desc_umkm = $request->desc_umkm;

        // Default value
        $umkm->no_rw = 6;
        $umkm->status_umkm = 'new';

        // Tambahkan penyimpanan untuk input lainnya jika diperlukan
        $umkm->save();

        // Redirect atau tampilkan respons berhasil
        return redirect()->back()->with('success', 'UMKM berhasil diajukan!');
    }
}
