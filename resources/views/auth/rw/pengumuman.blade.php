@extends('layouts.rw')

@section('content')
    {{-- <div class="container container-pengumuman col-12"> --}}
    <!-- Modal -->
    <div class="modal fade" id="tambahPengumuman" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Pengumuman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body justify-content-start text-start">
                    <!-- Form untuk pengajuan pengumuman -->
                    <form action="{{ route('pengumuman.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Tambahkan input form sesuai kebutuhan -->
                        <div class="form-group mb-3">
                            <label for="judul_pengumuman" class="form-label text-start">Judul</label>
                            <input type="text" class="form-control" id="juduk_pengumuman" name="judul_pengumuman"
                                placeholder="Masukkan Nama pengumuman" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="desc_pengumuman" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="desc_pengumuman" name="desc_pengumuman" rows="3"
                                placeholder="Masukkan Deskripsi pengumuman" required></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="tanggal_pengumuman" class="form-label">Tanggal Pengumuman</label>
                            <input type="date" class="form-control" id="tanggal_pengumuman" name="tanggal_pengumuman"
                                required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="foto_pengumuman" class="form-label">Foto Pengumuman</label>
                            <input type="file" class="form-control" id="foto_pengumuman" name="foto_pengumuman" required>
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
    <div class="modal fade" id="editPengumumanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit pengumuman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body justify-content-start text-start">
                    <!-- Form untuk pengeditan pengumuman -->
                    <form id='editPengumumanForm' method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Tambahkan input form sesuai kebutuhan -->
                        <div class="form-group mb-3">
                            <label for="judul_pengumuman" class="form-label text-start">Judul</label>
                            <input type="text" class="form-control" id="judul_pengumuman" name="judul_pengumuman"
                                required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="desc_pengumuman" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="desc_pengumuman" name="desc_pengumuman" rows="3" required></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="tanggal_pengumuman" class="form-label">Tanggal Pengumuman</label>
                            <input type="date" class="form-control" id="tanggal_pengumuman" name="tanggal_pengumuman"
                                required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="foto_pengumuman" class="form-label">Foto</label>
                            <br>
                            {{-- <input type="file" class="form-control" id="foto_pengumuman" name="foto_pengumuman" required> --}}
                            <img id="foto_pengumuman_preview" class="img-thumbnail" src="" width="300" height="300" alt="Foto Pengumuman">
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

    <div class="card">
        <div class="card-header card-header-tabel p-4 mb-3">
            <h5>
                Pengumuman
                <button class="btn btn-add float-end" data-bs-toggle="modal" data-bs-target="#tambahPengumuman">Tambah
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
            $('#pengumuman-table').ready(function() {
                $("#editPengumumanModal").on("show.bs.modal", function(event) {

                    var target = $(event.relatedTarget);
                    let id_pengumuman = target.data('id')
                    let judul = target.data('judul_pengumuman')
                    let deskripsi = target.data('desc_pengumuman')
                    let tanggal = target.data('tanggal_pengumuman')
                    let foto = target.data('foto_pengumuman')


                    $('#editPengumumanModal #judul_pengumuman').val(judul);
                    $('#editPengumumanModal #desc_pengumuman').val(deskripsi);
                    $('#editPengumumanModal #tanggal_pengumuman').val(tanggal);
                    $('#editPengumumanModal #foto_pengumuman').val(foto);

                    // Memperbarui src gambar pratinjau
                    let foto_pengumuman_path = "{{ asset('Foto Pengumuman/') }}/" + foto;
                    $('#foto_pengumuman_preview').attr('src', foto_pengumuman_path);

                    let url = "{{ route('pengumuman.update', ':__id') }}";
                    url = url.replace(':__id', id_pengumuman);
                    $('#editPengumumanForm').attr('action', url)
                });
            });
        </script>
    @endpush
@endsection

@push('css')
@endpush

{{-- @push('js')
    <script>
        $(document).ready(function() {
            $('.edit').click(function() {
                // Ambil data pengumuman dari tombol edit yang diklik
                var judul = $(this).closest('tr').find('.judul').text();
                var deskripsi = $(this).closest('tr').find('.deskripsi').text();
                var tanggal_pengumuman = $(this).closest('tr').find('.tanggal_pengumuman').text();
                var foto = $(this).closest('tr').find('.foto').text();

                // Masukkan data pengumuman ke dalam modal
                $('#editPengumumanModal #judul').val(judul);
                $('#editPengumumanModal #deskripsi').val(deskripsi);
                $('#editPengumumanModal #tanggal_pengumuman').val(tanggal_pengumuman);
                $('#editPengumumanModal #foto').val(foto);

                // Tampilkan modal
                $('#editPengumumanModal').modal('show');
            });
        });
    </script>
@endpush --}}
