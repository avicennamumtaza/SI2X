@extends('layouts.sidebar')

@section('content')
    {{-- {{-- Delete bansos --}}
    <div class="modal fade" id="deleteBansosModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Penghapusan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Form untuk penghapusan bansos -->
                    <form id="deleteBansosForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="text-center mb-4">
                            <p>Apakah anda yakin akan menghapus data bansos keluarga berikut? Sebagai informasi, anda tidak
                                bisa memulihkan data yang telah dihapus.</p>
                            <h5 class="text-danger"><strong id="nkkDisplay"></strong></h5>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                title="Batal hapus bansos">Batal</button>
                            <button type="submit" class="btn btn-danger" title="Hapus bansos">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="card card-tabel">
        <div class="card-header card-header-tabel p-4 mb-3">
            <h5>
                Calon Keluarga Penerima Bantuan Sosial
                <span>
                    {{-- <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#exportPenduduk">Ekspor
                        Data</button>
                    <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#importPenduduk">Impor
                        Data</button> --}}
                    <a href="{{ route('kriteria.manage') }}"><button class="btn btn-edit">Kriteria</button></a>
                    <a href="{{ route('maut.result') }}"><button class="btn btn-add">Metode MAUT</button></a>
                    <a href="{{ route('mfep.result') }}"><button class="btn btn-add">Metode MFEP</button></a>
                </span>
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

                $('#deleteBansosModal').on('show.bs.modal', function(event) {
                    var target = $(event.relatedTarget);
                    let nkk = target.data('nkk');

                    // Set judul pengumuman di elemen teks
                    $('#deleteBansosModal #nkkDisplay').text(nkk);


                    // Generate URL untuk form action
                    let url = "{{ route('bansos.destroy', ':__id') }}";
                    url = url.replace(':__id', nkk);

                    // Set form action attribute
                    $('#deleteBansosForm').attr('action', url);
                });


            });
        </script>
    @endpush
@endsection
