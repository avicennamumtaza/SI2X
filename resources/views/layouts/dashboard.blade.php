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
                                    <div class="align-self-center">
                                        <i class="bi bi-house text-success"></i>
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
                                    <div class="align-self-center">
                                        <i class="bi bi-house text-success"></i>
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
                                    <div class="align-self-center">
                                        <i class="bi bi-house text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mt-3 mb-3">
                        <h4>Statistik Pengajuan Dokumen</h4>
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
                                    <div class="align-self-center">
                                        <i class="bi bi-house text-success"></i>
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
                                    <div class="align-self-center">
                                        <i class="bi bi-house text-success"></i>
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
                                    <div class="align-self-center">
                                        <i class="bi bi-house text-success"></i>
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
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt unde perspiciatis sit blanditiis
                            fugit, nemo deleniti quaerat? Corrupti quis culpa eum aut impedit perferendis harum maxime aperiam!
                        </p>
                        <br>
                        <h4>Statistik Pendataan Penduduk, Keluarga, dan RT</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <h2 class="h3 mb-0 me-4">999</h2>
                                        </div>
                                        <div>
                                            <h4>Anak-anak</h4>
                                            <p class="mb-0">Pengajuan Ditolak</p>
                                        </div>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="bi bi-house text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <h2 class="h3 mb-0 me-4">999</h2>
                                        </div>
                                        <div>
                                            <h4>Usia Produktif</h4>
                                            <p class="mb-0">Pengajuan Ditolak</p>
                                        </div>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="bi bi-house text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <h2 class="h3 mb-0 me-4">999</h2>
                                        </div>
                                        <div>
                                            <h4>Lanjut Usia</h4>
                                            <p class="mb-0">Pengajuan Ditolak</p>
                                        </div>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="bi bi-house text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between p-md-1">
                                    <div class="d-flex flex-row">
                                        <div class="align-self-center">
                                            <h2 class="h3 mb-0 me-4">999</h2>
                                        </div>
                                        <div>
                                            <h4>Lanjut Usia</h4>
                                            <p class="mb-0">Pengajuan Ditolak</p>
                                        </div>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="bi bi-house text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                            <h4>UMKM Disetujui</h4>
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
                                            <h4>UMKM Ditolak</h4>
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
                                            <h4>Penduduk</h4>
                                            <p class="mb-0">Pengajuan Ditolak</p>
                                        </div>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="bi bi-house text-success"></i>
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
                                            <h4>Keluarga</h4>
                                            <p class="mb-0">Pengajuan Ditolak</p>
                                        </div>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="bi bi-house text-success"></i>
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
                                            <h4>RT</h4>
                                            <p class="mb-0">Pengajuan Ditolak</p>
                                        </div>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="bi bi-house text-success"></i>
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
                                            <h4>Anak-anak</h4>
                                            <p class="mb-0">Pengajuan Ditolak</p>
                                        </div>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="bi bi-house text-success"></i>
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
                                            <h4>Usia Produktif</h4>
                                            <p class="mb-0">Pengajuan Ditolak</p>
                                        </div>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="bi bi-house text-success"></i>
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
                                            <h4>Lanjut Usia</h4>
                                            <p class="mb-0">Pengajuan Ditolak</p>
                                        </div>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="bi bi-house text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mt-3 mb-3">
                        <h4>Statistik Pengajuan Dokumen</h4>
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
                                    <div class="align-self-center">
                                        <i class="bi bi-house text-success"></i>
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
                                    <div class="align-self-center">
                                        <i class="bi bi-house text-success"></i>
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
                                    <div class="align-self-center">
                                        <i class="bi bi-house text-success"></i>
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
