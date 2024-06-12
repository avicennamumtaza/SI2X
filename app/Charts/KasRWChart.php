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

// Mulai dengan saldo awal (saldo pada akhir tahun sebelumnya atau awal tahun ini)
$saldoAwal = LaporanKeuangan::whereYear('tanggal', '<', $tahun)
    ->orderBy('tanggal', 'desc')
    ->value('saldo');

if ($saldoAwal === null) {
    $saldoAwal = 0;
}

$saldo = $saldoAwal;

for ($i = 1; $i <= $bulan; $i++) { 
    $totalPemasukan = LaporanKeuangan::whereYear('tanggal', $tahun)
        ->whereMonth('tanggal', $i)
        ->where('status_pemasukan', true)
        ->sum('nominal');

    $totalPengeluaran = LaporanKeuangan::whereYear('tanggal', $tahun)
        ->whereMonth('tanggal', $i)
        ->where('status_pemasukan', false)
        ->sum('nominal');

    // Hitung saldo berdasarkan pemasukan dan pengeluaran bulan ini
    $saldo += $totalPemasukan - $totalPengeluaran;

    Carbon::setLocale('id');
    $namaBulan = Carbon::create()->month($i)->translatedFormat('F');

    $dataBulan[] = $namaBulan;
    $dataTotalSaldo[] = $saldo;
}

return $this->chart->lineChart()
    ->setHeight(400)
    ->setWidth(950)  
    ->addData('Total Saldo', $dataTotalSaldo)
    ->setXAxis($dataBulan);

    }
}
    