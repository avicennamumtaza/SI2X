<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $pageTitle ?? config('app.name', 'SIRW') }}</title>
    <link rel="icon" href="{{ asset('assets/Logo.png') ?? null }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">

    <!-- Scripts -->
    @vite('resources/js/app.js')

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('bootstrap-icons.min.css') }}">

</head>

<body>
    <div class="container-fluid-nav">
        <nav class="navbar fixed-top my-3 mx-5 custom-nav navbar-expand-lg">
            <a class="navbar-brand" href="{{ route('landing') }}">
                <img src="{{ asset('assets/Logo.png') }}" alt="tes" title="Logo SIRW">
                <span class="navbar-brand mb-0 h1">
                    {{ config('app.name') }}
                </span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('landing') }}"
                            title="Beranda website">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pengumuman.global') }}" title="Pengumuman">Pengumuman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('laporankeuangan.global') }}"
                            title="Laporan Keuangan">Keuangan</a>
                    </li>
                    <div class="ms-2 nav-item btn-group">
                        <button type="button" class="fitur-btn nav-link dropdown-toggle" data-bs-toggle="dropdown"
                            data-bs-display="static" aria-expanded="false" title="Layanan Lainnya">
                            Layanan
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-end">
                            {{-- <li><a class="dropdown-item" href="{{ route('pengumuman.global') }}">Pengumuman</a></li>
                            <li><a class="dropdown-item" href="{{ route('umkm.global') }}">Daftar UMKM</a></li> --}}
                            <li><a class="dropdown-item" href="{{ route('pengajuandokumen.global') }}"
                                    title="Pengajuan Surat">Pengajuan Dokumen</a></li>
                            <li><a class="dropdown-item" href="{{ route('umkm.global') }}" title="Daftar UMKM">Daftar
                                    UMKM</a></li>
                            <li>
                            <li><a class="dropdown-item" href="{{ route('bansos.global') }}" title="Bansos">Bantuan
                                    Sosial</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('login') }}"
                                    title="Masuk sebagai RT/RW">Masuk</a></li>
                        </ul>
                    </div>
                </ul>
            </div>
        </nav>
    </div>

    <main class="py-4">
        <div class="mt-9">
            @yield('content')
        </div>
    </main>

    {{-- Sweet Alert --}}
    @include('sweetalert::alert')

    <footer class="text-center text-lg-start">
        <!-- Grid container -->
        <div class="f1 container p-5">
            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="tentang col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Tentang SIRW</h5>
                    <p>
                        SIRW merupakan singkatan dari Sistem Informasi RW. Pengembangan Website SIRW ini bertujuan untuk
                        mempermudah pengelolaan data penduduk dan memaksimalkan pelayanan warga di lingkungan RW.
                    </p>
                </div>
                <!--Grid column-->
                <div class="kontak col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Kontak Kami</h5>
                    <p>
                        Jalan Jodipan Wetan Gang 3, RW 06, Kelurahan Jodipan, Kecamatan Blimbing, Kota Malang.
                        Kode Pos 65137.
                    </p>
                    @php
                        $rw = \App\Models\Rw::first();
                    @endphp
                    {{-- substr_replace($umkm->wa_umkm, '62', 0, 1) --}}
                    @if ($rw)
                        <a href="https://wa.me/{{ $rw->wa_rw }}" target="_blank" data-mdb-ripple-init
                            class="no-footer" title="Nomor WhatsApp RW">
                            <i class="bi bi-whatsapp me-2"></i>RW {{ substr_replace($rw->wa_rw, '+62', 0, 1) }}
                        </a>
                    @endif
                    {{-- <a href="https://wa.me/{{ $rw->wa_rw }}" target="_blank" data-mdb-ripple-init class="no-footer">
                    <i class="bi bi-whatsapp"></i> RW {{ $rw->wa_rw }}
                </a> --}}
                </div>
            </div>
        </div>
        <!-- Copyright -->
        <div class="f2 text-center p-3">
            © 2024 Copyright : RW 06 Jodipan
        </div>
        <!-- Copyright -->
    </footer>
    {{-- </div> --}}



    {{-- <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}

</body>

</html>
