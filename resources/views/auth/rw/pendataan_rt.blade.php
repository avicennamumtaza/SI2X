@extends('layouts.sidebar')

@section('content')
    {{-- <div class="container container-pengumuman col-12"> --}}
    <!-- Modal -->
    <div class="modal fade" id="tambahRT" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah RT</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        title="Tutup"></button>
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

                        <div class="form-group mb-3">
                            <label for="wa_rt" class="form-label text-start">Nomor WhatsApp RT</label>
                            <input type="text" class="form-control" id="wa_rt" name="wa_rt"
                                placeholder="Masukkan Nomor WA RT" required>
                        </div>

                        <!-- Tambahkan input lainnya sesuai kebutuhan -->
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                        title="Batal tambah RT">Batal</button>
                    <button type="submit" class="btn btn-success" title="Tambah RT">Kirim</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- show RT --}}
    <div class="modal fade" id="showRtModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail RT</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        title="Tutup"></button>
                </div>

                <div class="modal-body justify-content-start text-start">
                    <!-- Tampilkan nama penduduk berdasarkan nik_rt -->
                    <div class="form-group mb-3">
                        <label for="nama_penduduk" class="form-label text-start">Nama RT</label>
                        <input type="text" class="form-control" id="nama_penduduk" readonly>
                    </div>

                    <!-- Tampilkan nomor RT -->
                    <div class="form-group mb-3">
                        <label for="no_rt" class="form-label text-start">Nomor RT</label>
                        <input type="text" class="form-control" id="no_rt" readonly>
                    </div>

                    <!-- Tampilkan NIK RT -->
                    <div class="form-group mb-3">
                        <label for="nik_rt" class="form-label text-start">NIK RT</label>
                        <input type="text" class="form-control" id="nik_rt" readonly>
                    </div>

                    <!-- Tampilkan nomor WhatsApp RT -->
                    <div class="form-group mb-3">
                        <label for="wa_rt" class="form-label text-start">Nomor WhatsApp RT</label>
                        <input type="text" class="form-control" id="wa_rt" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="jumlah_keluarga" class="form-label text-start">Jumlah Keluarga</label>
                        <input type="text" class="form-control" id="jumlah_keluarga" readonly>
                    </div>

                </div>


                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" title="Tutup">Tutup</button>
                </div>
            </div>
        </div>
    </div>


    {{-- {{-- Edit RT --}}
    <div class="modal fade" id="editRtModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit RT</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        title="Tutup"></button>
                </div>

                <div class="modal-body justify-content-start text-start">
                    <!-- Form untuk pengeditan RT -->
                    <form id='editRtForm' method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Tambahkan input form sesuai kebutuhan -->
                        <div class="form-group mb-3">
                            <label for="no_rt" class="form-label text-start">Nomor RT</label>
                            <input type="text" class="form-control" id="no_rt" name="no_rt" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nik_rt" class="form-label">NIK RT</label>
                            <input type="text" class="form-control" id="nik_rt" name="nik_rt" rows="3"
                                required></input>
                        </div>

                        <div class="form-group mb-3">
                            <label for="wa_rt" class="form-label">Nomor WhatsApp RT</label>
                            <input type="text" class="form-control" id="wa_rt" name="wa_rt" required>
                        </div>

                        <!-- Tambahkan input lainnya sesuai kebutuhan -->
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                        title="Batal ubah RT">Batal</button>
                    <button type="submit" class="btn btn-success" title="Ubah RT">Simpan Perubahan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- {{-- Delete rt --}}
    <div class="modal fade" id="deleteRtModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Penghapusan</h5>
                    {{-- <h5 class="modal-title" id="exampleModalLabel">Delete rt</h5> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Form untuk penghapusan rt -->
                    <form id="deleteRtForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="text-center mb-4">
                            <p>Apakah anda yakin akan menghapus data RT berikut? Sebagai informasi, anda tidak bisa
                                memulihkan data yang telah dihapus.</p>
                            <h5 class="text-danger" style="font-weight:bolder"> RT : <strong id="noDisplay"></strong>
                            </h5>
                            <p class="">(Nama : <strong id="namaDisplay"></strong>)</p>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                title="Batal hapus">Batal</button>
                            <button type="submit" class="btn btn-danger" title="Hapus rt">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-tabel">
        <div class="card-header card-header-tabel p-4 mb-3">
            <h5>
                Pendataan RT
                <button class="btn btn-add float-end" data-bs-toggle="modal" data-bs-target="#tambahRT"
                    title="Tambah data RT">Tambah
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

                $('#deleteRtModal').on('show.bs.modal', function(event) {
                    var target = $(event.relatedTarget);
                    let nik = target.data('nik');
                    let no_rt = target.data('no_rt');
                    let nama_rt = target.data('nama_rt');

                    // Set judul rt di elemen teks
                    $('#deleteRtModal #noDisplay').text(no_rt);
                    $('#deleteRtModal #namaDisplay').text(nama_rt);

                    // Generate URL untuk form action
                    let url = "{{ route('rt.destroy', ':__id') }}";
                    url = url.replace(':__id', no_rt);

                    // Set form action attribute
                    $('#deleteRtForm').attr('action', url);
                });

                $("#showRtModal").on("show.bs.modal", function(event) {
                    var target = $(event.relatedTarget);
                    let no_rt = target.data('id');
                    let nik_rt = target.data('nik_rt');
                    let wa_rt = target.data('wa_rt');
                    let nama_penduduk = target.data('nama');
                    let jumlah_keluarga = target.data('jumlah_keluarga');

                    $('#showRtModal #no_rt').val(no_rt);
                    $('#showRtModal #nik_rt').val(nik_rt);
                    $('#showRtModal #wa_rt').val(wa_rt);
                    $('#showRtModal #nama_penduduk').val(nama_penduduk);
                    $('#showRtModal #jumlah_keluarga').val(jumlah_keluarga);

                    let url = "{{ route('rt.show', ':__id') }}";
                    url = url.replace(':__id', no_rt);
                    $('#showRtForm').attr('action', url);
                });


                $("#editRtModal").on("show.bs.modal", function(event) {

                    var target = $(event.relatedTarget);
                    let no_rt = target.data('id')
                    let nik_rt = target.data('nik_rt')
                    let wa_rt = target.data('wa_rt')


                    $('#editRtModal #no_rt').val(no_rt);
                    $('#editRtModal #nik_rt').val(nik_rt);
                    $('#editRtModal #wa_rt').val(wa_rt);

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
