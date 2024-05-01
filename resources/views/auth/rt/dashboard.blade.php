@extends('layouts.rw')

@section('content')
    <div class="container-fluid">
        <section>
            <div class="row">
                <div class="col-12 mt-3 mb-1">
                    <h2 class="">Statistik Pendataan</h2>
                    <p>Statistics on minimal cards with Title &amp; Sub Title.</p>
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
                                    <h2 class="h3 mb-0">18,000</h2>
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
                                    <h2 class="h3 mb-0">84,695</h2>
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
                                <div class="d-flex flex-row mx-4">
                                    <div class="align-self-center">
                                        <h2 class="h3 mb-0 me-4">$76,456.00</h2>
                                    </div>
                                    <div>
                                        <h4>Total Sales</h4>
                                        <p class="mb-0">Monthly Sales</p>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <i class="bi bi-house text-danger"></i>
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
                                        <h2 class="h3 mb-0 me-4">$36,000.00</h2>
                                    </div>
                                    <div>
                                        <h4>Total Cost</h4>
                                        <p class="mb-0">Monthly Cost</p>
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
                <div class="col-12 mt-3 mb-1">
                    <h2 class="">Pengajuan Dokumen Terbaru</h2>
                    <p>Statistics on minimal cards with Title &amp; Sub Title.</p>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row mx-4">
                                    <div class="align-self-center">
                                        <h2 class="h3 mb-0 me-4">$76,456.00</h2>
                                    </div>
                                    <div>
                                        <h4>Total Sales</h4>
                                        <p class="mb-0">Monthly Sales</p>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <i class="bi bi-house text-danger"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row mx-4">
                                    <div class="align-self-center">
                                        <h2 class="h3 mb-0 me-4">$76,456.00</h2>
                                    </div>
                                    <div>
                                        <h4>Total Sales</h4>
                                        <p class="mb-0">Monthly Sales</p>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <i class="bi bi-house text-danger"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('css')
@endpush

@push('js')
    <script></script>
@endpush
