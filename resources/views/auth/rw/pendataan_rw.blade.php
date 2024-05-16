@extends('layouts.sidebar')

@section('content')
    {{-- <div class="container container-pengumuman col-12"> --}}
    <!-- Modal -->
    <div class="modal fade" id="tambahRW" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah RW</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body justify-content-start text-start">
                    <!-- Form untuk pengajuan pengumuman -->
                    <form action="{{ route('rw.store') }}" method="POST">
                        @csrf
                        <!-- Tambahkan input form sesuai kebutuhan -->

                        <div class="form-group mb-3">
                            <label for="no_rt" class="form-label text-start">Nomor RW</label>
                            <input type="text" class="form-control" id="no_rw" name="no_rw"
                                placeholder="Masukkan Nomor RW" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nik_rw" class="form-label text-start">NIK RW</label>
                            <input type="text" class="form-control" id="nik_rw" name="nik_rw"
                                placeholder="Masukkan NIK RW" required>
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

    <div class="card card-tabel">
        <div class="card-header card-header-tabel p-4 mb-3">
            <h5>
                Pendataan RW
                <button class="btn btn-add float-end" data-bs-toggle="modal" data-bs-target="#tambahRW">Tambah Data</button>
            </h5>
        </div>
        <hr class="tabel">
        <div class="card-body">
            <div class="table-responsive tabel">
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