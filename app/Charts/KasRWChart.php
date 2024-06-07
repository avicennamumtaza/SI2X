<?php

namespace App\Charts;
use Carbon\Carbon;


use App\Models\LaporanKeuangan;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class KasRWChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $tahun = date('Y');
        $bulan = date('m');
        $dataBulan = [];
        $dataTotalSaldo = [];
    
        for ($i = 1; $i <= $bulan; $i++) { 
            $totalPemasukan = LaporanKeuangan::whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $i)
                ->where('status_pemasukan', true) // Filter berdasarkan status pemasukan
                ->sum('nominal');
    
            $totalPengeluaran = LaporanKeuangan::whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $i)
                ->where('status_pemasukan', false) // Filter berdasarkan status pengeluaran
                ->sum('nominal');
    
            // Hitung saldo berdasarkan pemasukan dan pengeluaran
            $totalSaldo = $totalPemasukan - $totalPengeluaran;
            Carbon::setLocale('id');
            $namaBulan = Carbon::create()->month($i)->translatedFormat('F');

            $dataBulan[] = $namaBulan;
            $dataTotalSaldo[] = $totalSaldo;
        }
    
        return $this->chart->lineChart()
            ->setTitle('Kas RW 06 Jodipan.')
            ->setHeight(400)
            ->setWidth(950)  
            ->addData('Total Saldo', $dataTotalSaldo)
            ->setXAxis($dataBulan);
    }
}
    