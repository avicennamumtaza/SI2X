@extends('layouts.app')

@section('content')
    <div class="container container-p col-10">
        <h1 class="heading-center">Laporan Keuangan</h1>
        <!-- <div class="container"> -->
        <p>Fitur laporan keuangan dalam SIRW memainkan peran penting dalam meningkatkan transparansi dan akuntabilitas.
            Melalui fitur ini, warga memiliki akses untuk melihat laporan keuangan. Laporan tersebut memberikan gambaran
            yang jelas tentang pendapatan, pengeluaran, serta alokasi dana untuk berbagai program di lingkungan RW.</p>

        <div class="card">
            <div class="card-header card-header-tabel p-4 mb-3">
                <h5>
                    Laporan Keuangan
                    {{-- <button class="btn btn-add float-end" data-bs-toggle="modal" data-bs-target="#ajukanpengumumanModal">Tambah Data</button> --}}
                </h5>
            </div>
            <hr class="tabel">
            {{-- <div class="card-body"> --}}
                <div class="col-xl-5 mx-3 col-md-12">
                    {{-- <div class="card" style="border: none;"> --}}
                        <div class="card-body">
                            {{-- <div class="d-flex justify-content-start p-md-1"> --}}
                                <div class="text-start">
                                    <div class="align-self-center">
                                        <h3>Kas RW</h3>
                                    </div>
                                    <div class="align-self-center">
                                        <h2 class="">
                                            <?php
                                                $saldo = 0;
                                                foreach ($laporanKeuangans as $laporanKeuangan) {
                                                    if ($laporanKeuangan->status_pemasukan) {
                                                        $saldo += $laporanKeuangan->nominal;
                                                    } else {
                                                        $saldo -= $laporanKeuangan->nominal;
                                                    }
                                                }
                                            ?>
                                            <b>&nbsp; Rp&nbsp;{{ number_format($saldo, 0, ',', '.') }}</b>
                                        </h2>
                                    </div>
                                </div>
                            {{-- </div> --}}
                        </div>
                    {{-- </div> --}}
                </div>
                <div class="table-responsive px-4">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Jenis Laporan</th>
                                <th>Nominal</th>
                                <th>Detail</th>
                                <th>Tanggal</th>
                                {{-- <th>Pihak Terlibat</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($laporanKeuangans as $laporanKeuangan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $laporanKeuangan->status_pemasukan ? 'Pemasukan' : 'Pengeluaran' }}</td>
                                    <td>Rp {{ number_format($laporanKeuangan->nominal, 0, ',', '.') }}</td>
                                    <td>{{ $laporanKeuangan->detail }}</td>
                                    <td>{{ $laporanKeuangan->tanggal }}</td>
                                    {{-- <td>{{ $laporanKeuangan->pihak_terlibat }}</td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
