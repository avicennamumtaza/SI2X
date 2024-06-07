@extends('layouts.sidebar')

@section('content')

{{-- Detail UMKM --}}
    <div class="modal fade" id="showUmkmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail UMKM</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Tutup"></button>
            </div>

            <div class="modal-body justify-content-start text-start">
                    <div class="form-group mb-3">
                        <label for="nik_pemilik" class="form-label text-start">NIK Pemilik</label>
                        <input type="text" readonly class="form-control" id="nik_pemilik" name="nik_pemilik"
                            readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nama_pemilik" class="form-label text-start">Nama Pemilik</label>
                        <input type="text" readonly class="form-control" id="nama_pemilik" name="nama_pemilik"
                            readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="alamat_pemilik" class="form-label text-start">Alamat Pemilik</label>
                        <input type="text" readonly class="form-control" id="alamat_pemilik" name="alamat_pemilik"
                            readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nama_umkm" class="form-label text-start">Nama UMKM</label>
                        <input type="text" readonly class="form-control" id="nama_umkm" name="nama_umkm" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="wa_umkm" class="form-label text-start">Nomor WhatsApp</label>
                        <input type="text" readonly class="form-control" id="wa_umkm" name="wa_umkm" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="foto_umkm" class="form-label text-start">Foto</label>
                        <br>
                        {{-- <input type="hidden" id="foto_umkm" name="foto_umkm" required> --}}
                        <img id="show_foto_umkm_detail" class="img-thumbnail" src="" width="300" height="300"
                            alt="Foto UMKM">
                    </div>
                    <div class="form-group mb-3">
                        <label for="deskripsi_umkm" class="form-label text-start">Deskripsi</label>
                        <input type="text" readonly class="form-control" id="deskripsi_umkm" name="deskripsi_umkm"
                            readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="status_umkm" class="form-label text-start">Status Pengajuan</label>
                        <select class="form-select" id="status_umkm" name="status_umkm" required>
                            <option value="Baru" selected disabled>Baru</option>
                            {{-- <option value="Baru" disabled>Baru</option> --}}
                            <option value="Disetujui">Setujui</option>
                            <option value="Ditolak">Tolak</option>
                        </select>
                    </div>

                    <div class="modal-footer justify-content-end">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" title="Batal ubah UMKM">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    {{-- Edit UMKM --}}
    <div class="modal fade" id="editUmkmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit UMKM</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Tutup"></button>
                </div>

                <div class="modal-body justify-content-start text-start">
                    <!-- Form untuk pengeditan pengumuman -->
                    <form id='editUmkmForm' method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group mb-3">
                            <label for="nik_pemilik" class="form-label text-start">NIK Pemilik</label>
                            <input type="text" readonly class="form-control" id="nik_pemilik" name="nik_pemilik"
                                required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="nama_pemilik" class="form-label text-start">Nama Pemilik</label>
                            <input type="text" readonly class="form-control" id="nama_pemilik" name="nama_pemilik"
                                required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="alamat_pemilik" class="form-label text-start">Alamat Pemilik</label>
                            <input type="text" readonly class="form-control" id="alamat_pemilik" name="alamat_pemilik"
                                required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="nama_umkm" class="form-label text-start">Nama UMKM</label>
                            <input type="text" readonly class="form-control" id="nama_umkm" name="nama_umkm" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="wa_umkm" class="form-label text-start">Nomor WhatsApp</label>
                            <input type="text" readonly class="form-control" id="wa_umkm" name="wa_umkm" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="foto_umkm" class="form-label text-start">Foto</label>
                            <br>
                            {{-- <input type="hidden" id="foto_umkm" name="foto_umkm" required> --}}
                            <img id="edit_foto_umkm_preview" class="img-thumbnail" src="" width="300" height="300"
                                alt="Foto UMKM">
                        </div>
                        <div class="form-group mb-3">
                            <label for="deskripsi_umkm" class="form-label text-start">Deskripsi</label>
                            <input type="text" readonly class="form-control" id="deskripsi_umkm" name="deskripsi_umkm"
                                required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="status_umkm" class="form-label text-start">Status Pengajuan</label>
                            <select class="form-select" id="status_umkm" name="status_umkm" required>
                                <option value="Baru" selected disabled>Baru</option>
                                {{-- <option value="Baru" disabled>Baru</option> --}}
                                <option value="Disetujui">Setujui</option>
                                <option value="Ditolak">Tolak</option>
                            </select>
                        </div>

                        <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" title="Batal ubah UMKM">Batal</button>
                            <button type="submit" class="btn btn-success" name="submit" value="Submit" title="Ubah UMKM">Simpan
                                Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteUmkmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Penghapusan</h5>
                    {{-- <h5 class="modal-title" id="exampleModalLabel">Delete pengumuman</h5> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Form untuk penghapusan pengumuman -->
                    <form id="deleteUmkmForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="text-center mb-4">
                            <p>Apakah anda yakin ingin menghapus UMKM berikut? Sebagai informasi, anda tidak bisa memulihkan data yang telah dihapus.</p>
                            <h5 class="text-danger"><strong id="namaDisplay"></strong></h5>
                            <p class="">(UMKM Berstatus <strong id="statusDisplay"></strong>)</p>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" title="Batal hapus UMKM">Batal</button>
                            <button type="submit" class="btn btn-danger" title="Hapus UMKM">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-tabel">
        <div class="card-header card-header-tabel p-4 mb-3">
            <h5>
                UMKM
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
            $('#umkm-table').ready(function() {

                $('#deleteUmkmModal').on('show.bs.modal', function(event) {
                    var target = $(event.relatedTarget);
                    let id_umkm = target.data('id');
                    let nama_umkm = target.data('nama');
                    let status_umkm = target.data('status');

                    if (status_umkm == 'Baru') {
                        status_umkm = 'Belum Diproses'
                    }

                    // Set detail pengumuman di elemen teks
                    $('#deleteUmkmModal #namaDisplay').text(nama_umkm);
                    $('#deleteUmkmModal #statusDisplay').text(status_umkm);

                    // Generate URL untuk form action
                    let url = "{{ route('umkm.destroy', ':__id') }}";
                    url = url.replace(':__id', id_umkm);

                    // Set form action attribute
                    $('#deleteUmkmForm').attr('action', url);
                });

                $("#showUmkmModal").on("show.bs.modal", function(event) {
                    var target = $(event.relatedTarget);
                    let id_umkm = target.data('id_umkm');
                    let nik_pemilik = target.data('nik_pemilik');
                    let nama_pemilik = target.data('nama_pemilik');
                    let alamat_pemilik = target.data('alamat_pemilik');
                    let nama_umkm = target.data('nama_umkm');
                    let wa_umkm = target.data('wa_umkm');
                    let foto_umkm = target.data('foto_umkm');
                    let deskripsi_umkm = target.data('deskripsi_umkm');
                    let status_umkm = target.data('status_umkm');

                    // Mengisi nilai input dengan data yang sesuai
                    $('#showUmkmModal #id_umkm').val(id_umkm);
                    $('#showUmkmModal #nik_pemilik').val(nik_pemilik);
                    $('#showUmkmModal #nama_pemilik').val(nama_pemilik);
                    $('#showUmkmModal #alamat_pemilik').val(alamat_pemilik);
                    $('#showUmkmModal #nama_umkm').val(nama_umkm);
                    $('#showUmkmModal #wa_umkm').val(wa_umkm);
                    $('#showUmkmModal #foto_umkm').val(foto_umkm);
                    $('#showUmkmModal #deskripsi_umkm').val(deskripsi_umkm);
                    $('#showUmkmModal #status_umkm').val(status_umkm);

                    // Memperbarui src gambar pratinjau
                    let foto_umkm_path = "{{ asset('Foto UMKM/') }}/" + foto_umkm;
                    $('#show_foto_umkm_detail').attr('src', foto_umkm_path);
                });

                $("#editUmkmModal").on("show.bs.modal", function(event) {
                    var target = $(event.relatedTarget);
                    let id_umkm = target.data('id_umkm');
                    let nik_pemilik = target.data('nik_pemilik');
                    let nama_pemilik = target.data('nama_pemilik');
                    let alamat_pemilik = target.data('alamat_pemilik');
                    let nama_umkm = target.data('nama_umkm');
                    let wa_umkm = target.data('wa_umkm');
                    let foto_umkm = target.data('foto_umkm');
                    let deskripsi_umkm = target.data('deskripsi_umkm');
                    let status_umkm = target.data('status_umkm');

                    // Mengisi nilai input dengan data yang sesuai
                    $('#editUmkmModal #id_umkm').val(id_umkm);
                    $('#editUmkmModal #nik_pemilik').val(nik_pemilik);
                    $('#editUmkmModal #nama_pemilik').val(nama_pemilik);
                    $('#editUmkmModal #alamat_pemilik').val(alamat_pemilik);
                    $('#editUmkmModal #nama_umkm').val(nama_umkm);
                    $('#editUmkmModal #wa_umkm').val(wa_umkm);
                    $('#editUmkmModal #foto_umkm').val(foto_umkm);
                    $('#editUmkmModal #deskripsi_umkm').val(deskripsi_umkm);
                    $('#editUmkmModal #status_umkm').val(status_umkm);

                    // Memperbarui src gambar pratinjau
                    let foto_umkm_path = "{{ asset('Foto UMKM/') }}/" + foto_umkm;
                    $('#edit_foto_umkm_preview').attr('src', foto_umkm_path);

                    // Mengatur URL aksi formulir sesuai dengan ID UMKM
                    let url = "{{ route('umkm.update', ':__id') }}";
                    url = url.replace(':__id', id_umkm);
                    $('#editUmkmForm').attr('action', url);
                });
            });
        </script>
    @endpush
@endsection

@push('css')
@endpush
