@extends('layouts.sidebar')

@section('content')
    {{-- Edit Pengajuan Dokumen --}}
    <div class="modal fade" id="editPengajuanDokumenModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Permintaan Dokumen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body justify-content-start text-start">
                    <!-- Form untuk pengeditan pengumuman -->
                    <form id='editPengajuanDokumenForm' method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-group mb-3">
                            <label for="id_pengajuandokumen" class="form-label text-start">ID</label>
                            <input type="text" readonly disabled class="form-control" id="id_pengajuandokumen"
                                name="id_pengajuandokumen" required>
                        </div>
                        {{-- <div class="form-group mb-3">
                            <label for="nama_pemohon" class="form-label text-start">nama_pemohon</label>
                            <input type="text" readonly disabled class="form-control" id="nama_pemohon"
                                name="nama_pemohon" required>
                        </div> --}}
                        <div class="form-group mb-3">
                            <label for="no_rt" class="form-label text-start">No Rt</label>
                            <input type="text" readonly disabled class="form-control" id="no_rt" name="no_rt"
                                required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="nik_pemohon" class="form-label text-start">NIK Pengaju</label>
                            <input type="text" readonly disabled class="form-control" id="nik_pemohon" name="nik_pemohon"
                                required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="nama_asli_pengaju" class="form-label text-start">Nama Pengaju</label>
                            <input type="text" readonly disabled class="form-control" id="nama_asli_pengaju"
                                name="nama_asli_pengaju" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="pekerjaan_pengaju" class="form-label text-start">Pekerjaan Pengaju</label>
                            <input type="text" readonly disabled class="form-control" id="pekerjaan_pengaju"
                                name="pekerjaan_pengaju" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="usia_pengaju" class="form-label text-start">Usia Pengaju</label>
                            <input type="text" readonly disabled class="form-control" id="usia_pengaju"
                                name="usia_pengaju" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="id_dokumen" class="form-label text-start">ID Dokumen</label>
                            <input type="text" readonly disabled class="form-control" id="id_dokumen" name="id_dokumen"
                                required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="jenis_dokumen" class="form-label text-start">Jenis Dokumen</label>
                            <input type="text" readonly disabled class="form-control" id="jenis_dokumen"
                                name="jenis_dokumen" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="status_pengajuan" class="form-label text-start">Status Pengajuan</label>
                            <select class="form-select" id="status_pengajuan" name="status_pengajuan" required>
                                <option value="" selected disabled>Pilih Status Pengajuan</option>
                                <option value="Baru">Baru</option>
                                <option value="Disetujui">Setuju</option>
                                <option value="Ditolak">Tolak</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="keperluan" class="form-label text-start">Keperluan</label>
                            <input type="text" readonly disabled class="form-control" id="keperluan" name="keperluan"
                                required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="catatan" class="form-label text-start">catatan</label>
                            <input type="text" class="form-control" id="catatan" name="catatan" required>
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

    {{-- Modal delete --}}
    <div class="modal fade" id="deletePengajuanDokumenModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Penghapusan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="deletePengajuanDokumenForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="text-center mb-4">
                            <p>Apakah anda yakin ingin menghapus pengajuan dokumen berikut? Sebagai informasi, anda tidak
                                bisa memulihkan
                                data yang telah dihapus.</p>
                            <h5 class="text-danger"><strong id="namaDisplay"></strong></h5>
                            <p class="">(Dokumen : <strong id="jenisDisplay"></strong>)</p>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                title="Batal hapus pengajuan dokumen">Batal</button>
                            <button type="submit" class="btn btn-danger" title="Hapus pengajuan dokumen">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header card-header-tabel p-4 mb-3">
            <h5>
                Permintaan Dokumen
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
            $('#pengajuandokumen-table').ready(function() {

                $('#deletePengajuanDokumenModal').on('show.bs.modal', function(event) {
                    var target = $(event.relatedTarget);
                    let id_pengajuandokumen = target.data('id_pengajuandokumen');
                    let nama = target.data('nama');
                    let jenis_dokumen = target.data('jenis_dokumen');


                    // Set detail pengumuman di elemen teks
                    $('#deletePengajuanDokumenModal #namaDisplay').text(nama);
                    $('#deletePengajuanDokumenModal #jenisDisplay').text(jenis_dokumen);

                    // Generate URL untuk form action
                    let url = "{{ route('pengajuandokumen.destroy', ':__id') }}";
                    url = url.replace(':__id', id_pengajuandokumen);

                    // Set form action attribute
                    $('#deletePengajuanDokumenForm').attr('action', url);
                });


                $("#editPengajuanDokumenModal").on("show.bs.modal", function(event) {

                    var target = $(event.relatedTarget);
                    let id_pengajuandokumen = target.data('id_pengajuandokumen')
                    let nama_pemohon = target.data('nama_pemohon')
                    let no_rt = target.data('no_rt')
                    let nik_pemohon = target.data('nik_pemohon')
                    let nama_asli_pengaju = target.data('nama_asli_pengaju')
                    let pekerjaan_pengaju = target.data('pekerjaan_pengaju')
                    let usia_pengaju = target.data('usia_pengaju')
                    let id_dokumen = target.data('id_dokumen')
                    let jenis_dokumen = target.data('jenis_dokumen')
                    let status_pengajuan = target.data('status_pengajuan')
                    let catatan = target.data('catatan')
                    let keperluan = target.data('keperluan')

                    $('#editPengajuanDokumenModal #id_pengajuandokumen').val(id_pengajuandokumen);
                    $('#editPengajuanDokumenModal #nama_pemohon').val(nama_pemohon);
                    $('#editPengajuanDokumenModal #no_rt').val(no_rt);
                    $('#editPengajuanDokumenModal #nik_pemohon').val(nik_pemohon);
                    $('#editPengajuanDokumenModal #nama_asli_pengaju').val(nama_asli_pengaju);
                    $('#editPengajuanDokumenModal #pekerjaan_pengaju').val(pekerjaan_pengaju);
                    $('#editPengajuanDokumenModal #usia_pengaju').val(usia_pengaju);
                    $('#editPengajuanDokumenModal #id_dokumen').val(id_dokumen);
                    $('#editPengajuanDokumenModal #jenis_dokumen').val(jenis_dokumen);
                    $('#editPengajuanDokumenModal #status_pengajuan').val(status_pengajuan);
                    $('#editPengajuanDokumenModal #catatan').val(catatan);
                    $('#editPengajuanDokumenModal #keperluan').val(keperluan);

                    let url = "{{ route('pengajuandokumen.update', ':__id') }}";
                    url = url.replace(':__id', id_pengajuandokumen);
                    $('#editPengajuanDokumenForm').attr('action', url)
                });
            });
        </script>
    @endpush
@endsection
@push('css')
@endpush
