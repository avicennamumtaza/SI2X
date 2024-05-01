@extends('layouts.app')

@section('content')
    <div id="beranda" class="container-landing">
        <div class="row custom-section justify-content-start">
            <div class="col-12 col-lg-5">
                <h2>Selamat Datang</h2>
                <h5>Pendaratan yang sempurna!</h5>
                <p>Mempersembahkan solusi modern untuk kita bersama memaksimalkan optimalisasi layanan dengan pendekatan
                    yang lebih efisien melalui SIRW sebagai salah satu upaya mendorong kemajuan dan kolaborasi dalam
                    menjawab kebutuhan sehari-hari di lingkungan Rukun Warga.</p>
                <a href="#">Selengkapnya</a>
            </div>
        </div>
    </div>
    <img src="{{ asset('assets/landing-pict.png') }}" alt="background" class="background-image">
    <div id="stats" class="container container-stats col-10">
        <h1 class="heading-center">Statistik</h1>
        <!-- <div class="container"> -->
        <div class="row">
            <div class="col-md-2 col-sm-4">
                <div class="card">
                    <i class="bi bi-person-check card-icon"></i>
                    <span class="span-count">{{ $data['jumlah_penduduk'] }}</span>
                    <span class="span-head">Penduduk Terdata</span>
                </div>
            </div>
            <div class="col-md-2 col-sm-4">
                <div class="card">
                    <i class="bi bi-house-door card-icon"></i>
                    <span class="span-count">{{ $data['jumlah_keluarga'] }}</span>
                    <span class="span-head">Keluarga Terdata</span>
                </div>
            </div>
            <div class="col-md-2 col-sm-4">
                <div class="card">
                    <i class="bi bi-person-badge card-icon"></i>
                    <span class="span-count">{{ $data['jumlah_rt'] }}</span>
                    <span class="span-head">Rukun Tetangga</span>
                </div>
            </div>
            <div class="col-md-2 col-sm-4">
                <div class="card">
                    <i class="bi bi-megaphone card-icon"></i>
                    <span class="span-count">{{ $data['jumlah_pengumuman'] }}</span>
                    <span class="span-head">Pengumuman Diterbitkan</span>
                </div>
            </div>
            <div class="col-md-2 col-sm-4">
                <div class="card">
                    <i class="bi bi-shop-window card-icon"></i>
                    <span class="span-count">{{ $data['jumlah_umkm'] }}</span>
                    <span class="span-head">UMKM Terdaftar</span>
                </div>
            </div>
            <div class="col-md-2 col-sm-4">
                <div class="card">
                    <i class="bi bi-file-earmark-pdf card-icon"></i>
                    <span class="span-count">{{ $data['jumlah_pengajuan_dokumen'] }}</span>
                    <span class="span-head">Dokumen Diproses</span>
                </div>
            </div>
        </div>
        <!-- </div> -->
    </div>
    <div id="pengumuman" class="container container-pengumuman col-10">
        <h1 class="heading-center">Pengumuman</h1>
        <!-- <div class="container"> -->
        <div class="container">
            <div class="row">
                <div class="col-md-6"> <!-- Dua kolom di desktop -->
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset('assets/landing-pict.png') }}" class="img-fluid rounded-start"
                                    alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural
                                        lead-in to additional content. This content is a little bit longer.</p>
                                    <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6"> <!-- Dua kolom di desktop -->
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset('assets/landing-pict.png') }}" class="img-fluid rounded-start"
                                    alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural
                                        lead-in to additional content. This content is a little bit longer.</p>
                                    <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="position-absolute start-50 translate-middle-x" href="{{ route('pengumuman.global') }}">Lainnya</a>
        </div>
        <!-- </div> -->
    </div>
    <div id="layanan" class="container container-layanan col-10">
        <h1 class="heading-center">Layanan</h1>
        <!-- <div class="container"> -->
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <a href="{{ route('pengumuman.global') }}" style="text-decoration: none">
                    <button class="card">
                        <i class="bi bi-megaphone card-icon"></i>
                        <span class="span-head">Daftar Pengumuman</span>
                    </button>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="{{ route('umkm.global') }}" style="text-decoration: none">
                    <button class="card">
                        <i class="bi bi-shop-window card-icon"></i>
                        <span class="span-head">Pengajuan UMKM</span>
                    </button>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="{{ route('pengajuandokumen.global') }}" style="text-decoration: none">
                    <button class="card">
                        <i class="bi bi-file-earmark-pdf card-icon"></i>
                        <span class="span-head">Pengajuan Dokumen</span>
                    </button>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="{{ route('laporankeuangan.global') }}" style="text-decoration: none">
                    <button class="card">
                        <i class="bi bi-receipt-cutoff card-icon"></i>
                        <span class="span-head">Laporan Keuangan</span>
                    </button>
                </a>
            </div>
        </div>
        <!-- </div> -->
    </div>
@endsection
