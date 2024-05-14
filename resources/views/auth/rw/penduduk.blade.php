@extends('layouts.sidebar')

@section('content')
    {{-- <div class="container container-penduduk col-12"> --}}
    <!-- Modal -->
    <div class="modal fade" id="tambahPenduduk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Penduduk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body justify-content-start text-start">
                    <!-- Form untuk tambah penduduk -->
                    <form action="{{ route('penduduk.store') }}" method="POST">
                        @csrf
                        <!-- Tambahkan input form sesuai kebutuhan -->
                        <div class="form-group mb-3">
                            <label for="nik" class="form-label text-start">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik"
                                placeholder="Masukkan NIK" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nkk" class="form-label text-start">NKK</label>
                            <input list="nkk_list" type="text" class="form-control" id="nkk" name="nkk"
                                placeholder="Masukkan NKK" required>
                            <datalist id="nkk_list">
                                @foreach ($nkks as $nkk)
                                    <option value="{{ $nkk }}">{{ $nkk }}</option>
                                @endforeach
                            </datalist>
                        </div>

                        <div class="form-group mb-3">
                            <label for="no_rt" class="form-label text-start">Nomor RT</label>
                            <select class="form-select" id="no_rt" name="no_rt" required>
                                <option value="" selected disabled>Pilih Nomor RT</option>
                                @foreach ($no_rts as $no_rt)
                                    <option value="{{ $no_rt }}">{{ $no_rt }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nama" class="form-label text-start">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                placeholder="Masukkan Nama Penduduk" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="tempat_lahir" class="form-label text-start">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                placeholder="Masukkan Tempat Lahir" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan Alamat" required></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="jenis_kelamin" class="form-label text-start">Jenis Kelamin</label>
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="pekerjaan" class="form-label text-start">Pekerjaan</label>
                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                placeholder="Masukkan Pekerjaan" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="golongan_darah" class="form-label text-start">Golongan Darah</label>
                            <select class="form-select" id="golongan_darah" name="golongan_darah" required>
                                <option value="" selected disabled>Pilih Golongan Darah</option>
                                @foreach ($goldar as $item)
                                    <option value={{ $item->value }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="status_pernikahan" class="form-label text-start">Status Menikah</label>
                            <select class="form-select" id="status_pernikahan" name="status_pernikahan" required>
                                <option value="" selected disabled>Pilih Status Menikah</option>
                                <option value="1">Menikah</option>
                                <option value="0">Belum Menikah</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="status_domisili" class="form-label text-start">Status Domisili</label>
                            <select class="form-select" id="status_domisili" name="status_domisili" required>
                                <option value="" selected disabled>Pilih Status Domisili</option>
                                <option value="0">Domisili</option>
                                <option value="1">Non Domisili</option>
                            </select>
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

    {{-- Edit Penduduk --}}
    <div class="modal fade" id="editPendudukModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Penduduk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body justify-content-start text-start">
                    <!-- Form untuk pengeditan pengumuman -->
                    <form id='editPendudukForm' method="POST">
                        @method('PUT')
                        @csrf
                        <!-- Tambahkan input form sesuai kebutuhan -->
                        <div class="form-group mb-3">
                            <label for="nik" class="form-label text-start">Nik</label>
                            <input type="text" class="form-control" id="nik" name="nik" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nkk" class="form-label text-start">NKK</label>
                            <input type="text" class="form-control" id="nkk" name="nkk" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="no_rt" class="form-label text-start">Nomor RT</label>
                            <input type="text" class="form-control" id="no_rt" name="no_rt" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nama" class="form-label text-start">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="tempat_lahir" class="form-label text-start">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="jenis_kelamin" class="form-label text-start">Jenis Kelamin</label>
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="pekerjaan" class="form-label text-start">Pekerjaan</label>
                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="golongan_darah" class="form-label text-start">Golongan Darah</label>
                            <select class="form-select" id="golongan_darah" name="golongan_darah" required>
                                <option value="" selected disabled>Pilih Golongan Darah</option>
                                @foreach ($goldar as $item)
                                    <option value={{ $item->value }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="status_pernikahan" class="form-label text-start">Status Menikah</label>
                            <select class="form-select" id="status_pernikahan" name="status_pernikahan" required>
                                <option value="" selected disabled>Pilih Status Menikah</option>
                                <option value="1">Menikah</option>
                                <option value="0">Belum Menikah</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="status_domisili" class="form-label text-start">Status Domisili</label>
                            <select type="text" class="form-select" id="status_domisili" name="status_domisili" required>
                                <option value="" selected disabled>Pilih Status Domisili</option>
                                <option value="0">Domisili</option>
                                <option value="1">Non Domisili</option>
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
                Penduduk
                <button class="btn btn-add float-end" data-bs-toggle="modal" data-bs-target="#tambahPenduduk">Tambah
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
            $('#penduduk-table').ready(function() {
                $("#editPendudukModal").on("show.bs.modal", function(event) {

                    var target = $(event.relatedTarget);
                    let nik = target.data('id')
                    let nkk = target.data('nkk')
                    let no_rt = target.data('no_rt')
                    let nama = target.data('nama')
                    let tempat_lahir = target.data('tempat_lahir')
                    let tanggal_lahir = target.data('tanggal_lahir')
                    let alamat = target.data('alamat')
                    let jenis_kelamin = target.data('jenis_kelamin')
                    let pekerjaan = target.data('pekerjaan')
                    let golongan_darah = target.data('golongan_darah')
                    let status_pernikahan = target.data('status_pernikahan')
                    let status_domisili = target.data('status_domisili')

                    $('#editPendudukModal #nik').val(nik);
                    $('#editPendudukModal #nkk').val(nkk);
                    $('#editPendudukModal #no_rt').val(no_rt);
                    $('#editPendudukModal #nama').val(nama);
                    $('#editPendudukModal #tempat_lahir').val(tempat_lahir);
                    $('#editPendudukModal #tanggal_lahir').val(tanggal_lahir);
                    $('#editPendudukModal #alamat').val(alamat);
                    $('#editPendudukModal #jenis_kelamin').val(jenis_kelamin);
                    $('#editPendudukModal #pekerjaan').val(pekerjaan);
                    $('#editPendudukModal #golongan_darah').val(golongan_darah);
                    $('#editPendudukModal #status_pernikahan').val(status_pernikahan);
                    $('#editPendudukModal #status_domisili').val(status_domisili);

                    let url = "{{ route('penduduk.update', ':__id') }}";
                    url = url.replace(':__id', nik);
                    $('#editPendudukForm').attr('action', url)
                });
            });
        </script>
    @endpush
@endsection

@push('css')
@endpush
