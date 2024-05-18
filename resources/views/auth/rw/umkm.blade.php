@extends('layouts.sidebar')

@section('content')
    {{-- Edit UMKM --}}
    <div class="modal fade" id="editUmkmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit UMKM</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                            <img id="foto_umkm_preview" class="img-thumbnail" src="" width="300" height="300"
                                alt="Foto UMKM">
                        </div>
                        <div class="form-group mb-3">
                            <label for="deskripsi_umkm" class="form-label text-start">Deskripsi</label>
                            <input type="text" readonly class="form-control" id="deskripsi_umkm" name="deskripsi_umkm" required>
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
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success" name="submit" value="Submit">Simpan
                                Perubahan</button>
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
                    $('#foto_umkm_preview').attr('src', foto_umkm_path);

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
