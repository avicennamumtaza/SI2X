@extends('layouts.sidebar')

@section('content')
    <!-- Modal for Adding Users -->
    <div class="modal fade" id="tambahUsers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        title="Tutup"></button>
                </div>
                <div class="modal-body justify-content-start text-start">
                    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="nik">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik"
                                placeholder="Masukkan NIK" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="username">Nama Pengguna</label>
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Masukkan Username" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="role" class="form-label text-start">Peran</label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="" selected disabled>Pilih Peran</option>
                                <option value="RT">RT</option>
                                <option value="RW">RW</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="form-label text-start">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Masukkan Email" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="custom-file-label mb-2" for="foto_profil">Foto Profil</label>
                            <input type="file" class="form-control" id="foto_profil" name="foto_profil"
                                placeholder="Masukkan Foto Profil" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Masukkan Password" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" placeholder="Konfirmasi Password" required>
                        </div>
                        <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                title="Batal tambah pengguna">Batal</button>
                            <button type="submit" class="btn btn-success" title="Tambah pengguna">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Show Users Detail-->
    <div class="modal fade" id="showUsersModal" tabindex="-1" aria-labelledby="showUsersModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showUsersModalLabel">Detail User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        title="Tutup"></button>
                </div>
                <div class="modal-body justify-content-start text-start">
                        <div class="form-group mb-3">
                            <label for="nik" class="form-label text-start">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" readonly style="background-color: #e0e0de" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label for="username" class="form-label text-start">Username</label>
                            <input type="text" class="form-control" id="username" name="username" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label for="role" class="form-label text-start">Peran</label>
                            <select class="form-select" id="role" name="role" disabled>
                                <option value="" selected disabled>Pilih Peran</option>
                                <option value="RT">RT</option>
                                <option value="RW">RW</option>
                            </select>
                        </div>
                        <div class="form-group mb-3" hidden>
                            <label class="custom-file-label mb-2" for="foto_profil">Foto Profil</label>
                            <input type="file" class="form-control" id="foto_profil" name="foto_profil">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                title="Batal ubah pengguna">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Editing Users -->
    <div class="modal fade" id="editUsersModal" tabindex="-1" aria-labelledby="editUsersModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUsersModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        title="Tutup"></button>
                </div>
                <div class="modal-body justify-content-start text-start">
                    <form id="editUsersForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="nik" class="form-label text-start">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" readonly style="background-color: #e0e0de" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="username" class="form-label text-start">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="role" class="form-label text-start">Peran</label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="" selected disabled>Pilih Peran</option>
                                <option value="RT">RT</option>
                                <option value="RW">RW</option>
                            </select>
                        </div>
                        <div class="form-group mb-3" hidden>
                            <label class="custom-file-label mb-2" for="foto_profil">Foto Profil</label>
                            <input type="file" class="form-control" id="foto_profil" name="foto_profil">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                title="Batal ubah pengguna">Batal</button>
                            <button type="submit" class="btn btn-success" title="Ubah pengguna">Simpan
                                Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- {{-- Delete user --}}
    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Penghapusan</h5>
                    {{-- <h5 class="modal-title" id="exampleModalLabel">Delete user</h5> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Form untuk penghapusan user -->
                    <form id="deleteUserForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="text-center mb-4">
                            <p>Apakah anda yakin akan menghapus user berikut? Sebagai informasi, anda tidak bisa
                                memulihkan data yang telah dihapus.</p>
                            <h5 class="text-danger"><strong id="nikDisplay"></strong></h5>
                            <p class="">(Nama Pengguna : <strong id="usernameDisplay"></strong>)</p>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                title="Batal hapus user">Batal</button>
                            <button type="submit" class="btn btn-danger" title="Hapus user ">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="card card-tabel">
        <div class="card-header card-header-tabel p-4 mb-3">
            <h5>
                Kelola Pengguna
                <button class="btn btn-add float-end" data-bs-toggle="modal" data-bs-target="#tambahUsers"
                    title="Tambah data pengguna">Tambah
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
            $('#users-table').ready(function() {

                $('#deleteUserModal').on('show.bs.modal', function(event) {
                    var target = $(event.relatedTarget);
                    let id_user = target.data('id_user');
                    let nik = target.data('nik');
                    let username = target.data('username');

                    // Set judul pengumuman di elemen teks
                    $('#deleteUserModal #nikDisplay').text(nik);
                    $('#deleteUserModal #usernameDisplay').text(username);

                    // Generate URL untuk form action
                    let url = "{{ route('users.destroy', ':__id') }}";
                    url = url.replace(':__id', id_user);

                    // Set form action attribute
                    $('#deleteUserForm').attr('action', url);
                });

                $("#showUsersModal").on("show.bs.modal", function(event) {
                    var target = $(event.relatedTarget);
                    let id_user = target.data('id_user')
                    let nik = target.data('nik')
                    let username = target.data('username')
                    let role = target.data('role')

                    $('#showUsersModal #nik').val(nik);
                    $('#showUsersModal #username').val(username);
                    $('#showUsersModal #role').val(role);
                });

                $("#editUsersModal").on("show.bs.modal", function(event) {
                    var target = $(event.relatedTarget);
                    let id_user = target.data('id_user')
                    let nik = target.data('nik')
                    let username = target.data('username')
                    let role = target.data('role')

                    $('#editUsersModal #nik').val(nik);
                    $('#editUsersModal #username').val(username);
                    $('#editUsersModal #role').val(role);

                    let url = "{{ route('users.update', ':__id') }}";
                    url = url.replace(':__id', id_user);
                    $('#editUsersForm').attr('action', url)
                });
            });
        </script>
    @endpush
@endsection
@push('css')
@endpush
