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
            <div class="card-body">
                <div class="table-responsive">
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
                                    <td>{{ $laporanKeuangan->is_income ? 'Pemasukan' : 'Pengeluaran' }}</td>
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
