<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Penduduk;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache; 
use App\Models\Rt;

class DataPendudukRTChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    { 
        $rt = Rt::where('nik_rt', auth()->user()->nik)->first()->toArray();
        $noRt = $rt['no_rt']; // Simpan nomor RT di variabel
        
        $jumlahAnakAnak = Cache::remember('jumlahAnakAnak', 600, function () use ($noRt) {
        $date = \Carbon\Carbon::now()->subYears(15)->format('Y-m-d');
        $penduduk = Penduduk::where('no_rt', $noRt)->where('tanggal_lahir', '>', $date)->paginate(25);
        return $penduduk->total();
    });
    
    $jumlahUsiaProduktif = Cache::remember('jumlahUsiaProduktif', 600, function () use ($noRt) {
        $dateMin = \Carbon\Carbon::now()->subYears(65)->format('Y-m-d');
        $dateMax = \Carbon\Carbon::now()->subYears(15)->format('Y-m-d');
        $penduduk = Penduduk::where('no_rt', $noRt)->whereBetween('tanggal_lahir', [$dateMin, $dateMax])->paginate(25);
        return $penduduk->total();
    });
    
    $jumlahLansia = Cache::remember('jumlahLansia', 600, function () use ($noRt) {
        $date = \Carbon\Carbon::now()->subYears(66)->format('Y-m-d');
        $penduduk = Penduduk::where('no_rt', $noRt)->where('tanggal_lahir', '<=', $date)->paginate(25);
        return $penduduk->total();
    });
        return $this->chart->pieChart() 
            ->setFontFamily('Poppins, sans-serif')
            ->setWidth(600)
            ->setHeight(360)
            ->setStroke(1)
            ->addData([$jumlahAnakAnak, $jumlahUsiaProduktif, $jumlahLansia])
            ->setLabels(['Anak-Anak ' ,
            'Usia Produktif ',
            'Lansia ']);
    }
}