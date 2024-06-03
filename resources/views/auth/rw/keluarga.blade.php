@extends('layouts.sidebar')

@section('content')
    {{-- <div class="container container-keluarga col-12"> --}}
    <!-- Modal -->
    <div class="modal fade" id="tambahKeluarga" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" title="Tambah Keluarga">Tambah Keluarga</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Tutup"></button>
                </div>

                <div class="modal-body justify-content-start text-start">
                    <!-- Form untuk tambah keluarga -->
                    <form action="{{ route('keluarga.store') }}" method="POST">
                        @csrf
                        <!-- Tambahkan input form sesuai kebutuhan -->

                        <div class="form-group mb-3" title="Masukkan NKK">
                            <label for="nkk" class="form-label text-start">NKK</label>
                            <input type="text" class="form-control" id="nkk" name="nkk"
                                placeholder="Masukkan NKK" required>
                        </div>

                        <div class="form-group mb-3" title="Masukkan NIK Kepala Keluarga">
                            <label for="nik_kepala" class="form-label text-start">NIK Kepala Keluarga</label>
                            <input list="nik_list" type="text" class="form-control" id="nik_kepala" name="nik_kepala"
                                placeholder="Masukkan NIK Kepala Keluarga" required>
                            <datalist id="nik_list">
                                @foreach ($niks as $nik)
                                    <option value="{{ $nik }}">{{ $nik }}</option>
                                @endforeach
                            </datalist>
                        </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" title="Batal tambah keluarga">Batal</button>
                    <button type="submit" class="btn btn-success" title="Tambah keluarga">Kirim</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Show Keluarga --}}
    <div class="modal fade" id="showKeluargaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" title="Edit Keluarga">Detail Keluarga</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body justify-content-start text-start">
                    <div class="form-group mb-3">
                        <label for="nkk" class="form-label text-start">NKK</label>
                        <input type="text" class="form-control" id="nkk" name="nkk" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="no_rt" class="form-label text-start">Nomor RT</label>
                        <input type="text" class="form-control" id="no_rt" name="no_rt" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="nik_kepala" class="form-label text-start">NIK Kepala Keluarga</label>
                        <input type="text" class="form-control" id="nik_kepala" name="nik_kepala" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="pendudukList" class="form-label text-start">Anggota Keluarga</label>
                        <ul id="pendudukList" class="list-group">
                            <!-- Daftar penduduk akan dimasukkan di sini -->
                        </ul>
                    </div>

                    <div class="modal-footer justify-content-end">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Keluarga --}}
    <div class="modal fade" id="editKeluargaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" title="Edit Keluarga">Edit Keluarga</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Tutup"></button>
                </div>

                <div class="modal-body justify-content-start text-start">
                    <!-- Form untuk pengeditan keluarga -->
                    <form id='editKeluargaForm' method="POST">
                        @method('PUT')
                        @csrf
                        <!-- Tambahkan input form sesuai kebutuhan -->
                        <div class="form-group mb-3">
                            <label for="nkk" class="form-label text-start">NKK</label>
                            <input type="text" class="form-control" id="nkk" name="nkk"
                                placeholder="Masukkan NKK" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nik_kepala" class="form-label text-start">NIK Kepala Keluarga</label>
                            <input type="text" class="form-control" id="nik_kepala" name="nik_kepala"
                                placeholder="Masukkan NIK Kepala Keluarga" required>
                        </div>

                        <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" title="Batal ubah keluarga">Batal</button>
                            <button type="submit" class="btn btn-success" name="submit" value="Submit" title="Ubah keluarga">Simpan
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
                Keluarga
                <button class="btn btn-add float-end" data-bs-toggle="modal" data-bs-target="#tambahKeluarga" title="Tambah data keluarga">Tambah
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
            $('#keluarga-table').ready(function() {
                $("#showKeluargaModal").on("show.bs.modal", function(event) {

                    var target = $(event.relatedTarget);
                    let nkk = target.data('id')
                    let no_rt = target.data('no_rt')
                    let nik_kepala = target.data('nik_kepala')
                    let anggota = target.data('anggota')

                    $('#showKeluargaModal #nkk').val(nkk);
                    $('#showKeluargaModal #no_rt').val(no_rt);
                    $('#showKeluargaModal #nik_kepala').val(nik_kepala);
                    $('#showKeluargaModal #anggota').val(anggota);

                    // Memuat daftar penduduk berdasarkan NKK
                    $.ajax({
                        url: "{{ url('manage/pendataan/keluarga') }}/" + nkk + "/anggota",
                        method: 'GET',
                        success: function(response) {
                            var pendudukList = $("#pendudukList");
                            pendudukList.empty(); // Kosongkan daftar sebelumnya
                            if (response.length > 0) {
                                response.forEach(function(penduduk) {
                                    pendudukList.append(
                                        '<li class="list-group-item">' + penduduk.nama +
                                        ' (' + penduduk.nik + ')</li>'
                                    );
                                });
                            } else {
                                pendudukList.append(
                                    '<li class="list-group-item">Tidak ada data penduduk</li>');
                            }
                        }
                    });
                });

                $("#editKeluargaModal").on("show.bs.modal", function(event) {

                    var target = $(event.relatedTarget);
                    let nkk = target.data('id')
                    let nik_kepala = target.data('nik_kepala')
                    let jumlah_nik = target.data('jumlah_nik')

                    $('#editKeluargaModal #nkk').val(nkk);
                    $('#editKeluargaModal #nik_kepala').val(nik_kepala);
                    $('#editKeluargaModal #jumlah_nik').val(jumlah_nik);

                    let url = "{{ route('keluarga.update', ':__id') }}";
                    url = url.replace(':__id', nkk);
                    $('#editKeluargaForm').attr('action', url)
                });
            });
        </script>
    @endpush
@endsection

@push('css')
@endpush
