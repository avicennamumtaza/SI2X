@extends('layouts.sidebar')

@section('content')
    {{-- <div class="container container-penduduk col-12"> --}}
    <!-- Modal -->
    <div class="modal fade" id="tambahPenduduk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Penduduk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        title="Tutup"></button>
                </div>

                <div class="modal-body justify-content-start text-start">
                    <!-- Form untuk tambah penduduk -->
                    <form action="{{ route('penduduk.store') }}" method="POST">
                        @csrf
                        <!-- Tambahkan input form sesuai kebutuhan -->
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="nik" class="form-label text-start">NIK</label>
                                    <input type="text" class="form-control" id="nik" name="nik"
                                        placeholder="Masukkan NIK" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="nama" class="form-label text-start">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Masukkan Nama Penduduk" required>
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
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="tempat_lahir" class="form-label text-start">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                        placeholder="Masukkan Tempat Lahir" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                        required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="jenis_kelamin" class="form-label text-start">Jenis Kelamin</label>
                                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                        @foreach ($jk as $jenisKelamin)
                                            <option value="{{ $jenisKelamin->name }}">{{ $jenisKelamin->getDescription() }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="agama" class="form-label text-start">Agama</label>
                                    <select class="form-select" id="agama" name="agama" required>
                                        <option value="" selected disabled>Pilih Agama</option>
                                        @foreach ($agamas as $agama)
                                            <option value="{{ $agama->value }}">{{ $agama->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="pekerjaan" class="form-label text-start">Pekerjaan</label>
                                    <select class="form-select" id="pekerjaan" name="pekerjaan" required>
                                        <option value="" selected disabled>Pilih Pekerjaan</option>
                                        @foreach ($pekerjaans as $pekerjaan)
                                            <option value="{{ $pekerjaan->value }}">{{ $pekerjaan->value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
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
                                    <label for="pendidikan" class="form-label text-start">Pendidikan</label>
                                    <select class="form-select" id="pendidikan" name="pendidikan" required>
                                        <option value="" selected disabled>Pilih Pendidikan</option>
                                        @foreach ($pendidikans as $pendidikan)
                                            <option value="{{ $pendidikan->value }}">{{ $pendidikan->value }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="golongan_darah" class="form-label text-start">Golongan Darah</label>
                                    <select class="form-select" id="golongan_darah" name="golongan_darah" required>
                                        <option value="" selected disabled>Pilih Golongan Darah</option>
                                        @foreach ($goldar as $item)
                                            <option value="{{ $item->value }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="status_pernikahan" class="form-label text-start">Status Pernikahan</label>
                                    <select class="form-select" id="status_pernikahan" name="status_pernikahan" required>
                                        <option value="" selected disabled>Pilih Status Pernikahan</option>
                                        @foreach ($sp as $statusPernikahan)
                                            <option value="{{ $statusPernikahan->value }}">{{ $statusPernikahan->value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="status_pendatang" class="form-label text-start">Status Pendatang</label>
                                    <select class="form-select" id="status_pendatang" name="status_pendatang" required>
                                        <option value="" selected disabled>Pilih Status Pendatang</option>
                                        <option value="0">Domisili</option>
                                        <option value="1">Non Domisili</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan Alamat" required></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- Tambahkan input lainnya sesuai kebutuhan -->
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                        title="Batal tambah penduduk">Batal</button>
                    <button type="submit" class="btn btn-success" title="Tambah penduduk">Kirim</button>
                </div>
                </form>
            </div>
        </div>
    </div>




    {{-- show penduduk --}}
    <div class="modal fade" id="showPendudukModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Penduduk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        title="Tutup"></button>
                </div>

                <div class="modal-body justify-content-start text-start">
                    <!-- Tempat untuk menampilkan data penduduk -->
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="text" class="form-control" id="nik" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="nkk" class="form-label">NKK</label>
                                <input type="text" class="form-control" id="nkk" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <input type="text" class="form-control" id="jenis_kelamin" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for="agama" class="form-label">Agama</label>
                                <input type="text" class="form-control" id="agama" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for="umur" class="form-label">Umur</label>
                                <input type="text" class="form-control" id="umur" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="no_rt" class="form-label">Nomor RT</label>
                                <input type="text" class="form-control" id="no_rt" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for="pendidikan" class="form-label">Pendidikan</label>
                                <input type="text" class="form-control" id="pendidikan" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                <input type="text" class="form-control" id="pekerjaan" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for="golongan_darah" class="form-label">Golongan Darah</label>
                                <input type="text" class="form-control" id="golongan_darah" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for="status_pernikahan" class="form-label">Status Pernikahan</label>
                                <input type="text" class="form-control" id="status_pernikahan" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for="status_pendatang" class="form-label">Status Pendatang</label>
                                <input type="text" class="form-control" id="status_pendatang" readonly>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" rows="3" readonly></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                            title="Tutup">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Edit Penduduk --}}
    <div class="modal fade" id="editPendudukModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Penduduk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        title="Tutup"></button>
                </div>
                <div class="modal-body justify-content-start text-start">
                    <!-- Form untuk pengeditan pengumuman -->
                    <form id='editPendudukForm' method="POST">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <!-- Tambahkan input form sesuai kebutuhan -->
                                <div class="form-group mb-3">
                                    <label for="nik" class="form-label text-start">NIK</label>
                                    <input type="text" class="form-control" id="nik" name="nik" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="nama" class="form-label text-start">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="nkk" class="form-label text-start">NKK</label>
                                    <input type="text" class="form-control" id="nkk" name="nkk" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="tempat_lahir" class="form-label text-start">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                        required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                        required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="jenis_kelamin" class="form-label text-start">Jenis Kelamin</label>
                                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                        @foreach ($jk as $jenisKelamin)
                                            <option value="{{ $jenisKelamin->value }}">{{ $jenisKelamin->getDescription() }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="agama" class="form-label text-start">Agama</label>
                                    <select class="form-select" id="agama" name="agama" required>
                                        <option value="" selected disabled>Pilih Agama</option>
                                        @foreach ($agamas as $agama)
                                            <option value="{{ $agama->value }}">{{ $agama->value }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="pekerjaan" class="form-label text-start">Pekerjaan</label>
                                    <select class="form-select" id="pekerjaan" name="pekerjaan" required>
                                        <option value="" selected disabled>Pilih Pekerjaan</option>
                                        @foreach ($pekerjaans as $pekerjaan)
                                            <option value="{{ $pekerjaan->value }}">{{ $pekerjaan->value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="no_rt" class="form-label text-start">Nomor RT</label>
                                    <input type="text" class="form-control" id="no_rt" name="no_rt" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="pendidikan" class="form-label text-start">Pendidikan</label>
                                    <select class="form-select" id="pendidikan" name="pendidikan" required>
                                        <option value="" selected disabled>Pilih Pendidikan</option>
                                        @foreach ($pendidikans as $pendidikan)
                                            <option value="{{ $pendidikan->value }}">{{ $pendidikan->value }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="golongan_darah" class="form-label text-start">Golongan Darah</label>
                                    <select class="form-select" id="golongan_darah" name="golongan_darah" required>
                                        <option value="" selected disabled>Pilih Golongan Darah</option>
                                        @foreach ($goldar as $item)
                                            <option value="{{ $item->value }}">{{ $item->value }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="status_pernikahan" class="form-label text-start">Status Pernikahan</label>
                                    <select class="form-select" id="status_pernikahan" name="status_pernikahan" required>
                                        <option value="" selected disabled>Pilih Status Pernikahan</option>
                                        @foreach ($sp as $statusPernikahan)
                                            <option value="{{ $statusPernikahan->value }}">{{ $statusPernikahan->value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="status_pendatang" class="form-label text-start">Status Pendatang</label>
                                    <select type="text" class="form-select" id="status_pendatang"
                                        name="status_pendatang" required>
                                        <option value="" selected disabled>Pilih Status Pendatang</option>
                                        <option value="0">Domisili</option>
                                        <option value="1">Non Domisili</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                title="Batal ubah penduduk">Batal</button>
                            <button type="submit" class="btn btn-success" name="submit" value="Submit"
                                title="Ubah penduduk">Simpan
                                Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="importPenduduk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Impor Penduduk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        title="Tutup"></button>
                </div>
                <div class="modal-body justify-content-start text-start">
                    <form action="{{ route('penduduk.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <input type="file" class="form-control" name="file" accept=".csv">
                        </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="submit" class="btn btn-success" title="Impor data penduduk">Impor</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exportPenduduk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ekspor Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        title="Tutup"></button>
                </div>
                <div class="modal-body justify-content-start text-start">
                    <form action="{{ route('penduduk.export') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <p>Anda akan mengunduh data penduduk dengan format file xlsx.
                            <p>
                        </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="submit" class="btn btn-success" title="Unduh data penduduk">Unduh</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card card-tabel">
        <div class="card-header card-header-tabel p-4 mb-3">
            <h5>
                Penduduk
                <span>
                    <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#exportPenduduk"
                        title="Ekspor data penduduk">Ekspor
                        Data</button>
                    <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#importPenduduk"
                        title="Impor data penduduk">Impor
                        Data</button>
                    <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#tambahPenduduk"
                        title="Tambah data penduduk">Tambah
                        Data</button>
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


    {{-- {{-- Delete penduduk --}}
    <div class="modal fade" id="deletePendudukModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Penghapusan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Form untuk penghapusan penduduk -->
                    <form id="deletePendudukForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="text-center mb-4">
                            <p>Apakah anda yakin akan menghapus data penduduk berikut? Sebagai informasi, anda tidak bisa
                                memulihkan data yang telah dihapus. Dan jika anda menghapus data ini memungkinkan data lain
                                yang
                                terkait data ini juga akan terhapus.</p>
                            <h5 class="text-danger"><strong id="nikDisplay"></strong></h5>
                            <p class="">(Nama : <strong id="namaDisplay"></strong>)</p>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                title="Batal hapus penduduk">Batal</button>
                            <button type="submit" class="btn btn-danger" title="Hapus penduduk">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        {{ $dataTable->scripts() }}
        <script>
            $('#penduduk-table').ready(function() {
                $("#showPendudukModal").on("show.bs.modal", function(event) {
                    var target = $(event.relatedTarget);
                    let nik = target.data('id')
                    let nkk = target.data('nkk')
                    let no_rt = target.data('no_rt')
                    let nama = target.data('nama')
                    let tempat_lahir = target.data('tempat_lahir')
                    let tanggal_lahir = target.data('tanggal_lahir')
                    let umur = target.data('umur');
                    let alamat = target.data('alamat')
                    let agama = target.data('agama')
                    let jenis_kelamin = target.data('jenis_kelamin')
                    let pendidikan = target.data('pendidikan')
                    let pekerjaan = target.data('pekerjaan')
                    let golongan_darah = target.data('golongan_darah')
                    let status_pernikahan = target.data('status_pernikahan')
                    let status_pendatang = target.data('status_pendatang');


                    $('#showPendudukModal #nik').val(nik);
                    $('#showPendudukModal #nkk').val(nkk);
                    $('#showPendudukModal #no_rt').val(no_rt);
                    $('#showPendudukModal #nama').val(nama);
                    $('#showPendudukModal #tempat_lahir').val(tempat_lahir);
                    $('#showPendudukModal #tanggal_lahir').val(tanggal_lahir);
                    $('#showPendudukModal #umur').val(umur);
                    $('#showPendudukModal #alamat').val(alamat);
                    $('#showPendudukModal #agama').val(agama);
                    $('#showPendudukModal #jenis_kelamin').val(jenis_kelamin);
                    $('#showPendudukModal #pendidikan').val(pendidikan);
                    $('#showPendudukModal #pekerjaan').val(pekerjaan);
                    $('#showPendudukModal #golongan_darah').val(golongan_darah);
                    $('#showPendudukModal #status_pernikahan').val(status_pernikahan);
                    $('#showPendudukModal #status_pendatang').val(status_pendatang);

                    let url = "{{ route('penduduk.show', ':__id') }}";
                    url = url.replace(':__id', nik);
                    $('#showPendudukForm').attr('action', url)
                });



                $("#editPendudukModal").on("show.bs.modal", function(event) {

                    var target = $(event.relatedTarget);
                    let nik = target.data('id')
                    let nkk = target.data('nkk')
                    let no_rt = target.data('no_rt')
                    let nama = target.data('nama')
                    let tempat_lahir = target.data('tempat_lahir')
                    let tanggal_lahir = target.data('tanggal_lahir')
                    let alamat = target.data('alamat')
                    let agama = target.data('agama')
                    let jenis_kelamin = target.data('jenis_kelamin')
                    let pendidikan = target.data('pendidikan')
                    let pekerjaan = target.data('pekerjaan')
                    let golongan_darah = target.data('golongan_darah')
                    let status_pernikahan = target.data('status_pernikahan')
                    let status_pendatang = target.data('status_pendatang')

                    $('#editPendudukModal #nik').val(nik);
                    $('#editPendudukModal #nkk').val(nkk);
                    $('#editPendudukModal #no_rt').val(no_rt);
                    $('#editPendudukModal #nama').val(nama);
                    $('#editPendudukModal #tempat_lahir').val(tempat_lahir);
                    $('#editPendudukModal #tanggal_lahir').val(tanggal_lahir);
                    $('#editPendudukModal #alamat').val(alamat);
                    $('#editPendudukModal #agama').val(agama);
                    $('#editPendudukModal #jenis_kelamin').val(jenis_kelamin);
                    $('#editPendudukModal #pendidikan').val(pendidikan);
                    $('#editPendudukModal #pekerjaan').val(pekerjaan);
                    $('#editPendudukModal #golongan_darah').val(golongan_darah);
                    $('#editPendudukModal #status_pernikahan').val(status_pernikahan);
                    $('#editPendudukModal #status_pendatang').val(status_pendatang);

                    let url = "{{ route('penduduk.update', ':__id') }}";
                    url = url.replace(':__id', nik);
                    $('#editPendudukForm').attr('action', url)
                });

                $('#deletePendudukModal').on('show.bs.modal', function(event) {
                    var target = $(event.relatedTarget);
                    let nik = target.data('nik');
                    let nama = target.data('nama');


                    // Set judul penduduk di elemen teks
                    $('#deletePendudukModal #nikDisplay').text(nik);
                    $('#deletePendudukModal #namaDisplay').text(nama);

                    // Generate URL untuk form action
                    let url = "{{ route('penduduk.destroy', ':__id') }}";
                    url = url.replace(':__id', nik);

                    // Set form action attribute
                    $('#deletePendudukForm').attr('action', url);
                });



            });
        </script>
    @endpush
@endsection

@push('css')
@endpush
