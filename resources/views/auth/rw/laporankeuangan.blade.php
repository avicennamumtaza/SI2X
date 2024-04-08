@extends('layouts.rw')

@section('content')
    {{-- <div class="container container-pengumuman col-12"> --}}
    <!-- Modal -->
    <div class="modal fade" id="tambahLaporanKeuangan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Laporan Keuangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body justify-content-start text-start">
                    <!-- Form untuk pengajuan laporan keuangan -->
                    <form action="{{ route('laporankeuangan.store') }}" method="POST">
                        @csrf
                        <!-- Tambahkan input form sesuai kebutuhan -->
                        <div class="form-group mb-3">
                            <label for="nominal" class="form-label text-start">Nominal</label>
                            <input type="number" class="form-control" id="nominal" name="nominal"
                                placeholder="Masukkan Nominal" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="detail" class="form-label">Detail</label>
                            <textarea class="form-control" id="detail" name="detail" rows="3" placeholder="Masukkan Detail" required></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="pihak_terlibat" class="form-label">Pihak Terlibat</label>
                            <input type="text" class="form-control" id="pihak_terlibat" name="pihak_terlibat"
                                placeholder="Masukkan Pihak Terlibat" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="saldo" class="form-label">Saldo</label>
                            <input type="number" class="form-control" id="saldo" name="saldo"
                                placeholder="Masukkan Saldo" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="is_income" class="form-label">Is Income</label>
                            <select class="form-select" id="is_income" name="is_income" required>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>

                        <!-- Tambahkan input lainnya sesuai kebutuhan -->
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header card-header-tabel p-4 mb-3">
            <h5>
                Laporan Keuangan
                <button class="btn btn-add float-end" data-bs-toggle="modal" data-bs-target="#tambahLaporanKeuangan">Tambah
                    Data</button>
            </h5>
        </div>
        <hr>
        <div class="card-body">
            <div class="table-responsive">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>

    @push('scripts')
        {{ $dataTable->scripts() }}
    @endpush
@endsection

@push('css')
@endpush
