@extends('layouts.sidebar')

@section('content')
    {{-- <div class="container container-pengumuman col-12"> --}}
    <!-- Modal -->
    <div class="modal fade" id="tambahRT" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah RT</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body justify-content-start text-start">
                    <!-- Form untuk pengajuan pengumuman -->
                    <form action="{{ route('rt.store') }}" method="POST">
                        @csrf
                        <!-- Tambahkan input form sesuai kebutuhan -->

                        <div class="form-group mb-3">
                            <label for="no_rt" class="form-label text-start">Nomor RT</label>
                            <input type="text" class="form-control" id="no_rt" name="no_rt"
                                placeholder="Masukkan Nomor RT" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nik_rt" class="form-label text-start">NIK RT</label>
                            <input type="text" class="form-control" id="nik_rt" name="nik_rt"
                                placeholder="Masukkan NIK RT" required>
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

    {{-- {{-- Edit Pengumuman --}}
    <div class="modal fade" id="editRtModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Rt</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body justify-content-start text-start">
                    <!-- Form untuk pengeditan Rt -->
                    <form id='editRtForm' method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Tambahkan input form sesuai kebutuhan -->
                        <div class="form-group mb-3">
                            <label for="no_rt" class="form-label text-start">Judul</label>
                            <input type="text" class="form-control" id="no_rt" name="no_rt"
                                required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nik_rt" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="nik_rt" name="nik_rt" rows="3" required></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="tanggal_Rt" class="form-label">Tanggal Rt</label>
                            <input type="date" class="form-control" id="tanggal_Rt" name="tanggal_Rt"
                                required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="foto_Rt" class="form-label">Foto</label>
                            <br>
                            {{-- <input type="file" class="form-control" id="foto_Rt" name="foto_Rt" required> --}}
                            <img id="foto_Rt_preview" class="img-thumbnail" src="" width="300"
                                height="300" alt="Foto Rt">
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
                Pendataan RT
                <button class="btn btn-add float-end" data-bs-toggle="modal" data-bs-target="#tambahRT">Tambah
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
            $('#rt-table').ready(function() {
                $("#editRtModal").on("show.bs.modal", function(event) {

                    var target = $(event.relatedTarget);
                    let no_rt = target.data('no_rt')
                    let nik_rt = target.data('nik_rt')
                    // let wa_rt = target.data('wa_rt')
                    let jumlah_keluarga_rt = target.data('jumlah_keluarga_rt')
                    let jumlah_penduduk_rt = target.data('jumlah_penduduk_rt')
                    // let wa_rt = target.data('wa_rt')


                    $('#editRtModal #no_rt').val(judul);
                    $('#editRtModal #nik_rt').val(deskripsi);
                    $('#editRtModal #jumlah_keluarga_rt').val(tanggal);
                    $('#editRtModal #jumlah_penduduk_rt').val(foto);

                    // // Memperbarui src gambar pratinjau
                    // let foto_pengumuman_path = "{{ asset('Foto Pengumuman/') }}/" + foto;
                    // $('#foto_pengumuman_preview').attr('src', foto_pengumuman_path);

                    let url = "{{ route('rt.update', ':__id') }}";
                    url = url.replace(':__id', no_rt);
                    $('#editRtForm').attr('action', url)
                });
            });
        </script>
    @endpush
@endsection

@push('css')
@endpush
