@extends('layouts.rw')

@section('content')
    {{-- <div class="container container-keluarga col-12"> --}}
    <!-- Modal -->
    <div class="modal fade" id="tambahKeluarga" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Keluarga</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body justify-content-start text-start">
                    <!-- Form untuk tambah keluarga -->
                    <form action="{{ route('keluarga.store') }}" method="POST">
                        @csrf
                        <!-- Tambahkan input form sesuai kebutuhan -->

                        <div class="form-group mb-3">
                            <label for="nkk" class="form-label text-start">NKK</label>
                            <input type="text" class="form-control" id="nkk" name="nkk"
                                placeholder="Masukkan NKK" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nik_kepala" class="form-label text-start">NIK Kepala Keluarga</label>
                            <input type="text" class="form-control" id="nik_kepala" name="nik_kepala"
                                placeholder="Masukkan NIK Kepala Keluarga" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="jumlah_nik" class="form-label text-start">Jumlah Anggota</label>
                            <input type="number" class="form-control" id="jumlah_nik" name="jumlah_nik"
                                placeholder="Masukkan Jumlah Anggota" required>
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

    {{-- Edit Keluarga --}}
    <div class="modal fade" id="editKeluargaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Keluarga</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body justify-content-start text-start">
                    <!-- Form untuk pengeditan keluarga -->
                    <form id='editKeluargaForm' method="POST">
                        @method('PUT')
                        @csrf
                        <!-- Tambahkan input form sesuai kebutuhan -->
                        <div class="form-group mb-3">
                            <label for="nkk" class="form-label text-start">NKK</label>
                            <input type="text" class="form-control" id="nkk" name="nkk"
                                placeholder="Masukkan NKK" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nik_kepala" class="form-label text-start">NIK Kepala Keluarga</label>
                            <input type="text" class="form-control" id="nik_kepala" name="nik_kepala"
                                placeholder="Masukkan NIK Kepala Keluarga" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="jumlah_nik" class="form-label text-start">Jumlah Anggota</label>
                            <input type="number" class="form-control" id="jumlah_nik" name="jumlah_nik"
                                placeholder="Masukkan Jumlah Anggota" required>
                        </div>

                        <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success" name="submit" value="Submit">Simpan
                                Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header card-header-tabel p-4 mb-3">
            <h5>
                Keluarga
                <button class="btn btn-add float-end" data-bs-toggle="modal" data-bs-target="#tambahKeluarga">Tambah
                    Data</button>
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
        <script>
            $('#keluarga-table').ready(function() {
                $("#editKeluargaModal").on("show.bs.modal", function(event) {

                    var target = $(event.relatedTarget);
                    let nkk = target.data('id')
                    let nik_kepala = target.data('nik_kepala')
                    let jumlah_nik = target.data('jumlah_nik')

                    $('#editKeluargaModal #nkk').val(nkk);
                    $('#editKeluargaModal #nik_kepala').val(nik_kepala);
                    $('#editKeluargaModal #jumlah_nik').val(jumlah_nik);

                    let url = "{{ route('keluarga.update', ':__id') }}";
                    url = url.replace(':__id', nkk);
                    $('#editKeluargaForm').attr('action', url)
                });
            });
        </script>
    @endpush
@endsection

@push('css')
@endpush
