@extends('layouts.rt')

@section('content')

{{-- Edit Pengajuan Dokumen --}}
<div class="modal fade" id="editPengajuanDokumenModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Pengajuan Dokumen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body justify-content-start text-start">
                <!-- Form untuk pengeditan pengumuman -->
                <form id='editPengajuanDokumenForm' method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group mb-3">
                        <label for="id_pengajuandokumen" class="form-label text-start">id_pengajuandokumen</label>
                        <input type="text" readonly disabled class="form-control" id="id_pengajuandokumen" name="id_pengajuandokumen"
                             required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="id_dokumen" class="form-label text-start">id_dokumen</label>
                        <input type="text" readonly disabled class="form-control" id="id_dokumen" name="id_dokumen"
                             required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="no_rt" class="form-label text-start">no_rt</label>
                        <input type="text" readonly disabled class="form-control" id="no_rt" name="no_rt"
                             required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nik_pengaju" class="form-label text-start">nik_pengaju</label>
                        <input type="text" readonly disabled class="form-control" id="nik_pengaju" name="nik_pengaju"
                             required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nama_pengaju" class="form-label text-start">nama_pengaju</label>
                        <input type="text" readonly disabled class="form-control" id="nama_pengaju" name="nama_pengaju"
                             required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="status_pengajuan" class="form-label text-start">Status Pengajuan</label>
                        <select class="form-select" id="status_pengajuan" name="status_pengajuan" required>
                            <option value="" selected disabled>Pilih Status Pengajuan</option>
                            <option value="Baru">Baru</option>
                            <option value="Disetujui">Disetujui</option>
                            <option value="Dibatalkan">Dibatalkan</option>
                        </select>
                    </div>                    
                    <div class="form-group mb-3">
                        <label for="catatan" class="form-label text-start">catatan</label>
                        <input type="text" class="form-control" id="catatan" name="catatan"
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
                Pengajuan Dokumen
            </h5>
        </div>
        <hr>
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
                $("#editPengajuanDokumenModal").on("show.bs.modal", function(event) {

                    var target = $(event.relatedTarget);
                    let id_pengajuandokumen = target.data('id_pengajuandokumen')
                    let id_dokumen = target.data('id_dokumen')
                    let no_rt = target.data('no_rt')
                    let nik_pengaju = target.data('nik_pengaju')
                    let nama_pengaju = target.data('nama_pengaju')
                    let status_pengajuan = target.data('status_pengajuan')
                    let catatan = target.data('catatan')

                    $('#editPengajuanDokumenModal #id_pengajuandokumen').val(id_pengajuandokumen);
                    $('#editPengajuanDokumenModal #no_rt').val(no_rt);
                    $('#editPengajuanDokumenModal #nik_pengaju').val(nik_pengaju);
                    $('#editPengajuanDokumenModal #nama_pengaju').val(nama_pengaju);
                    $('#editPengajuanDokumenModal #id_dokumen').val(id_dokumen);
                    $('#editPengajuanDokumenModal #status_pengajuan').val(status_pengajuan);
                    $('#editPengajuanDokumenModal #catatan').val(catatan);

                    let url = "{{route('pengajuandokumen.update',':__id')}}";
                    url = url.replace(':__id', id_pengajuandokumen);
                    $('#editPengajuanDokumenForm').attr('action', url)
                });
            });
        </script>
    @endpush

@endsection
@push('css')
@endpush
