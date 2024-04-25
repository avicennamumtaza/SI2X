@extends('layouts.rw')

@section('content')
    <!-- Modal for Adding Users -->
    <div class="modal fade" id="tambahUsers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Users</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body justify-content-start text-start">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="nik">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik"
                                placeholder="Masukkan NIK" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Masukkan Username" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="role">Role</label>
                            <input type="text" class="form-control" id="role" name="role"
                                placeholder="Masukkan Role" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Masukkan Email" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Masukkan Password" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" placeholder="Konfirmasi Password" required>
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

    <!-- Modal for Editing Users -->
    <div class="modal fade" id="editUsersModal" tabindex="-1" aria-labelledby="editUsersModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUsersModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body justify-content-start text-start">
                    <form id="editUsersForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="nik" class="form-label text-start">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="username" class="form-label text-start">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="role" class="form-label text-start">Role</label>
                            <input type="text" class="form-control" id="role" name="role" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="form-label text-start">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="form-label text-start">Password (Leave blank to not
                                change)</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password_confirmation" class="form-label text-start">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation">
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
    <div class="card">
        <div class="card-header card-header-tabel p-4 mb-3">
            <h5>
                Kelola Users
                <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambahUsers">Tambah
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
            $('#users-table').ready(function() {
                $("#editUsersModal").on("show.bs.modal", function(event) {
                    var target = $(event.relatedTarget);
                    let id_user = target.data('id_user')
                    let nik = target.data('nik')
                    let username = target.data('username')
                    let role = target.data('role')
                    let email = target.data('email')
                    let password = target.data('password')
                    let password_conformation = target.data('password_conformation')

                    $('#editUsersModal #nik').val(nik);
                    $('#editUsersModal #username').val(username);
                    $('#editUsersModal #role').val(role);
                    $('#editUsersModal #email').val(email);
                    $('#editUsersModal #password').val(password);
                    // $('#editUsersModal #password_c onfirmation').val(password_confirmation);

                    // $('#editUsersModal #nik').val(button.data('nik'));
                    // $('#editUsersModal #username').val(button.data('username'));
                    // $('#editUsersModal #role').val(button.data('role'));
                    // $('#editUsersModal #email').val(button.data('email'));
                    // $('#editUsersModal #password').val(button.data('password'));
                    // $('#editUsersModal #password_confirmation').val(button.data('password_confirmation'));

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
