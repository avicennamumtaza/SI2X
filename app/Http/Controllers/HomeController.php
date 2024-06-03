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
use Illuminate\Support\Facades\Cache;

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
        if (auth()->user()->role == 'RW') {
            $jumlahRt = Cache::remember('jumlahRt', 600, function () {
                return Rt::count();
            });

            $jumlahKeluarga = Cache::remember('jumlahKeluarga', 600, function () {
                return Keluarga::count();
            });

            $jumlahPenduduk = Cache::remember('jumlahPenduduk', 600, function () {
                return Penduduk::count();
            });

            $jumlahAnakAnak = Cache::remember('jumlahAnakAnak', 600, function () {
                $date = \Carbon\Carbon::now()->subYears(15)->format('Y-m-d');
                $penduduk = Penduduk::where('tanggal_lahir', '>', $date)->select(['nik', 'nama', 'tempat_lahir', 'tanggal_lahir'])->paginate(25);
                return $penduduk->count();
            });

            $jumlahUsiaProduktif = Cache::remember('jumlahUsiaProduktif', 600, function () {
                $dateMin = \Carbon\Carbon::now()->subYears(65)->format('Y-m-d');
                $dateMax = \Carbon\Carbon::now()->subYears(15)->format('Y-m-d');
                $penduduk = Penduduk::whereBetween('tanggal_lahir', [$dateMin, $dateMax]);
                return $penduduk->count();
            });

            $jumlahLansia = Cache::remember('jumlahLansia', 600, function () {
                $date = \Carbon\Carbon::now()->subYears(66)->format('Y-m-d');
                $penduduk = Penduduk::where('tanggal_lahir', '<=', $date)->select(['nik', 'nama', 'tempat_lahir', 'tanggal_lahir'])->paginate(25);
                return $penduduk->count();
            });

            $jumlahUmkmNew = Cache::remember('jumlahUmkmNew', 600, function () {
                return Umkm::where('status_umkm', 'Baru')->count();
            });

            $jumlahUmkmAcc = Cache::remember('jumlahUmkmAcc', 600, function () {
                return Umkm::where('status_umkm', 'Disetujui')->count();
            });

            $jumlahUmkmDec = Cache::remember('jumlahUmkmDec', 600, function () {
                return Umkm::where('status_umkm', 'Ditolak')->count();
            });

            $jumlahUmkm = Cache::remember('jumlahUmkm', 600, function () {
                return Umkm::count();
            });

            $jumlahPengumuman = Cache::remember('jumlahPengumuman', 600, function () {
                return Pengumuman::count();
            });

            $jumlahLaporanKeuangan = Cache::remember('jumlahLaporanKeuangan', 600, function () {
                return LaporanKeuangan::count();
            });

            $jumlahDokumen = Cache::remember('jumlahDokumen', 600, function () {
                return Dokumen::count();
            });

            $jumlahPengajuanDokumenNew = Cache::remember('jumlahPengajuanDokumenNew', 600, function () {
                return PengajuanDokumen::where('status_pengajuan', 'Baru')->count();
            });

            $jumlahPengajuanDokumenAcc = Cache::remember('jumlahPengajuanDokumenAcc', 600, function () {
                return PengajuanDokumen::where('status_pengajuan', 'Disetujui')->count();
            });

            $jumlahPengajuanDokumenDec = Cache::remember('jumlahPengajuanDokumenDec', 600, function () {
                return PengajuanDokumen::where('status_pengajuan', 'Ditolak')->count();
            });

            $jumlahPengajuanDokumen = Cache::remember('jumlahPengajuanDokumen', 600, function () {
                return PengajuanDokumen::count();
            });

            return view('auth.dashboard', compact(
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
        } else if (auth()->user()->role == 'RT') {
            $jumlahKeluarga = Cache::remember('jumlahKeluarga', 600, function () {
                return Keluarga::count();
            });

            $jumlahPenduduk = Cache::remember('jumlahPenduduk', 600, function () {
                return Penduduk::count();
            });

            $jumlahAnakAnak = Cache::remember('jumlahAnakAnak', 600, function () {
                return Penduduk::whereRaw("YEAR(CURDATE()) - YEAR(tanggal_lahir) < 15")->count();
            });

            $jumlahUsiaProduktif = Cache::remember('jumlahUsiaProduktif', 600, function () {
                return Penduduk::whereRaw("YEAR(CURDATE()) - YEAR(tanggal_lahir) >= 15 AND YEAR(CURDATE()) - YEAR(tanggal_lahir) < 65")->count();
            });

            $jumlahLansia = Cache::remember('jumlahLansia', 600, function () {
                return Penduduk::whereRaw("YEAR(CURDATE()) - YEAR(tanggal_lahir) >= 65")->count();
            });

            $jumlahPengajuanDokumenNew = Cache::remember('jumlahPengajuanDokumenNew', 600, function () {
                return PengajuanDokumen::where('status_pengajuan', 'Baru')->count();
            });

            $jumlahPengajuanDokumenAcc = Cache::remember('jumlahPengajuanDokumenAcc', 600, function () {
                return PengajuanDokumen::where('status_pengajuan', 'Disetujui')->count();
            });

            $jumlahPengajuanDokumenDec = Cache::remember('jumlahPengajuanDokumenDec', 600, function () {
                return PengajuanDokumen::where('status_pengajuan', 'Ditolak')->count();
            });

            $jumlahPengajuanDokumen = Cache::remember('jumlahPengajuanDokumen', 600, function () {
                return PengajuanDokumen::count();
            });

            return view('auth.dashboard', compact(
                'jumlahKeluarga',
                'jumlahPenduduk',
                'jumlahAnakAnak',
                'jumlahUsiaProduktif',
                'jumlahLansia',
                'jumlahPengajuanDokumenNew',
                'jumlahPengajuanDokumenAcc',
                'jumlahPengajuanDokumenDec',
                'jumlahPengajuanDokumen'
            ));
        }

        return view('auth.dashboard');
    }
}