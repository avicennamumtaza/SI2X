<?php
namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Penduduk;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache; // Import the Cache facade

class DataPendudukChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $jumlahAnakAnak = Cache::remember('jumlahAnakAnak', 600, function () {
            $date = Carbon::now()->subYears(15)->format('Y-m-d');
            $penduduk = Penduduk::where('tanggal_lahir', '>', $date)->select(['nik', 'nama', 'tempat_lahir', 'tanggal_lahir'])->paginate(25);
            return $penduduk->count();
        });

        $jumlahUsiaProduktif = Cache::remember('jumlahUsiaProduktif', 600, function () {
            $dateMin = Carbon::now()->subYears(65)->format('Y-m-d');
            $dateMax = Carbon::now()->subYears(15)->format('Y-m-d');
            $penduduk = Penduduk::whereBetween('tanggal_lahir', [$dateMin, $dateMax]);
            return $penduduk->count();
        });

        $jumlahLansia = Cache::remember('jumlahLansia', 600, function () {
            $date = Carbon::now()->subYears(65)->format('Y-m-d');
            return Penduduk::where('tanggal_lahir', '<=', $date)->count();
        });
       

        return $this->chart->pieChart()
        ->setTitle('Distribusi Penduduk Rw 06 Jodipan Malang Berdasarkan Usia')
        // ->setSubtitle('Data Tahun 2024')
        ->setWidth(600)   
        ->setHeight(400)
        ->addData([$jumlahAnakAnak, $jumlahUsiaProduktif, $jumlahLansia])
        ->setLabels([
            'Anak-Anak' ,
            'Usia Produktif ',
            'Lansia: '
        ]);
            
        }
}