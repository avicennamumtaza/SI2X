<div class="">
    <div class="row-auto flex-column flex-lg-row position-relative">
        <!-- Start Sidebar -->
        <div class="col-2 sidebar shadow-lg">
            <nav class="navbar navbar-expand-lg align-items-stretch">
                <div class="container-fluid align-items-lg-start flex-lg-column ">
                    <a class="navbar-brand my-3" href="#"><img src="{{ asset('assets/landing-pict.png') }}"
                            class="d-inline-block align-text-center" alt="SIRW" width="40" height="40"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#navbarOffcanvasLg" aria-controls="navbarOffcanvasLg">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="navbarOffcanvasLg"
                        aria-labelledby="navbarOffcanvasLgLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body flex-column">
                            <ul
                                class="navbar-nav mb-2 mb-lg-0 flex-column align-items-end align-items-lg-start flex-grow-1 pe-2">
                                <li class="mb-2 position-relative">
                                    <div class="content nav-item gap-2 d-flex align-items-center">
                                        @can('isRw')
                                            <a id="dashboard-link" class="nav-link" title="dashboard"
                                                href="{{ route('home') }}">
                                                <i class="bi bi-house mx-2"></i>
                                                <p class="me-2 d-inline">Dashboard</p>
                                            </a>
                                        @endcan
                                        @can('isRt')
                                            <a id="dashboard-link" class="nav-link" title="dashboard"
                                                href="{{ route('home') }}">
                                                <i class="bi bi-house mx-2"></i>
                                                <p class="me-2 d-inline">Dashboard</p>
                                            </a>
                                        @endcan
                                    </div>
                                </li>
                                @can('isRw')
                                    <li class="mb-2 position-relative">
                                        <div class="content nav-item gap-2 d-flex align-items-center">
                                            <a id="umkm-link" class="nav-link" href="{{ route('umkm.manage') }}"
                                                title="UMKM">
                                                <i class="bi bi-exclamation-circle mx-2"></i>
                                                <p class="me-2 d-inline">UMKM</p>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="mb-2 position-relative">
                                        <div class="content nav-item gap-2 d-flex align-items-center">
                                            <a id="pengumuman-link" class="nav-link" href="{{ route('pengumuman.manage') }}"
                                                title="Pengumuman">
                                                <i class="bi bi-megaphone card-icon mx-2"></i>
                                                <p class="me-2 d-inline">Pengumuman</p>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="mb-2 position-relative">
                                        <div class="content nav-item gap-2 d-flex align-items-center">
                                            <a id="laporan-link" class="nav-link" style="width: 220px"
                                                href="{{ route('laporankeuangan.manage') }}" title="Laporan Keuangan">
                                                <i class="bi bi-cash mx-2"></i>
                                                <p class="me-2 d-inline">Laporan Keuangan</p>
                                            </a>
                                        </div>
                                    </li>
                                @endcan
                                @can('isRt')
                                    <li class="mb-2 position-relative">
                                        <div class="content nav-item gap-2 d-flex align-items-center">
                                            <a id="pengajuandokumen-link" class="nav-link" style="width: 220px"
                                                href="{{ route('pengajuandokumen.manage') }}" title="report">
                                                <i class="bi bi-activity mx-2"></i>
                                                <p class="me-2 d-inline">Dokumen</p>
                                            </a>
                                        </div>
                                    </li>
                                @endcan
                                {{-- @endif --}}
                                {{-- <li class="mb-2 position-relative">
                                    <div
                                        class="content nav-item gap-1 d-flex justify-content-center align-items-center">
                                        <i class="bi bi-bell"></i> --}}
                                {{-- <a id="dashboard-link" class="nav-link"  href="/{{ $role }}/notification">Notification --}}
                                {{-- @if ($role == 'mahasiswa')
                                            @if ($newViolationCount > 0) --}}
                                {{-- <span
                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"> --}}
                                {{-- {{ $newViolationCount }} --}}
                                {{-- <span class="visually-hidden">unread messages</span> --}}
                                {{-- </span> --}}
                                {{-- @endif
                                        @else
                                            @if ($newReportCommentCount > 0) --}}
                                {{-- <span
                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"> --}}
                                {{-- {{ $newReportCommentCount }} --}}
                                {{-- <span class="visually-hidden">unread messages</span>
                                            </span> --}}
                                {{-- @endif
                                        @endif --}}
                                {{-- </a>
                                    </div>
                                </li> --}}
                                {{-- @if ($role == 'admin') --}}
                                <li class="mb-2 gap-1">
                                    <div class="col-auto position-relative content nav-item align-items-center">
                                        <a style="color: white" type="button"
                                            class="btn dropdown-toggle shadow-none d-inline" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="bi bi-person" style="margin-right: 11px; margin-left: 2px;"></i>
                                            <p class="d-inline">Kelola</p>
                                        </a>
                                        <ul style="background-color: transparent; border: 1px solid #fff"
                                            class="dropdown-menu position-static">
                                            <li>
                                                <a class="dropdown-item"
                                                    style="background-color: transparent; color: white"
                                                    href="{{ route('penduduk.manage') }}">
                                                    Penduduk
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    style="background-color: transparent; color: white"
                                                    href="{{ route('keluarga.manage') }}">Keluarga</a>
                                            </li>
                                            @can('isRw')
                                                <li>
                                                    <a class="dropdown-item"
                                                        style="background-color: transparent; color: white"
                                                        href="{{ route('rt.manage') }}">
                                                        RT
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                        style="background-color: transparent; color: white"
                                                        href="{{ route('rw.manage') }}">
                                                        RW
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                        style="background-color: transparent; color: white"
                                                        href="{{ route('rw.manage') }}">
                                                        Pengguna
                                                    </a>
                                                </li>
                                            @endcan
                                        </ul>
                                    </div>
                                </li>
                                {{-- <li class="mb-2 position-relative">
                                    <div class="content nav-item gap-1 d-flex align-items-center">
                                        <i class="bi bi-activity"></i>
                                        <a id="dashboard-link" class="nav-link"  href="/{{ $role }}/log-activity">Log Activity</a>
                                    </div>
                                </li> --}}
                                {{-- @endif --}}
                                {{-- <li class="mb-2 position-relative">
                                    <div class="content nav-item  d-flex gap-1 align-items-center">
                                        <i class="bi bi-person"></i> --}}
                                {{-- <a id="dashboard-link" class="nav-link"  href="/{{ $role }}/profile">Profile</a>
                                    </div>
                                </li> --}}
                                <li class="mt-2 position-relative">
                                    <hr
                                        style="background-color: #fff;
                                                margin-top: 0px;
                                                height: 1px;
                                                opacity: 0.99;
                                                width: 217px;">
                                    <div class="content nav-item gap-2 d-flex align-items-center">
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button id="dashboard-link" class="nav-link d-inline" type="submit">
                                                <i class="bi bi-box-arrow-in-right"
                                                    style="margin-right: 13px; margin-left: 4px;"></i>
                                                <p class="me-2 d-inline">Keluar</p>
                                            </button>
                                        </form>
                                    </div>
                                </li>
                                {{-- <li class="mb-2 position-relative">
                                    <div class="content nav-item gap-2 d-flex align-items-center">
                                        <a id="pengajuandokumen-link" class="nav-link" style="width: 220px"
                                            href="{{ route('pengajuandokumen.manage') }}" title="report">
                                            <i class="bi bi-activity mx-2"></i>
                                            <p class="me-2 d-inline" >Dokumen</p>
                                        </a>
                                    </div>
                                </li> --}}
                            </ul>
                            <div class="row-auto mt-4">
                                <div class="card-user d-flex justify-content-end gap-2 align-items-center col">
                                    <img {{-- src="{{ $user->getImageUrl() }}"  --}} alt="" class="img-profile rounded-circle">
                                    <div class="userinfo d-flex align-items-start flex-column">
                                        <h3 class="fs-6" style=" margin-bottom:-2px;">
                                            {{-- {{ $user->getFirstName() }} {{ $user->getLastName() }} --}}
                                        </h3>
                                        <p class="text-capitalize" style="font-size:12px;margin-bottom:-5px;">
                                            {{-- {{ $role == 'admin' ? $user->getRoleDetail()->getTitle() : $role }} --}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>


        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var menuLinks = document.querySelectorAll('.nav-link');

                // Saat halaman dimuat, periksa penyimpanan lokal untuk mendapatkan status menu yang terakhir kali diklik
                var activeMenu = localStorage.getItem('activeMenu');
                if (activeMenu) {
                    document.getElementById(activeMenu).classList.add('aktif');
                }

                menuLinks.forEach(function(link) {
                    link.addEventListener('click', function(event) {
                        // Saat link menu diklik, simpan ID menu yang diklik ke dalam penyimpanan lokal
                        var currentActive = document.querySelector('.nav-link.aktif');
                        if (currentActive) {
                            currentActive.classList.remove('aktif');
                        }
                        this.classList.add('aktif');
                        localStorage.setItem('activeMenu', this.id);
                    });
                });
            });
        </script>