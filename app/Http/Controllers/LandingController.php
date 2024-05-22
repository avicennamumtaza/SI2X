<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use App\Models\Penduduk;
use App\Models\RT;
use App\Models\Pengumuman;
use App\Models\Umkm;
use App\Models\PengajuanDokumen;

class LandingController extends Controller
{
    public function index()
    {
        // Mengambil jumlah baris data dari masing-masing model
        $jumlah_keluarga = Keluarga::count();
        $jumlah_penduduk = Penduduk::count();
        $jumlah_rt = RT::count();
        $jumlah_pengumuman = Pengumuman::count();
        $jumlah_umkm = Umkm::count();
        $jumlah_pengajuan_dokumen = PengajuanDokumen::count();
        // $pengumuman = Pengumuman::where('id_pengumuman', 8)->first();
        $pengumuman = Pengumuman::orderBy('created_at', 'desc')->take(2)->get();
        $pengumuman1 = $pengumuman[0];
        $pengumuman2 = $pengumuman[1];
        // dd($pengumuman2);
        
        // Membuat array dengan nama variabel dan nilai untuk setiap jumlah data
        $data = [
            'jumlah_keluarga' => $jumlah_keluarga,
            'jumlah_penduduk' => $jumlah_penduduk,
            'jumlah_rt' => $jumlah_rt,
            'jumlah_pengumuman' => $jumlah_pengumuman,
            'jumlah_umkm' => $jumlah_umkm,
            'jumlah_pengajuan_dokumen' => $jumlah_pengajuan_dokumen,
        ];
        // 'pengumumans' => $pengumumans,
    
        // Mengirimkan data ke view dalam bentuk array
        return view('landing', compact('data', 'pengumuman1', 'pengumuman2'));
    }    
}