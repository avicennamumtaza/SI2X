@extends('layouts.sidebar')

@section('content')
    <!-- Modal for Adding Dokumen -->
    <div class="modal fade" id="tambahDokumen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Dokumen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body justify-content-start text-start">
                    <form action="{{ route('dokumen.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="jenis_dokumen">Jenis Dokumen</label>
                            <input type="text" class="form-control" id="jenis_dokumen" name="jenis_dokumen"
                                placeholder="Masukkan Jenis Dokumen" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="deskripsi">Deskripsi Dokumen</label>
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                                placeholder="Masukkan Deskripsi Dokumen" required>
                        </div>
                        <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Editing Dokumen -->
    <div class="modal fade" id="editDokumenModal" tabindex="-1" aria-labelledby="editDokumenModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDokumenModalLabel">Edit Dokumen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body justify-content-start text-start">
                    <form id="editDokumenForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="jenis_dokumen" class="form-label text-start">Jenis Dokumen</label>
                            <input type="text" class="form-control" id="jenis_dokumen" name="jenis_dokumen" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="deskripsi" class="form-label text-start">Deskripsi Dokumen</label>
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-tabel">
        <div class="card-header card-header-tabel p-4 mb-3">
            <h5>
                Kelola Dokumen
                <button class="btn btn-add float-end" data-bs-toggle="modal" data-bs-target="#tambahDokumen">Tambah
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
            $('#dokumen-table').ready(function() {
                $("#editDokumenModal").on("show.bs.modal", function(event) {
                    var target = $(event.relatedTarget);
                    let id_dokumen = target.data('id')
                    let jenis_dokumen = target.data('jenis_dokumen')
                    let deskripsi = target.data('deskripsi')

                    $('#editDokumenModal #jenis_dokumen').val(jenis_dokumen);
                    $('#editDokumenModal #deskripsi').val(deskripsi);

                    let url = "{{ route('dokumen.update', ':__id') }}";
                    url = url.replace(':__id', id_dokumen);
                    $('#editDokumenForm').attr('action', url)
                });
            });
        </script>
    @endpush
@endsection
@push('css')
@endpush
