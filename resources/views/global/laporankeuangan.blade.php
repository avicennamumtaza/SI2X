@extends('layouts.app')

@section('content')
    <div class="container container-p col-10">
        <h1 class="heading-center">Laporan Keuangan</h1>
        <!-- <div class="container"> -->
        <p>Fitur Laporan Keuangan memainkan peran penting dalam meningkatkan transparansi dan akuntabilitas.
            Melalui fitur ini, penduduk memiliki akses untuk melihat laporan keuangan RW. Sehingga dapat memberikan gambaran
            yang jelas tentang pendapatan, pengeluaran, serta alokasi dana untuk berbagai kegiatan di lingkungan RW.</p>

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
                                <b>Rp {{ number_format($saldo, 0, ',', '.') }}</b>
                            </h2>
                        </div>
                    </div>
                    {{-- </div> --}}
                </div>
                {{-- </div> --}}
            </div>
            <div class="table-responsive px-2 mb-2">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            {{-- <th>Nomor</th> --}}
                            <th title="Tanggal" style="width: 12%">Tanggal</th>
                            <th title="Jenis Laporan" style="width: 12%">Laporan</th>
                            <th title="Detail">Detail</th>
                            <th title="Nominal" style="width: 15%">Nominal</th>
                            <th title="Saldo" style="width: 15%">Saldo</th>
                            {{-- <th>Pihak Terlibat</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporankeuangans as $laporanKeuangan)
                            <tr>
                                {{-- <td>{{ $loop->iteration }}</td> --}}
                                <td title="Tanggal" style="width: 12%">{{ $laporanKeuangan->tanggal }}</td>
                                <td title="Jenis Laporan" style="width: 12%">
                                    {{ $laporanKeuangan->status_pemasukan ? 'Pemasukan' : 'Pengeluaran' }}</td>
                                <td title="Detail">{{ $laporanKeuangan->detail }}</td>
                                <td title="Nominal" style="width: 15%">Rp
                                    {{ number_format($laporanKeuangan->nominal, 0, ',', '.') }}</td>
                                <td title="Saldo" style="width: 15%">Rp
                                    {{ number_format($laporanKeuangan->saldo, 0, ',', '.') }}</td>
                                {{-- <td>{{ $laporanKeuangan->pihak_terlibat }}</td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mx-4" style="margin-block: -0.5rem">
                {{ $laporankeuangans->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
@endsection
