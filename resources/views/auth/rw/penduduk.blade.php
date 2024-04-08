@extends('layouts.rw')

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
                            <label for="nik" class="form-label text-start">Nik</label>
                            <input type="text" class="form-control" id="nik" name="nik"
                                placeholder="Masukkan NIK" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nkk" class="form-label text-start">NKK</label>
                            <input type="text" class="form-control" id="nkk" name="nkk"
                                placeholder="Masukkan NKK" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="no_rt" class="form-label text-start">Nomor RT</label>
                            <input type="text" class="form-control" id="no_rt" name="no_rt"
                                placeholder="Masukkan Nomor RT" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nama" class="form-label text-start">Nama</label>
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
                            <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin"
                                placeholder="Masukkan Jenis Kelamin" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="pekerjaan" class="form-label text-start">Pekerjaan</label>
                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                placeholder="Masukkan Pekerjaan" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="gol_darah" class="form-label text-start">Golongan Darah</label>
                            <input type="text" class="form-control" id="gol_darah" name="gol_darah"
                                placeholder="Masukkan Golongan Darah" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="is_married" class="form-label text-start">Status Menikah</label>
                            <input type="text" class="form-control" id="is_married" name="is_married"
                                placeholder="Masukkan Status Menikah" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="is_stranger" class="form-label text-start">Status Domisili</label>
                            <input type="text" class="form-control" id="is_stranger" name="is_stranger"
                                placeholder="Masukkan Status Domisili" required>
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
                    <form action="" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Tambahkan input form sesuai kebutuhan -->
                        <div class="form-group mb-3">
                            <label for="nik" class="form-label text-start">Nik</label>
                            <input type="text" class="form-control" id="nik" name="nik"
                            {{-- value="{{ $penduduk->nik }}  --}}
                            required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nkk" class="form-label text-start">NKK</label>
                            <input type="text" class="form-control" id="nkk" name="nkk"
                            {{-- value="{{ $penduduk->nkk }}  --}}
                            required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="no_rt" class="form-label text-start">Nomor RT</label>
                            <input type="text" class="form-control" id="no_rt" name="no_rt"
                            {{-- value="{{ $penduduk->no_rt }}  --}}
                            required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nama" class="form-label text-start">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                            {{-- value="{{ $penduduk->nama }}  --}}
                            required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="tempat_lahir" class="form-label text-start">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                            {{-- value="{{ $penduduk->tempat_lahir }}  --}}
                            required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                            {{-- value="{{ $penduduk->tanggal_lahir }}  --}}
                            required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3"
                            {{-- value="{{ $penduduk->alamat }} --}}
                                required></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="jenis_kelamin" class="form-label text-start">Jenis Kelamin</label>
                            <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin"
                            {{-- value="{{ $penduduk->jenis_kelamin }}  --}}
                            required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="pekerjaan" class="form-label text-start">Pekerjaan</label>
                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                            {{-- value="{{ $penduduk->pekerjaan }} --}}
                            required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="gol_darah" class="form-label text-start">Golongan Darah</label>
                            <input type="text" class="form-control" id="gol_darah" name="gol_darah"
                            {{-- value="{{ $penduduk->gol_darah }}  --}}
                            required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="is_married" class="form-label text-start">Status Menikah</label>
                            <input type="text" class="form-control" id="is_married" name="is_married"
                                {{-- value="{{ $penduduk->is_married }}" --}}
                                required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="is_stranger" class="form-label text-start">Status Domisili</label>
                            <input type="text" class="form-control" id="is_stranger" name="is_stranger"
                                {{-- value="{{ $penduduk->is_stranger }}"  --}}
                                required>
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

    {{-- <div class="container"> --}}
    {{-- <table id="myTable" class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">judul</th>
                    <th scope="col">deskripsi</th>
                    <th scope="col">tanggal Pengumuman</th>
                    <th scope="col">aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengumumans as $pengumuman)
                    <tr>
                        {{-- <td>{{ ++$i }}</td> --}}
    {{-- <td>{{ $pengumuman->id_pengumuman }}</td>
                        <td>{{ $pengumuman->judul }}</td>
                        <td>{{ $pengumuman->deskripsi }}</td>
                        <td>{{ $pengumuman->tanggal_pengumuman }}</td>
                        <td>
                            <form style="display: inline-block;"
                                action="{{ route('pengumuman.destroy', $pengumuman->id_pengumuman) }}" method="POST">
                                <a class="btn btn-primary"
                                    href="{{ route('pengumuman.edit', $pengumuman->id_pengumuman) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form> --}}
    {{-- </td>
                    </tr>
                @endforeach
            </tbody>
        </table> --}}

    <div class="card">
        <div class="card-header card-header-tabel p-4 mb-3">
            <h5>
                Penduduk
                <button class="btn btn-add float-end" data-bs-toggle="modal" data-bs-target="#tambahPenduduk">Tambah
                    Data</button>
            </h5>
        </div>
        <hr>
        <div class="card-body">
            <div class="table-responsive">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>

    @push('scripts')
        {{ $dataTable->scripts() }}
        <script>
            // kok gak ke load //gtw
            $('#penduduk-table').ready(function() {
                console.log('loaded')
                console.log($('.edit-user').length)
                $('.edit-user').on('click', function() {

                    // // Ambil data penduduk dari tombol edit yang diklik
                    var nik = $(this).closest('tr').find('.nik').text();
                    var nkk = $(this).closest('tr').find('.nkk').text();
                    var no_rt = $(this).closest('tr').find('.no_rt').text();
                    var nama = $(this).closest('tr').find('.nama').text();
                    var tempat_lahir = $(this).closest('tr').find('.tempat_lahir').text();
                    var tanggal_lahir = $(this).closest('tr').find('.tanggal_lahir').text();
                    var alamat = $(this).closest('tr').find('.alamat').text();
                    var jenis_kelamin = $(this).closest('tr').find('.jenis_kelamin').text();
                    var pekerjaan = $(this).closest('tr').find('.pekerjaan').text();
                    var gol_darah = $(this).closest('tr').find('.gol_darah').text();
                    var is_married = $(this).closest('tr').find('.is_married').text();
                    var is_stranger = $(this).closest('tr').find('.is_stranger').text();
                    // // Masukkan data pengumuman ke dalam modal
                    // $('#editPengumumanModal #judul').val(judul);
                    // $('#editPengumumanModal #deskripsi').val(deskripsi);
                    // $('#editPengumumanModal #tanggal_pengumuman').val(tanggal_pengumuman);

                    // Tampilkan modal
                    $('#editPendudukModal').modal('show');
                });
            });
        </script>
    @endpush


    {{-- <div class="card">
            <h5 class="card-header p-4 mb-3">Kelola Pengumuman
                <button class="btn btn-success float-end" data-bs-toggle="modal"
                    data-bs-target="#tambahPengumuman">Add</button>
            </h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                        <thead> --}}
    {{-- <tr>
                                <th scope="col">id</th>
                                <th scope="col">judul</th>
                                <th scope="col">deskripsi</th>
                                <th scope="col">tanggal Pengumuman</th>
                                <th scope="col">aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengumumans as $pengumuman)
                                <tr> --}}
    {{-- <td>{{ ++$i }}</td> --}}
    {{-- <td>{{ $pengumuman->id_pengumuman }}</td>
                                    <td>{{ $pengumuman->judul }}</td>
                                    <td>{{ $pengumuman->deskripsi }}</td>
                                    <td>{{ $pengumuman->tanggal_pengumuman }}</td> --}}
    {{-- <td>
                                        <form style="display: inline-block;"
                                            action="{{  route('pengumuman.destroy', $pengumuman->id_pengumuman) }}"
                                            method="POST">
                                            <a class="btn btn-primary"
                                                href="{{  route('pengumuman.edit', $pengumuman->id_pengumuman) }}">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> --}}
    {{-- </div>
            </div>
        </div> --}}
    {{-- <script>
        let table = new DataTable('#myTable');
        <script src="https://cdn.datatables.net/v/bs5/dt-2.0.3/datatables.min.js"></script>
    </script> --}}
@endsection

{{-- @section('js_after')

@endsection --}}

@push('css')
@endpush
