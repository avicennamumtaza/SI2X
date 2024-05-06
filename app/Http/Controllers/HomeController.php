<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Keluarga;
use App\Models\LaporanKeuangan;
use App\Models\Penduduk;
use App\Models\PengajuanDokumen;
use App\Models\Pengumuman;
use App\Models\Rt;
use App\Models\Rw;
use App\Models\Umkm;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->role == 'Rw') {
            // $tahunSekarang = Carbon::now()->year;
    
            // $jumlahRw = Rw::count();
            $jumlahRt = Rt::count();
            $jumlahKeluarga = Keluarga::count();
            $jumlahPenduduk = Penduduk::count();
            $jumlahAnakAnak = Penduduk::whereRaw("YEAR(CURDATE()) - YEAR(tanggal_lahir) < 15")->count();
            $jumlahUsiaProduktif = Penduduk::whereRaw("YEAR(CURDATE()) - YEAR(tanggal_lahir) >= 15 AND YEAR(CURDATE()) - YEAR(tanggal_lahir) < 65")->count();
            $jumlahLansia = Penduduk::whereRaw("YEAR(CURDATE()) - YEAR(tanggal_lahir) >= 65")->count();
            $jumlahUmkmNew = Umkm::where('status_umkm', 'Baru')->count();
            $jumlahUmkmAcc = Umkm::where('status_umkm', 'Disetujui')->count();
            $jumlahUmkmDec = Umkm::where('status_umkm', 'Ditolak')->count();
            $jumlahUmkm = Umkm::count();
            $jumlahPengumuman = Pengumuman::count();
            $jumlahLaporanKeuangan = LaporanKeuangan::count();
            $jumlahDokumen = Dokumen::count();
            $jumlahPengajuanDokumenNew = PengajuanDokumen::where('status_pengajuan', 'Baru')->count();
            $jumlahPengajuanDokumenAcc = PengajuanDokumen::where('status_pengajuan', 'Disetujui')->count();
            $jumlahPengajuanDokumenDec = PengajuanDokumen::where('status_pengajuan', 'Ditolak')->count();
            $jumlahPengajuanDokumen = PengajuanDokumen::count();
            
            return view('layouts.dashboard', compact(
                // 'jumlahRw', 
                'jumlahRt', 
                'jumlahKeluarga', 
                'jumlahPenduduk', 
                'jumlahAnakAnak', 
                'jumlahUsiaProduktif', 
                'jumlahLansia', 
                'jumlahUmkmNew', 
                'jumlahUmkmAcc', 
                'jumlahUmkmDec', 
                'jumlahUmkm', 
                'jumlahPengumuman', 
                'jumlahLaporanKeuangan', 
                'jumlahDokumen', 
                'jumlahPengajuanDokumenNew', 
                'jumlahPengajuanDokumenAcc', 
                'jumlahPengajuanDokumenDec', 
                'jumlahPengajuanDokumen'
            ));
        }        
        return view('layouts.dashboard');
    }
}
