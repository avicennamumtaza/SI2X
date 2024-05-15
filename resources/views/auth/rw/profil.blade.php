@extends('layouts.sidebar')

@section('content')
    <!-- Modal for Editing Users -->
    <div class="modal fade" id="editUserPasswordModal" tabindex="-1" aria-labelledby="editUserPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserPasswordModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body justify-content-start text-start">
                    <form id="editUserPasswordForm" action="{{ route('profil.update', $user->id_user) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3" style="display: none;">
                            <label for="nik" class="form-label text-start">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik"
                                value="{{ $user->nik }}" required readonly>
                        </div>
                        <div class="form-group mb-3" style="display: none;">
                            <label for="username" class="form-label text-start">Username</label>
                            <input type="text" class="form-control" id="username"
                                value="{{ $user->username }}" name="username" required>
                        </div>
                        <div class="form-group mb-3" style="display: none;">
                            <label for="role" class="form-label text-start">Role</label>
                            <input type="text" class="form-control" id="role"
                                value="{{ $user->role }}" name="role" required readonly>
                        </div>
                        <div class="form-group mb-3" style="display: none;">
                            <label for="email" class="form-label text-start">Email</label>
                            <input type="email" class="form-control" id="email"
                                value="{{ $user->email }}" name="email" required>
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
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12"> <!-- Mengurangi lebar kolom agar lebih sesuai dengan gambar -->
                <div class="card" style="border: none;">
                    <div class="card-header card-header-tabel p-4 mb-3">
                        <h5>Profil</h5>
                    </div>
                    <hr class="tabel">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-md-5 pt-2 mx-4 p-4"> <!-- Kolom untuk gambar -->
                                {{-- <label for="nik" class="form-label text-start">NIK</label> --}}
                                @php
                                    $hash = md5(strtolower(trim($user->email)));
                                    $gravatar_url = "https://www.gravatar.com/avatar/$hash?s=200&d=mp";
                                @endphp
                                <img src="{{ $gravatar_url }}" class="img-thumbnail" style="height: 250px; width: 200px;"
                                    alt="">
                            </div>
                            <div class="col-md-8"> <!-- Kolom untuk form inputan -->
                                <form method="POST" action="{{ route('profil.update', $user->id_user) }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group mb-3" style="display: none;">
                                        <label for="nik" class="form-label text-start">NIK</label>
                                        <input type="text" class="form-control" id="nik" name="nik"
                                            value="{{ $user->nik }}" required readonly>
                                    </div>
                                    <div class="form-group mb-3" style="display: none;">
                                        <label for="username" class="form-label text-start">Username</label>
                                        <input type="text" class="form-control" id="username"
                                            value="{{ $user->username }}" name="username" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="role" class="form-label text-start">Role</label>
                                        <input type="text" class="form-control" id="role"
                                            value="{{ $user->role }}" name="role" required readonly>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label text-start">Email</label>
                                        <input type="email" class="form-control" id="email"
                                            value="{{ $user->email }}" name="email" required>
                                    </div>

                                    <div class="form-group row pe-5 py-2">
                                        <div class="offset-lg-7 offset-md-5">
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#editUserPasswordModal"
                                                class="edit btn btn-edit btn-sm">
                                                Ganti Password
                                            </button>
                                            <button type="submit" class="edit btn btn-edit btn-sm">
                                                {{ __('Simpan') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
