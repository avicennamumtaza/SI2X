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


                        <div class="form-group mb-3">
                            <label for="wa_rw" class="form-label text-start">Nomor WhatsApp RW</label>
                            <input type="text" class="form-control" id="wa_rw" name="wa_rw"
                                placeholder="Masukkan Nomor WhatsApp RW" required>
                        </div>

                        <!-- Tambahkan input lainnya sesuai kebutuhan -->
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Kirim</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- {{-- Show RW --}}
    <div class="modal fade" id="showRwModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail RW</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body justify-content-start text-start">
                    <div class="form-group mb-3">
                        <label for="nama_rw" class="form-label text-start">Nama RW</label>
                        <input type="text" class="form-control" id="nama_rw" name="nama_rw" readonly>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="no_rw" class="form-label text-start">Nomor RW</label>
                        <input type="text" class="form-control" id="no_rw" name="no_rw" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="nik_rw" class="form-label">NIK RW</label>
                        <input type="text" class="form-control" id="nik_rw" name="nik_rw" readonly></input>
                    </div>

                    <div class="form-group mb-3">
                        <label for="wa_rw" class="form-label">Nomor WhatsApp RW</label>
                        <input type="text" class="form-control" id="wa_rw" name="wa_rw" readonly>
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- {{-- Edit RW --}}
    <div class="modal fade" id="editRwModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit RW</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body justify-content-start text-start">
                    <!-- Form untuk pengeditan RW -->
                    <form id='editRwForm' method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Tambahkan input form sesuai kebutuhan -->
                        <div class="form-group mb-3">
                            <label for="no_rw" class="form-label text-start">Nomor RW</label>
                            <input type="text" class="form-control" id="no_rw" name="no_rw" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nik_rw" class="form-label">NIK RW</label>
                            <input type="text" class="form-control" id="nik_rw" name="nik_rw" rows="3"
                                required></input>
                        </div>

                        <div class="form-group mb-3">
                            <label for="wa_rw" class="form-label">Nomor WhatsApp RW</label>
                            <input type="text" class="form-control" id="wa_rw" name="wa_rw" required>
                        </div>

                        <!-- Tambahkan input lainnya sesuai kebutuhan -->
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card card-tabel">
        <div class="card-header card-header-tabel p-4 mb-3">
            <h5>
                Pendataan RW
                <button class="btn btn-add float-end" data-bs-toggle="modal" data-bs-target="#tambahRW">Tambah
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
            $('#rw-table').ready(function() {
                $("#showRwModal").on("show.bs.modal", function(event) {

                    var target = $(event.relatedTarget);
                    let no_rw = target.data('id')
                    let nik_rw = target.data('nik_rw')
                    let wa_rw = target.data('wa_rw')
                    let nama_rw = target.data('nama_rw')

                    $('#showRwModal #no_rw').val(no_rw);
                    $('#showRwModal #nik_rw').val(nik_rw);
                    $('#showRwModal #wa_rw').val(wa_rw);
                    $('#showRwModal #nama_rw').val(nama_rw);
                });

                $("#editRwModal").on("show.bs.modal", function(event) {

                    var target = $(event.relatedTarget);
                    let no_rw = target.data('id')
                    let nik_rw = target.data('nik_rw')
                    let wa_rw = target.data('wa_rw')


                    $('#editRwModal #no_rw').val(no_rw);
                    $('#editRwModal #nik_rw').val(nik_rw);
                    $('#editRwModal #wa_rw').val(wa_rw);

                    let url = "{{ route('rw.update', ':__id') }}";
                    url = url.replace(':__id', no_rw);
                    $('#editRwForm').attr('action', url)
                });
            });
        </script>
    @endpush
@endsection

@push('css')
@endpush
