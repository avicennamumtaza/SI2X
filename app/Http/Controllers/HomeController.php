<?php

namespace App\Http\Controllers;

use App\Charts\DataPendudukChart;
use App\Charts\DataPendudukRTChart;
use App\Charts\KasRWChart;
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
    public function index(DataPendudukChart $dataPendudukChart, KasRWChart $kasRWChart, DataPendudukRTChart $dataPendudukRTChart)
    {
        if (auth()->user()->role == 'RW') {
            $jumlahRt = Cache::remember('jumlahRt', 1, function () {
                return Rt::count();
            });

            $jumlahKeluarga = Cache::remember('jumlahKeluarga', 1, function () {
                return Keluarga::count();
            });

            $jumlahPenduduk = Cache::remember('jumlahPenduduk', 1, function () {
                return Penduduk::count();
            });

            $jumlahAnakAnak = Cache::remember('jumlahAnakAnak', 1, function () {
                $date = \Carbon\Carbon::now()->subYears(15)->format('Y-m-d');
                $penduduk = Penduduk::where('tanggal_lahir', '>', $date)->select(['nik', 'nama', 'tempat_lahir', 'tanggal_lahir'])->paginate(25);
                return $penduduk->count();
            });

            $jumlahUsiaProduktif = Cache::remember('jumlahUsiaProduktif', 1, function () {
                $dateMin = \Carbon\Carbon::now()->subYears(65)->format('Y-m-d');
                $dateMax = \Carbon\Carbon::now()->subYears(15)->format('Y-m-d');
                $penduduk = Penduduk::whereBetween('tanggal_lahir', [$dateMin, $dateMax]);
                return $penduduk->count();
            });

            $jumlahLansia = Cache::remember('jumlahLansia', 1, function () {
                $date = \Carbon\Carbon::now()->subYears(66)->format('Y-m-d');
                $penduduk = Penduduk::where('tanggal_lahir', '<=', $date)->select(['nik', 'nama', 'tempat_lahir', 'tanggal_lahir'])->paginate(25);
                return $penduduk->count();
            });

            $jumlahUmkmNew = Cache::remember('jumlahUmkmNew', 1, function () {
                return Umkm::where('status_umkm', 'Baru')->count();
            });

            $jumlahUmkmAcc = Cache::remember('jumlahUmkmAcc', 1, function () {
                return Umkm::where('status_umkm', 'Disetujui')->count();
            });

            $jumlahUmkmDec = Cache::remember('jumlahUmkmDec', 1, function () {
                return Umkm::where('status_umkm', 'Ditolak')->count();
            });

            $jumlahUmkm = Cache::remember('jumlahUmkm', 1, function () {
                return Umkm::count();
            });

            $jumlahPengumuman = Cache::remember('jumlahPengumuman', 1, function () {
                return Pengumuman::count();
            });

            $jumlahLaporanKeuangan = Cache::remember('jumlahLaporanKeuangan', 1, function () {
                return LaporanKeuangan::count();
            });

            $jumlahDokumen = Cache::remember('jumlahDokumen', 1, function () {
                return Dokumen::count();
            });

            $jumlahPengajuanDokumenNew = Cache::remember('jumlahPengajuanDokumenNew', 1, function () {
                return PengajuanDokumen::where('status_pengajuan', 'Baru')->count();
            });

            $jumlahPengajuanDokumenAcc = Cache::remember('jumlahPengajuanDokumenAcc', 1, function () {
                return PengajuanDokumen::where('status_pengajuan', 'Disetujui')->count();
            });

            $jumlahPengajuanDokumenDec = Cache::remember('jumlahPengajuanDokumenDec', 1, function () {
                return PengajuanDokumen::where('status_pengajuan', 'Ditolak')->count();
            });

            $jumlahPengajuanDokumen = Cache::remember('jumlahPengajuanDokumen', 1, function () {
                return PengajuanDokumen::count();
            });

            $data['dataPendudukChart'] = $dataPendudukChart->build();
            $dataKas['kasRWChart'] = $kasRWChart->build();
            
            

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
                'jumlahPengajuanDokumen',
                'data',
                'dataKas'
            ));

        } else if (auth()->user()->role == 'RT') {
            $rt = Rt::where('nik_rt', auth()->user()->nik)->first()->toArray();
            $noRt = $rt['no_rt']; // Simpan nomor RT di variabel
        
            $jumlahKeluarga = Cache::remember('jumlahKeluarga', 1, function () use ($noRt) {
                return Keluarga::where('no_rt', $noRt)->count();
            });
        
            $jumlahPenduduk = Cache::remember('jumlahPenduduk', 1, function () use ($noRt) {
                return Penduduk::where('no_rt', $noRt)->count();
            });
            
            $jumlahAnakAnak = Cache::remember('jumlahAnakAnak', 1, function () use ($noRt) {
                $date = \Carbon\Carbon::now()->subYears(15)->format('Y-m-d');
                $penduduk = Penduduk::where('no_rt', $noRt)->where('tanggal_lahir', '>', $date)->paginate(25);
                return $penduduk->total();
            });
            
            $jumlahUsiaProduktif = Cache::remember('jumlahUsiaProduktif', 1, function () use ($noRt) {
                $dateMin = \Carbon\Carbon::now()->subYears(65)->format('Y-m-d');
                $dateMax = \Carbon\Carbon::now()->subYears(15)->format('Y-m-d');
                $penduduk = Penduduk::where('no_rt', $noRt)->whereBetween('tanggal_lahir', [$dateMin, $dateMax])->paginate(25);
                return $penduduk->total();
            });
            
            $jumlahLansia = Cache::remember('jumlahLansia', 1, function () use ($noRt) {
                $date = \Carbon\Carbon::now()->subYears(66)->format('Y-m-d');
                $penduduk = Penduduk::where('no_rt', $noRt)->where('tanggal_lahir', '<=', $date)->paginate(25);
                return $penduduk->total();
            });
            

            $jumlahPengajuanDokumenNew = Cache::remember('jumlahPengajuanDokumenNew', 1, function () use ($noRt) {
                return PengajuanDokumen::whereHas('penduduk', function ($query) use ($noRt) {
                    $query->where('no_rt', $noRt);
                })->where('status_pengajuan', 'Baru')->count();
            });
            
            $jumlahPengajuanDokumenAcc = Cache::remember('jumlahPengajuanDokumenAcc', 1, function () use ($noRt) {
                return PengajuanDokumen::whereHas('penduduk', function ($query) use ($noRt) {
                    $query->where('no_rt', $noRt);
                })->where('status_pengajuan', 'Disetujui')->count();
            });
            
            $jumlahPengajuanDokumenDec = Cache::remember('jumlahPengajuanDokumenDec', 1, function () use ($noRt) {
                return PengajuanDokumen::whereHas('penduduk', function ($query) use ($noRt) {
                    $query->where('no_rt', $noRt);
                })->where('status_pengajuan', 'Ditolak')->count();
            });
            
            $jumlahPengajuanDokumen = Cache::remember('jumlahPengajuanDokumen', 1, function () use ($noRt) {
                return PengajuanDokumen::whereHas('penduduk', function ($query) use ($noRt) {
                    $query->where('no_rt', $noRt);
                })->count();
            });
            
            $dataPendRt['dataPendudukRTChart'] = $dataPendudukRTChart->build();
            return view('auth.dashboard', compact(
                'jumlahKeluarga',
                'jumlahPenduduk',
                'jumlahAnakAnak',
                'jumlahUsiaProduktif',
                'jumlahLansia',
                'jumlahPengajuanDokumenNew',
                'jumlahPengajuanDokumenAcc',
                'jumlahPengajuanDokumenDec',
                'jumlahPengajuanDokumen',
                'dataPendRt'
            ));
        }

        return view('auth.dashboard');
    }
}