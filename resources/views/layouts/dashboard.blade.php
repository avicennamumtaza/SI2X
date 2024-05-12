@extends('layouts.sidebar')

@section('content')
    <div class="container-fluid">
        @can('isRt')
            <section>
                <div class="row">
                    <div class="col-12 mt-3 mb-3">
                        <h2 class="">Dashboard RT</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt unde perspiciatis sit blanditiis
                            fugit, nemo deleniti quaerat? Corrupti quis culpa eum aut impedit perferendis harum maxime aperiam!
                        </p>
                        <br>
                        <h4>Statistik Pendataan Penduduk &amp; Keluarga</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <i class="bi bi-house text-info fa-3x"></i>
                                        </div>
                                        <div class="mx-4">
                                            <h4>Total Posts</h4>
                                            <p class="mb-0">Monthly blog posts</p>
                                        </div>
                                    </div>
                                    <div class="align-self-center">
                                        <h2 class="h3 mb-0">999</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <i class="bi bi-house text-warning fa-3x"></i>
                                        </div>
                                        <div class="mx-4">
                                            <h4>Total Comments</h4>
                                            <p class="mb-0">Monthly blog posts</p>
                                        </div>
                                    </div>
                                    <div class="align-self-center">
                                        <h2 class="h3 mb-0">999</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4 col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <h2 class="h3 mb-0 me-4">999</h2>
                                        </div>
                                        <div>
                                            <h4>Pengajuan Ditolak</h4>
                                            <p class="mb-0">Pengajuan Ditolak</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <h2 class="h3 mb-0 me-4">999</h2>
                                        </div>
                                        <div>
                                            <h4>Pengajuan Ditolak</h4>
                                            <p class="mb-0">Pengajuan Ditolak</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <h2 class="h3 mb-0 me-4">999</h2>
                                        </div>
                                        <div>
                                            <h4>Pengajuan Ditolak</h4>
                                            <p class="mb-0">Pengajuan Ditolak</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mt-3 mb-3">
                        <h4>Statistik Permintaan Dokumen</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4 col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <h2 class="h3 mb-0 me-4">999</h2>
                                        </div>
                                        <div>
                                            <h4>Total Cost</h4>
                                            <p class="mb-0">Pengajuan Ditolak</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <h2 class="h3 mb-0 me-4">999</h2>
                                        </div>
                                        <div>
                                            <h4>Total Cost</h4>
                                            <p class="mb-0">Pengajuan Ditolak</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <h2 class="h3 mb-0 me-4">999</h2>
                                        </div>
                                        <div>
                                            <h4>Total Cost</h4>
                                            <p class="mb-0">Pengajuan Ditolak</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endcan






        @can('isRw')
            <section>
                <div class="row">
                    <div class="col-12 mt-3 mb-3">
                        <h2 class="">Dashboard RW</h2>
                        <p class="h5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt unde perspiciatis
                            sit blanditiis
                            fugit, nemo deleniti quaerat? Corrupti quis culpa eum aut impedit perferendis harum maxime aperiam!
                        </p>
                        <hr class="mt-4 mb-5" style="height: 2px;">
                        <h4>Statistik Penggunaan Layanan</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt unde perspiciatis sit blanditiis
                            fugit, nemo deleniti quaerat? Corrupti quis culpa eum aut impedit perferendis harum maxime aperiam!
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <h2 class="h3 mb-0 me-3">{{ $jumlahLaporanKeuangan }}</h2>
                                        </div>
                                        <div>
                                            <h5 style="margin-bottom: 0px;">Laporan Keuangan</h5>
                                            {{-- <p class="mb-0">0-14 tahun</p> --}}
                                        </div>
                                    </div>
                                    {{-- <a href="{{ route('laporankeuangan.manage') }}" style="text-decoration: none">
                                        <button type="button" class="mt-2 btn primary position-relative">
                                            >
                                        </button>
                                    </a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <h2 class="h3 mb-0 me-3">{{ $jumlahPengumuman }}</h2>
                                        </div>
                                        <div>
                                            <h5 style="margin-bottom: 0px;">Publikasi Pengumuman</h5>
                                            {{-- <p class="mb-0">15-64 tahun</p> --}}
                                        </div>
                                    </div>
                                    {{-- <a href="{{ route('pengumuman.manage') }}" style="text-decoration: none">
                                        <button type="button" class="mt-2 btn primary position-relative">
                                            >
                                        </button>
                                    </a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <h2 class="h3 mb-0 me-3">{{ $jumlahUmkm }}</h2>
                                        </div>
                                        <div>
                                            <h5 style="margin-bottom: 0px;">Pengajuan UMKM</h5>
                                            {{-- <p class="mb-0">Pengajuan Ditolak</p> --}}
                                        </div>
                                    </div>
                                    {{-- <a href="{{ route('umkm.manage') }}" style="text-decoration: none">
                                        <button type="button" class="mt-2 btn primary position-relative">
                                            >
                                        </button>
                                    </a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <h2 class="h3 mb-0 me-3">{{ $jumlahPengajuanDokumen }}</h2>
                                        </div>
                                        <div>
                                            <h5 style="margin-bottom: 0px;">Permintaan Dokumen</h5>
                                            {{-- <p class="mb-0">Pengajuan Ditolak</p> --}}
                                        </div>
                                    </div>
                                    {{-- <a href="{{ route('umkm.manage') }}" style="text-decoration: none">
                                        <button type="button" class="mt-2 btn primary position-relative">
                                            >
                                        </button>
                                    </a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="row">
                    <div class="col-12 mt-3 mb-3">
                        <h4>Statistik Pendataan Penduduk Secara Keseluruhan dan Klasifikasi Berdasarkan Usia</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati illo excepturi atque qui, corrupti
                            quis beatae maiores laudantium error enim, ratione eaque hic, ab unde.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <h2 class="h3 mb-0 me-4">{{ $jumlahPenduduk }}</h2>
                                        </div>
                                        <div>
                                            <h4 style="margin-bottom: 2px;">Penduduk</h4>
                                            <p class="mb-0">Jumlah Penduduk Secara Keseluruhan</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('penduduk.manage') }}" style="text-decoration: none">
                                        <button type="button" class="mt-2 btn primary position-relative">
                                            >
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6 col-md-6 col-sm-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <h2 class="h3 mb-0 me-4">{{ $jumlahKeluarga }}</h2>
                                        </div>
                                        <div>
                                            <h4 style="margin-bottom: 2px;">Keluarga</h4>
                                            <p class="mb-0">Jumlah Kepala Keluarga</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('keluarga.manage') }}" style="text-decoration: none">
                                        <button type="button" class="mt-2 btn primary position-relative">
                                            >
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <h2 class="h3 mb-0 me-4">{{ $jumlahRt }}</h2>
                                        </div>
                                        <div>
                                            <h4 style="margin-bottom: 2px;">RT</h4>
                                            <p class="mb-0">Jumlah Ketua Rukun Tetangga</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('rt.manage') }}" style="text-decoration: none">
                                        <button type="button" class="mt-2 btn primary position-relative">
                                            >
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4 col-md-4 col-sm-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <h2 class="h3 mb-0 me-4">{{ $jumlahAnakAnak }}</h2>
                                        </div>
                                        <div>
                                            <h4 style="margin-bottom: 3px;">Anak-anak</h4>
                                            <p class="mb-0">Jumlah Penduduk Dengan Usia < 14 tahun</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 col-sm-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <h2 class="h3 mb-0 me-4">{{ $jumlahUsiaProduktif }}</h2>
                                        </div>
                                        <div>
                                            <h4 style="margin-bottom: 3px;">Usia Produktif</h4>
                                            <p class="mb-0">Jumlah Penduduk Dengan Usia 15-64 tahun</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 col-sm-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <h2 class="h3 mb-0 me-4">{{ $jumlahLansia }}</h2>
                                        </div>
                                        <div>
                                            <h4 style="margin-bottom: 3px;">Lanjut Usia</h4>
                                            <p class="mb-0">Jumlah Penduduk Dengan Usia > 65 tahun</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="row">
                    <div class="col-12 mt-3 mb-3">
                        <h4>Statistik Permintaan Dokumen</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati illo excepturi atque qui, corrupti
                            quis beatae maiores laudantium error enim, ratione eaque hic, ab unde.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        {{-- <span class="position-absolute top-0 me-5 start-50 translate-middle badge rounded-pill bg-warning">
                                            Permintaan Dokumen Belum Diproses : {{ $jumlahPengajuanDokumenNew }}
                                          <span class="visually-hidden">unread messages</span>
                                        </span> --}}
                                        <div class="align-self-center">
                                            <h2 class="h3 mb-0 me-4">{{ $jumlahPengajuanDokumen }}</h2>
                                        </div>
                                        <div>
                                            <h4 style="margin-bottom: 2px;">Permintaan Dokumen</h4>
                                            <p class="mb-0">Jumlah Permintaan Dokumen Secara Keseluruhan</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('pengajuandokumen.manage') }}" style="text-decoration: none">
                                        <button type="button" class="mt-2 btn primary position-relative">
                                            Selengkapnya
                                            @if ($jumlahPengajuanDokumenNew > 0)
                                                <span class="badge bg-danger rounded-pill position-absolute top-0 end-0"
                                                    style="margin-top: -5px; margin-right: -5px;">
                                                    {{ $jumlahPengajuanDokumenNew }}
                                                    <span class="visually-hidden">unread messages</span>
                                            @endif
                                            </span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6 col-md-6 col-sm-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <i class="lni lni-printer text-success"></i>
                                        </div>
                                        <div class="mx-4">
                                            <h4 style="margin-bottom: 0px">Permintaan Dokumen Disetujui</h4>
                                            {{-- <p class="mb-0">Monthly blog posts</p> --}}
                                        </div>
                                    </div>
                                    <div class="align-self-center">
                                        <h2 class="h3 mb-0">{{ $jumlahPengajuanDokumenAcc }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <i class="lni lni-printer text-danger"></i>
                                        </div>
                                        <div class="mx-4">
                                            <h4 style="margin-bottom: 0px">Permintaan Dokumen Ditolak</h4>
                                            {{-- <p class="mb-0">Monthly blog posts</p> --}}
                                        </div>
                                    </div>
                                    <div class="align-self-center">
                                        <h2 class="h3 mb-0">{{ $jumlahPengajuanDokumenDec }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="row">
                    <div class="col-12 mt-3 mb-3">
                        <h4>Statistik Pendataan UMKM</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati illo excepturi atque qui, corrupti
                            quis beatae maiores laudantium error enim, ratione eaque hic, ab unde.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <h2 class="mb-0 p-0 my-0 me-4">{{ $jumlahUmkm }}</h2>
                                        </div>
                                        <div>
                                            <h4 style="margin-bottom: 2px;">Pengajuan UMKM</h4>
                                            <p style="margin-bottom: 0px;">Jumlah Pengajuan UMKM Secara Keseluruhan</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('umkm.manage') }}" style="text-decoration: none">
                                        <button type="button" class="mt-2 btn primary position-relative">
                                            Selengkapnya
                                            @if ($jumlahUmkmNew > 0)
                                                <span class="badge bg-danger rounded-pill position-absolute top-0 end-0"
                                                    style="margin-top: -5px; margin-right: -5px;">
                                                    {{ $jumlahUmkmNew }}
                                                    <span class="visually-hidden">unread messages</span>
                                            @endif
                                            </span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6 col-md-6 col-sm-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <i class="lni lni-shopping-basket text-success"></i>
                                        </div>
                                        <div class="mx-4">
                                            <h4 style="margin-bottom: 0px">UMKM Disetujui</h4>
                                            {{-- <p class="mb-0">Monthly blog posts</p> --}}
                                        </div>
                                    </div>
                                    <div class="align-self-center">
                                        <h2 class="h3 mb-0">{{ $jumlahUmkmAcc }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <i class="lni lni-shopping-basket text-danger"></i>
                                        </div>
                                        <div class="mx-4">
                                            <h4 style="margin-bottom: 0px">UMKM Ditolak</h4>
                                            {{-- <p class="mb-0">Monthly blog posts</p> --}}
                                        </div>
                                    </div>
                                    <div class="align-self-center">
                                        <h2 class="h3 mb-0">{{ $jumlahUmkmDec }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endcan
    </div>
@endsection

@push('css')
@endpush

@push('js')
    <script></script>
@endpush
