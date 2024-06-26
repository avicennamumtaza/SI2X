<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use App\Models\Penduduk;
use App\Models\Rt;
use App\Models\Pengumuman;
use App\Models\Umkm;
use App\Models\PengajuanDokumen;
use App\Models\Users;
use Illuminate\Support\Facades\Cache;

class LandingController extends Controller
{
    public function index()
    {
        $jumlah_keluarga = Cache::remember('jumlah_keluarga', 100, function () {
            return Keluarga::count();
        });

        $jumlah_penduduk = Cache::remember('jumlah_penduduk', 100, function () {
            return Penduduk::count();
        });

        $jumlah_rt = Cache::remember('jumlah_rt', 100, function () {
            return Rt::count();
        });

        $jumlah_pengumuman = Cache::remember('jumlah_pengumuman', 100, function () {
            return Pengumuman::count();
        });

        $jumlah_umkm = Cache::remember('jumlah_umkm', 100, function () {
            return Umkm::count();
        });

        $jumlah_pengajuan_dokumen = Cache::remember('jumlah_pengajuan_dokumen', 100, function () {
            return PengajuanDokumen::count();
        });


        // START DATA UNTUK CONTAINER KENALAN
        $fotoUsers = Users::all()->pluck('foto_profil');
        $nikUsers = Users::all()->pluck('nik');
        foreach ($nikUsers as $nikUser) {
            $pendudukUser = Penduduk::where('nik', $nikUser);
            $titleUsers[] = Users::where('nik', $nikUser)->pluck('role');
            $namaUsers[] = $pendudukUser->pluck('nama');
            $rtUsers[] = $pendudukUser->pluck('no_rt');
        }
      
        $pengumuman = Pengumuman::orderBy('created_at', 'desc')->take(2)->get();
        $pengumuman1 = null;
        $pengumuman2 = null;

        // Memeriksa apakah $pengumuman tidak kosong sebelum mengakses elemen array
        if (!$pengumuman->isEmpty()) {
            $pengumuman1 = $pengumuman->first();
            $pengumuman2 = $pengumuman->count() > 1 ? $pengumuman->skip(1)->first() : null;
        }

        // Membuat array dengan nama variabel dan nilai untuk setiap jumlah data
        $data = [
            'jumlah_keluarga' => $jumlah_keluarga,
            'jumlah_penduduk' => $jumlah_penduduk,
            'jumlah_rt' => $jumlah_rt,
            'jumlah_pengumuman' => $jumlah_pengumuman,
            'jumlah_umkm' => $jumlah_umkm,
            'jumlah_pengajuan_dokumen' => $jumlah_pengajuan_dokumen,
        ];

        // Mengirimkan data ke view dalam bentuk array
        return view('landing', compact('data', 'pengumuman1', 'pengumuman2', 'fotoUsers', 'namaUsers', 'titleUsers', 'rtUsers'));
    }
}