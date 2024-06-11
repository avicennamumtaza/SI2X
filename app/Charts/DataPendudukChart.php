<?php
namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Penduduk;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache; 


class DataPendudukChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $jumlahAnakAnak = Cache::remember('jumlahAnakAnak', 100, function () {
            $date = Carbon::now()->subYears(15)->format('Y-m-d');
            $penduduk = Penduduk::where('tanggal_lahir', '>', $date)->select(['nik', 'nama', 'tempat_lahir', 'tanggal_lahir']);
            return $penduduk->count();
        });

        $jumlahUsiaProduktif = Cache::remember('jumlahUsiaProduktif', 100, function () {
            $dateMin = Carbon::now()->subYears(65)->format('Y-m-d');
            $dateMax = Carbon::now()->subYears(15)->format('Y-m-d');
            $penduduk = Penduduk::whereBetween('tanggal_lahir', [$dateMin, $dateMax]);
            return $penduduk->count();
        });

        $jumlahLansia = Cache::remember('jumlahLansia', 100, function () {
            $date = Carbon::now()->subYears(65)->format('Y-m-d');
            return Penduduk::where('tanggal_lahir', '<=', $date)->count();
        });
       

        return $this->chart->pieChart()
        // ->setSubtitle('Data Tahun 2024')
        ->setFontFamily('Poppins, sans-serif')
        ->setWidth(600)   
        ->setHeight(360)
        ->setStroke(1)
        ->addData([$jumlahAnakAnak, $jumlahUsiaProduktif, $jumlahLansia])
        ->setLabels([
            'Anak-Anak ' ,
            'Usia Produktif ',
            'Lansia '
        ]);
            
        }
}