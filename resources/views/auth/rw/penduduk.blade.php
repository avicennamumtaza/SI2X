@extends('layouts.rw')

@section('content')
    {{-- <div class="container container-penduduk col-12"> --}}
    <!-- Modal -->
    <div class="modal fade" id="tambahPenduduk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Penduduk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body justify-content-start text-start">
                    <!-- Form untuk tambah penduduk -->
                    <form action="{{ route('penduduk.store') }}" method="POST">
                        @csrf
                        <!-- Tambahkan input form sesuai kebutuhan -->
                        <div class="form-group mb-3">
                            <label for="nik" class="form-label text-start">Nik</label>
                            <input type="text" class="form-control" id="nik" name="nik"
                                placeholder="Masukkan NIK" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nkk" class="form-label text-start">NKK</label>
                            <input type="text" class="form-control" id="nkk" name="nkk"
                                placeholder="Masukkan NKK" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="no_rt" class="form-label text-start">Nomor RT</label>
                            <input type="text" class="form-control" id="no_rt" name="no_rt"
                                placeholder="Masukkan Nomor RT" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nama" class="form-label text-start">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                placeholder="Masukkan Nama Penduduk" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="tempat_lahir" class="form-label text-start">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                placeholder="Masukkan Tempat Lahir" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan Alamat" required></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="jenis_kelamin" class="form-label text-start">Jenis Kelamin</label>
                            <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin"
                                placeholder="Masukkan Jenis Kelamin" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="pekerjaan" class="form-label text-start">Pekerjaan</label>
                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                placeholder="Masukkan Pekerjaan" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="gol_darah" class="form-label text-start">Golongan Darah</label>
                            <input type="text" class="form-control" id="gol_darah" name="gol_darah"
                                placeholder="Masukkan Golongan Darah" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="is_married" class="form-label text-start">Status Menikah</label>
                            <input type="text" class="form-control" id="is_married" name="is_married"
                                placeholder="Masukkan Status Menikah" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="is_stranger" class="form-label text-start">Status Domisili</label>
                            <input type="text" class="form-control" id="is_stranger" name="is_stranger"
                                placeholder="Masukkan Status Domisili" required>
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

    {{-- Edit Penduduk --}}
    <div class="modal fade" id="editPendudukModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Penduduk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body justify-content-start text-start">
                    <!-- Form untuk pengeditan pengumuman -->
                    <form id='editPendudukForm' method="POST">
                        @method('PUT')
                        @csrf
                        <!-- Tambahkan input form sesuai kebutuhan -->
                        <div class="form-group mb-3">
                            <label for="nik" class="form-label text-start">Nik</label>
                            <input type="text" class="form-control" id="nik" name="nik"
                                 required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nkk" class="form-label text-start">NKK</label>
                            <input type="text" class="form-control" id="nkk" name="nkk"
                                 required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="no_rt" class="form-label text-start">Nomor RT</label>
                            <input type="text" class="form-control" id="no_rt" name="no_rt"
                                 required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nama" class="form-label text-start">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                 required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="tempat_lahir" class="form-label text-start">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                 required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                 required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3"  required></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="jenis_kelamin" class="form-label text-start">Jenis Kelamin</label>
                            <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin"
                                 required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="pekerjaan" class="form-label text-start">Pekerjaan</label>
                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                 required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="gol_darah" class="form-label text-start">Golongan Darah</label>
                            <input type="text" class="form-control" id="gol_darah" name="gol_darah"
                                 required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="is_married" class="form-label text-start">Status Menikah</label>
                            <input type="text" class="form-control" id="is_married" name="is_married"
                                 required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="is_stranger" class="form-label text-start">Status Domisili</label>
                            <input type="text" class="form-control" id="is_stranger" name="is_stranger"
                                 required>
                        </div>

                        <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success" name="submit" value="Submit">Simpan Perubahan</button>
                        </div>
                        </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header card-header-tabel p-4 mb-3">
            <h5>
                Penduduk
                <button class="btn btn-add float-end" data-bs-toggle="modal" data-bs-target="#tambahPenduduk">Tambah
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
        <script>
            $('#penduduk-table').ready(function() {
                $("#editPendudukModal").on("show.bs.modal", function(event) {

                    var target = $(event.relatedTarget);
                    let nik = target.data('id')
                    let nkk = target.data('nkk')
                    let no_rt = target.data('no_rt')
                    let nama = target.data('nama')
                    let tempat_lahir = target.data('tempat_lahir')
                    let tanggal_lahir = target.data('tanggal_lahir')
                    let alamat = target.data('alamat')
                    let jenis_kelamin = target.data('jenis_kelamin')
                    let pekerjaan = target.data('pekerjaan')
                    let gol_darah = target.data('gol_darah')
                    let is_married = target.data('is_married')
                    let is_stranger = target.data('is_stranger')

                    $('#editPendudukModal #nik').val(nik);
                    $('#editPendudukModal #nkk').val(nkk);
                    $('#editPendudukModal #no_rt').val(no_rt);
                    $('#editPendudukModal #nama').val(nama);
                    $('#editPendudukModal #tempat_lahir').val(tempat_lahir);
                    $('#editPendudukModal #tanggal_lahir').val(tanggal_lahir);
                    $('#editPendudukModal #alamat').val(alamat);
                    $('#editPendudukModal #jenis_kelamin').val(jenis_kelamin);
                    $('#editPendudukModal #pekerjaan').val(pekerjaan);
                    $('#editPendudukModal #gol_darah').val(gol_darah);
                    $('#editPendudukModal #is_married').val(is_married);
                    $('#editPendudukModal #is_stranger').val(is_stranger);

                    let url = "{{route('penduduk.update',':__id')}}";
                    url = url.replace(':__id', nik);
                    $('#editPendudukForm').attr('action', url)
                });
            });
        </script>
    @endpush

@endsection

@push('css')
@endpush
