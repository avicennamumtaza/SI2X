<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIRW') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- Icons --}}
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.min.css">

    {{-- DataTables --}}
    {{-- <link href="vendor\datatables.net\datatables.net-bs5\css\dataTables.bootstrap5.min.css" rel="stylesheet"></link> --}}
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.3/datatables.min.css" rel="stylesheet">

</head>

<body>
    <div class="">
        <div class="row-auto flex-column flex-lg-row position-relative">
            <!-- Start Sidebar -->
            <div class="col-2 sidebar shadow-lg">
                <nav class="navbar navbar-expand-lg align-items-stretch">
                    <div class="container-fluid align-items-lg-start flex-lg-column ">
                        <a class="navbar-brand my-3" href="#"><img src="{{ asset('assets/landing-pict.png') }}"
                                class="d-inline-block align-text-center" alt="SIRW" width="40"
                                height="40"></a>
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
                                <ul class="navbar-nav mb-2 mb-lg-0 flex-column align-items-end align-items-lg-start flex-grow-1 pe-2">
                                    <li class="mb-2 position-relative">
                                        <div class="content nav-item gap-2 d-flex align-items-center">
                                            <i class="bi bi-house"></i>
                                            <a class="nav-link" aria-current="page" {{-- href="/{{ $role }}/dashboard" --}}>Dashboard</a>
                                        </div>
                                    </li>
                                    {{-- @if ($role == 'mahasiswa') --}}
                                    {{-- <li class="mb-2 position-relative">
                                    <div class="content nav-item gap-1 d-flex align-items-center">
                                        <i class="bi bi-exclamation-circle"></i>
                                        <a class="nav-link" 
                                        {{-- href="/{{ $role }}/violation-history" --}}
                                    {{-- title="report">Violation History</a> --}}
                                    {{-- </div>
                                </li> --}}
                                    {{-- @else --}}
                                    <li class="mb-2 position-relative">
                                        <div class="content nav-item gap-2 d-flex align-items-center">
                                            <i class="bi bi-exclamation-circle"></i>
                                            <a class="nav-link" href="{{ route('umkm.manage') }}"
                                                title="report">UMKM</a>
                                        </div>
                                    </li>
                                    <li class="mb-2 position-relative">
                                        <div class="content nav-item gap-2 d-flex align-items-center">
                                            <i class="bi bi-activity"></i>
                                            <a class="nav-link" href="{{ route('pengumuman.manage') }}"
                                                title="report">Pengumuman</a>
                                        </div>
                                    </li>
                                    {{-- @endif --}}
                                    {{-- <li class="mb-2 position-relative">
                                        <div
                                            class="content nav-item gap-1 d-flex justify-content-center align-items-center">
                                            <i class="bi bi-bell"></i> --}}
                                    {{-- <a class="nav-link" href="/{{ $role }}/notification">Notification --}}
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
                                            <i class="bi bi-person"></i>
                                            <button style="color: white" type="button"
                                                class="btn dropdown-toggle shadow-none" data-bs-toggle="dropdown"
                                                aria-expanded="false">Kelola</button>
                                            <ul style="background-color: transparent; border: 1px solid #fff" class="dropdown-menu position-static">
                                                <li>
                                                    <a class="dropdown-item" style="background-color: transparent; color: white" href="#">
                                                        Penduduk
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" style="background-color: transparent; color: white" href="#">Keluarga</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" style="background-color: transparent; color: white" href="#">
                                                        RT
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" style="background-color: transparent; color: white" href="#-level">
                                                        RW
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" style="background-color: transparent; color: white" href="#">
                                                        Pengguna
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    {{-- <li class="mb-2 position-relative">
                                        <div class="content nav-item gap-1 d-flex align-items-center">
                                            <i class="bi bi-activity"></i>
                                            <a class="nav-link" href="/{{ $role }}/log-activity">Log Activity</a>
                                        </div>
                                    </li> --}}
                                    {{-- @endif --}}
                                    {{-- <li class="mb-2 position-relative">
                                        <div class="content nav-item  d-flex gap-1 align-items-center">
                                            <i class="bi bi-person"></i> --}}
                                    {{-- <a class="nav-link" href="/{{ $role }}/profile">Profile</a>
                                        </div>
                                    </li> --}}
                                    <li class="logOut border-top mt-2 position-relative">
                                        <div class="content nav-item gap-2 d-flex align-items-center">
                                            <i class="bi bi-box-arrow-in-right"></i>
                                            <a class="nav-link" href="/auth/logout">Log Out</a>
                                        </div>
                                    </li>
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
            <!-- End Sidebar -->

            <main class="col position-relative overflow-x-hidden">
                <div class="row justify-content-lg-end">
                    <div class="col-lg-10 col px-2 px-lg-5 py-4" title="main">
                        <div class="content p-lg-4 p-0">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
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

    {{-- Add common CSS customizations --}}

    @push('css')
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
        <style type="text/css">
            {{-- You can add AdminLTE customizations here --}}
            /* .card-header {
                        border-bottom: none;
                        }
                        .card-title {
                        font-weight: 600;
                        } */
        </style>
    @endpush
</body>
