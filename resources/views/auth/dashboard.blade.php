@extends('layouts.sidebar')
@php
    use Carbon\Carbon;
    setlocale(LC_TIME, 'id_ID.utf8');
    Carbon::setLocale('id');
    $date = Carbon::now()->translatedFormat('l, d F Y');
@endphp
@section('content')

    <div class="container-fluid">
        @can('isRt')
            <section>
                @if (auth()->user()->updated_at == auth()->user()->created_at)
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">Perhatian!</h4>
                        <p>Demi keamanan akun anda, harap perbarui password dengan segera. Password yang saat ini anda gunakan
                            merupakan password ketika akun pertama kali dibuat dan perlu diperbarui. Pastikan untuk menggunakan
                            password baru yang kuat dan unik untuk menjaga akun anda tetap aman.</p>
                        <hr>
                        <p class="mb-0">Anda bisa klik <a style="text-decoration: underline"
                                href="{{ route('profil.manage') }}">link ini</a> untuk menggunakan fitur ubah password.</p>
                    </div>
                @endif
                <div class="row">
                    <div class="col-12 mt-3 mb-3">
                        <h2 class="">Dashboard RT</h2>
                        <hr class="hrmain mt-4 mb-5" style="height: 2px;">
                        <h4>Statistik Pendataan Penduduk &amp; Klasifikasi Berdasarkan Usia</h4>
                        <p>Statistik Pendataan Penduduk &amp; Klasifikasi Berdasarkan Usia adalah fitur yang memberikan data
                            penduduk dalam wilayah Rukun Warga (RW).</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6 col-md-6 col-sm-6 mb-4">
                        <div class="card">
                            <div class="card-body" title="Jumlah penduduk yang terdaftar">
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
                            <div class="card-body" title="Jumlah keluarga yang terdaftar">
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
                            <a href="{{ route('anak') }}" class="secondary" style="text-decoration: none">
                                <div class="card-body" title="Jumlah anak-anak">
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
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 col-sm-12 mb-4">
                        <div class="card">
                            <a href="{{ route('produktif') }}" class="secondary" style="text-decoration: none">
                                <div class="card-body" title="Jumlah penduduk berusia produktif">
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
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 col-sm-12 mb-4">
                        <div class="card">
                            <a href="{{ route('lansia') }}" class="secondary" style="text-decoration: none;">
                                <div class="card-body" title="Jumlah penduduk lansia">
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
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mt-3 mb-3">
                        <h4>Statistik Permintaan Dokumen</h4>
                        <p>Statistik Permintaan Dokumen adalah fitur yang menyajikan data terperinci mengenai
                            permintaan dokumen di lingkungan Rukun Warga (RW).</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 mb-4">
                        <div class="card">
                            <div class="card-body" title="Jumlah permintaan dokumen">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <h2 class="h3 mb-0 me-4">{{ $jumlahPengajuanDokumen }}</h2>
                                        </div>
                                        <div>
                                            <h4 style="margin-bottom: 2px;">Permintaan Dokumen</h4>
                                            <p class="mb-0">Jumlah Permintaan Dokumen Secara Keseluruhan</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('pengajuandokumen.manage') }}" style="text-decoration: none"
                                        title="Kelola pengajuan dokumen">
                                        <button type="button" class="mt-2 btn primary position-relative">
                                            Selengkapnya
                                            @if ($jumlahPengajuanDokumenNew > 0)
                                                <span class="badge bg-danger rounded-pill position-absolute top-0 end-0"
                                                    style="margin-top: -5px; margin-right: -5px;">
                                                    {{ $jumlahPengajuanDokumenNew }}
                                                    <span class="visually-hidden">unread messages</span>
                                                </span>
                                            @endif
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
                            <div class="card-body" title="Jumlah permintaan dokumen yang disetujui">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <i class="lni lni-printer text-success"></i>
                                        </div>
                                        <div class="mx-4">
                                            <h4 style="margin-bottom: 0px">Permintaan Dokumen<br>Disetujui</h4>
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
                            <div class="card-body" title="Jumlah permintaan dokumen yang ditolak">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <i class="lni lni-printer text-danger"></i>
                                        </div>
                                        <div class="mx-4">
                                            <h4 style="margin-bottom: 0px">Permintaan Dokumen<br>Ditolak</h4>
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
            </section>
        @endcan


        @can('isRw')
            <section>
                @if (auth()->user()->updated_at == auth()->user()->created_at)
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">Perhatian!</h4>
                        <p>Demi keamanan akun anda, harap perbarui password dengan segera. Password yang saat ini anda gunakan
                            merupakan password ketika akun pertama kali dibuat dan perlu diperbarui. Pastikan untuk menggunakan
                            password baru yang kuat dan unik untuk menjaga akun anda tetap aman.</p>
                        <hr>
                        <p class="mb-0">Anda bisa klik <a style="text-decoration: underline"
                                href="{{ route('profil.manage') }}">link ini</a> untuk menggunakan fitur ubah password.</p>
                    </div>
                @endif
                <div class="row">
                    <div class="col-12 mt-0 mb-3">
                        <?php
                        $users = Auth()->user();
                        ?>
                        <div class="row">
                            <div class="col mb-0">
                                <h3>Halo, <span>{{ $users->username }}</span></h3>
                            </div>
                            <div class="row">
                                <span class="col-10 pe-0">
                                    <hr>
                                </span>
                                <span class="col-2 pe-0">
                                    {{-- <div class="col-auto ml-auto"> --}}
                                    <p id="current-date" class="mt-1 text-align-end" style="font-size: .95rem;">
                                        {{ $date }}
                                    </p>
                                    {{-- </div> --}}
                                </span>
                            </div>
                        </div>
                        <p style="font-size: 12 px;">Selamat Datang di dashboard RW</p>
                        {{-- <hr class="hrmain mt-4 mb-1" style="height: 2px;"> --}}
                    </div>
                </div>


                <div class="row mt-4">
                    <div class="col-xl-12 col-md-12 col-sm-12 mb-4">
                        <div class="card">
                            <div class="card-body" title="Jumlah penduduk yang terdaftar">
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
                                    <a href="{{ route('penduduk.manage') }}" style="text-decoration: none"
                                        title="Kelola penduduk">
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
                            <div class="card-body" title="Jumlah keluarga yang terdaftar">
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
                                    <a href="{{ route('keluarga.manage') }}" style="text-decoration: none"
                                        title="Kelola keluarga">
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
                            <div class="card-body" title="Jumlah RT yang terdaftar">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <h2 class="h3 mb-0 me-4">{{ $jumlahRt }}</h2>
                                        </div>
                                        <div>
                                            <h4 style="margin-bottom: 2px;">RT</h4>
                                            <p class="mb-0">Jumlah Ketua RT</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('rt.manage') }}" style="text-decoration: none" title="Kelola RT">
                                        <button type="button" class="mt-2 btn primary position-relative">
                                            >
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row mt-4">
                    <div class="col-12 mt-3 mb-3">
                        <h4>Distribusi Penduduk Berdasarkan Usia</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-8 col-md-12 col-sm-12 mb-4">
                        <div class="card flex-fill w-100">
                            {!! $data['dataPendudukChart']->container() !!}
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-12 col-sm-12 mb-4">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <div class="card">
                                    <a href="{{ route('anak') }}" class="secondary" style="text-decoration: none">
                                        <div class="card-body" title="Jumlah anak-anak">
                                            <div class="d-flex justify-content-between p-md-1">
                                                <div class="d-flex flex-row">
                                                    <div class="align-self-center">
                                                        <h2 class="h3 mb-0 me-4">{{ $jumlahAnakAnak }}</h2>
                                                    </div>
                                                    <div>
                                                        <h4 style="margin-bottom: 3px;">Data Anak-anak</h4>
                                                        <p class="mb-0">Penduduk Berusia < 14 tahun</p>
                                                    </div>
                                                </div>
                                                {{-- <button type="button" class="mt-2 btn primary position-relative">
                                                    >
                                                </button> --}}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 mb-4">
                                <div class="card">
                                    <a href="{{ route('produktif') }}" class="secondary" style="text-decoration: none">
                                        <div class="card-body" title="penduduk berusia produktif">
                                            <div class="d-flex justify-content-between p-md-1">
                                                <div class="d-flex flex-row">
                                                    <div class="align-self-center">
                                                        <h2 class="h3 mb-0 me-4">{{ $jumlahUsiaProduktif }}</h2>
                                                    </div>
                                                    <div>
                                                        <h4 style="margin-bottom: 3px;">Data Remaja</h4>
                                                        <p class="mb-0">Penduduk 15-64 tahun</p>
                                                    </div>
                                                </div>
                                                {{-- <button type="button" class="mt-2 btn primary position-relative">
                                                    >
                                                </button> --}}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 mb-4">
                                <div class="card">
                                    <a href="{{ route('lansia') }}" class="secondary" style="text-decoration: none;">
                                        <div class="card-body" title="penduduk lansia">
                                            <div class="d-flex justify-content-between p-md-1">
                                                <div class="d-flex flex-row">
                                                    <div class="align-self-center">
                                                        <h2 class="h3 mb-0 me-4">{{ $jumlahLansia }}</h2>
                                                    </div>
                                                    <div>
                                                        <h4 style="margin-bottom: 3px;">Lanjut Usia</h4>
                                                        <p class="mb-0">Penduduk Berusia > 65 tahun</p>
                                                    </div>
                                                </div>
                                                {{-- <button type="button" class="mt-2 btn primary position-relative">
                                                >
                                            </button> --}}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 mt-3">
                        <h4>Statistik Laporan Keuangan</h4>
                    </div>
                </div>
                <div class="row">

                    <div class="card flex-fill w-100">
                        {!! $dataKas['kasRWChart']->container() !!}
                    </div>

                </div>


                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mb-4" tit>
                        <div class="card">
                            <a style="text-decoration: none;" class="secondary"
                                href="{{ route('laporankeuangan.manage') }}">
                                <div class="card-body" title="Jumlah laporan keuangan">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex flex-row">
                                            <div class="align-self-center">
                                                <h2 class="h3 mb-0 me-3">{{ $jumlahLaporanKeuangan }}</h2>
                                            </div>
                                            <div>
                                                <h5 style="margin-bottom: 0px; font-size: .9rem;">Laporan <br>Keuangan</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mb-4">
                        <div class="card">
                            <a style="text-decoration: none;" class="secondary" href="{{ route('pengumuman.manage') }}">
                                <div class="card-body" title="Jumlah pengumuman yang dipublikasi">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex flex-row">
                                            <div class="align-self-center">
                                                <h2 class="h3 mb-0 me-3">{{ $jumlahPengumuman }}</h2>
                                            </div>
                                            <div>
                                                <h5 style="margin-bottom: 0px; font-size: .9rem;">Publikasi Pengumuman</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mb-4">
                        <div class="card">
                            <a style="text-decoration: none;" class="secondary" href="{{ route('umkm.manage') }}">
                                <div class="card-body" title="Jumlah UMKM yang diajukan">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex flex-row">
                                            <div class="align-self-center">
                                                <h2 class="h3 mb-0 me-3">{{ $jumlahUmkm }}</h2>
                                            </div>
                                            <div>
                                                <h5 style="margin-bottom: 0px; font-size: .9rem;">Pengajuan <br>UMKM</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mb-4">
                        <div class="card">
                            <a style="text-decoration: none;" class="secondary"
                                href="{{ route('pengajuandokumen.manage') }}">
                                <div class="card-body" title="Jumlah permintaan dokumen">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex flex-row">
                                            <div class="align-self-center">
                                                <h2 class="h3 mb-0 me-3">{{ $jumlahPengajuanDokumen }}</h2>
                                            </div>
                                            <div>
                                                <h5 style="margin-bottom: 0px; font-size: .9rem;">Permintaan <br>Dokumen
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>



                <div class="row mt-4">
                    <div class="col-12 mt-3 mb-3">
                        <h4>Statistik Pendataan UMKM</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 mb-4">
                        <div class="card">
                            <div class="card-body" title="Jumlah UMKM yang diajukan">
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
                                    <a href="{{ route('umkm.manage') }}" style="text-decoration: none" title="Kelola UMKMS">
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
                            <div class="card-body" title="Jumlah UMKM yang disetujui">
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
                            <div class="card-body" title="Jumlah UMKM yang ditolak">
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
            <script src="{{ $data['dataPendudukChart']->cdn() }}"></script>
        
            {{ $data['dataPendudukChart']->script() }}
        
            <script src="{{ $dataKas['kasRWChart']->cdn() }}"></script>
        
            {{ $dataKas['kasRWChart']->script() }}
        @endcan
    </div>

@endsection

@push('css')
@endpush

@push('js')
    <script></script>
@endpush
