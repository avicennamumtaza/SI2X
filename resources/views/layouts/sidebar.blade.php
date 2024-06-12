<!doctype html>
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
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite('resources/js/app.js')

    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.3/datatables.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button id="toggle-btn" type="button">
                    <i id="lni" class="lni lni-menu"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="{{ route('home') }}">SIRW</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item {{ \Route::is('home') ? 'active' : '' }}" title="Dashboard">
                    <a href="{{ route('home') }}" class="sidebar-link">
                        <i class="lni lni-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @can('isRw')
                    <li class="sidebar-item {{ \Route::is('pengumuman.manage') ? 'active' : '' }}" title="Pengumuman">
                        <a href="{{ route('pengumuman.manage') }}" class="sidebar-link">
                            <i class="lni lni-notepad"></i>
                            {{-- <i class="lni lni-license"></i> --}}
                            <span>Pengumuman</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ \Route::is('bansos.manage') ? 'active' : '' }}" title="Bantuan Sosial">
                        <a href="{{ route('bansos.manage') }}" class="sidebar-link">
                            <i class="lni lni-target-customer"></i>
                            {{-- <i class="lni lni-license"></i> --}}
                            <span>Bantuan Sosial</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ \Route::is('dokumen.manage') ? 'active' : '' }}" title="Dokumen">
                        <a href="{{ route('dokumen.manage') }}" class="sidebar-link">
                            <i class="lni lni-control-panel"></i>
                            <span>Dokumen</span>
                        </a>
                    </li>
                @endcan
                <li class="sidebar-item {{ \Route::is('pengajuandokumen.manage') ? 'active' : '' }}"
                    title="Pengajuan Dokumen">
                    <a href="{{ route('pengajuandokumen.manage') }}" class="sidebar-link">
                        <i class="lni lni-printer"></i>
                        <span>Pengajuan Dokumen</span>
                    </a>
                </li>
                
                <li class="sidebar-item" title="Kependudukan">
                    <a href="#"
                        class="sidebar-link has-dropdown collapsed {{ \Route::is('penduduk.manage') ? 'active' : '' }} {{ \Route::is('keluarga.manage') ? 'active' : '' }} {{ \Route::is('rt.manage') ? 'active' : '' }} {{ \Route::is('rw.manage') ? 'active' : '' }}"
                        type="button" data-bs-toggle="collapse" data-bs-target="#multi" aria-expanded="false"
                        aria-controls="multi">
                        <i class="lni lni-users"></i>
                        <span>Kependudukan</span>
                    </a>
                    <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item {{ \Route::is('penduduk.manage') ? 'active' : '' }}" title="Penduduk">
                            <a href="{{ route('penduduk.manage') }}" class="sidebar-link">
                                <div class="single-item-menu">Penduduk</div>
                            </a>
                        </li>
                        <li class="sidebar-item {{ \Route::is('keluarga.manage') ? 'active' : '' }}" title="Keluarga">
                            <a href="{{ route('keluarga.manage') }}" class="sidebar-link">
                                <div class="single-item-menu">Keluarga</div>
                            </a>
                        </li>
                        @can('isRw')
                            <li class="sidebar-item {{ \Route::is('rt.manage') ? 'active' : '' }}" title="Rukun Tetangga">
                                <a href="{{ route('rt.manage') }}" class="sidebar-link">
                                    <div class="single-item-menu">RT</div>
                                </a>
                            </li>
                            <li class="sidebar-item {{ \Route::is('rw.manage') ? 'active' : '' }}" title="Rukun Warga">
                                <a href="{{ route('rw.manage') }}" class="sidebar-link">
                                    <div class="single-item-menu">RW</div>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @can('isRw')
                    <li class="sidebar-item {{ \Route::is('laporankeuangan.manage') ? 'active' : '' }}"
                        title="Laporan Keuangan">
                        <a href="{{ route('laporankeuangan.manage') }}" class="sidebar-link">
                            <i class="lni lni-revenue"></i>
                            <span>Keuangan</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ \Route::is('umkm.manage') ? 'active' : '' }}" title="UMKM">
                        <a href="{{ route('umkm.manage') }}" class="sidebar-link">
                            <i class="lni lni-shopping-basket"></i>
                            <span>UMKM</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ \Route::is('users.manage') ? 'active' : '' }}" title="Kelola Pengguna">
                        <a href="{{ route('users.manage') }}" class="sidebar-link">
                            <i class="bi bi-people-fill"></i>
                            <span>Kelola Pengguna</span>
                        </a>
                    </li>
                @endcan
                
                <div class="sidebar-footer pt-2">
                    <li class="sidebar-item {{ \Route::is('profil.manage') ? 'active' : '' }}" title="Profil">
                        <a href="{{ route('profil.manage') }}" class="sidebar-profile align-items-center">
                            @php
                                $user = Auth::user();
                            @endphp
                            @if ($user)
                                <img src="{{ asset($user->foto_profil ? 'storage/' . $user->foto_profil : 'public/Foto Users/default.jpg') }}"
                                    alt="Foto Profil" class="profile-picture rounded-circle me-3"
                                    style="width: 40px; height: 40px; object-fit: cover;">
                                <div>
                                    <span>{{ $user->username }}</span> <br>
                                    <span>{{ $user->role }}</span>
                                </div>
                            @endif
                        </a>
                    </li>
                </div>                

                <li class="sidebar-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" class="sidebar-link"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        title="Keluar"
                        style="padding-left: 20px">
                        <i class="lni lni-exit"></i>
                        <span>Keluar</span>
                    </a>
                </li>

            </ul>
        </aside>
        <div class=""
            style="
            min-height: 100vh;
            width: 100%;
            overflow: hidden;
            ">
            <main class="col position-relative overflow-x-hidden">
                <div class="row justify-content-center">
                    <div class="col-lg-12 mx-4 me-1 px-lg-5 py-5">
                        <div class="content p-lg-4 p-sm-3">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <!-- End Sidebar -->
    </div>
    {{-- </div> --}}
    {{-- <script>
        // let table = new DataTables('#myTable');
        // <script src="vendor\datatables.net\datatables.net-bs5\js\dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/v/bs5/dt-2.0.3/datatables.min.js"></script>
    </script> --}}

    {{-- Add common Javascript/Jquery code --}}

    @push('js')
        {{-- <script>
            $(document).ready(function() {
            // Add your common script logic here...
            });
        </script>  --}}
        <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    @endpush

    @stack('scripts')

    {{-- Sweet Alert --}}
    @include('sweetalert::alert')

    {{-- Add common CSS customizations --}}

    @push('css')
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
        <style type="text/css">
            {{-- You can add AdminLTE customizations here --}}
        </style>
    @endpush
</body>
<script>
    const hamburger = document.querySelector("#toggle-btn")

    hamburger.addEventListener("click", function() {
        document.querySelector("#sidebar").classList.toggle("expand")
    })
    document.addEventListener("DOMContentLoaded", function() {
        const dropdownTriggers = document.querySelectorAll(".has-dropdown");

        dropdownTriggers.forEach(trigger => {
            trigger.addEventListener("click", function() {
                this.querySelector(".sidebar-dropdown").classList.toggle("show");
            });
        });
    });
</script>
