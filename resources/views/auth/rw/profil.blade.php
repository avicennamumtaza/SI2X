@extends('layouts.sidebar')

@section('content')
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
                                <form method="POST" action="{{ route('users.update', $user) }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group mb-3">
                                        <label for="nik" class="form-label text-start">NIK</label>
                                        <input type="text" class="form-control" id="nik" name="nik" value="{{ $user->nik }}" required disabled readonly>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="username" class="form-label text-start">Username</label>
                                        <input type="text" class="form-control" id="username" value="{{ $user->username }}" name="username" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="role" class="form-label text-start">Role</label>
                                        <input type="text" class="form-control" id="role" value="{{ $user->role }}" name="role" required disabled readonly>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label text-start">Email</label>
                                        <input type="email" class="form-control" id="email" value="{{ $user->email }}" name="email" required>
                                    </div>

                                    <div class="form-group row pe-5 py-2">
                                        <div class="offset-lg-7 offset-md-5">
                                            <button type="button" class="edit btn btn-edit btn-sm">
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
