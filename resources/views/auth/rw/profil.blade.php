@extends('layouts.sidebar')

@section('content')
    <!-- Modal for Editing Users -->
    <div class="modal fade" id="editUserPasswordModal" tabindex="-1" aria-labelledby="editUserPasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserPasswordModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Tutup"></button>
                </div>
                <div class="modal-body justify-content-start text-start">
                    <form id="editUserPasswordForm" action="{{ route('profil.update', $users->id_user) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3" style="display: none;">
                            <label for="nik" class="form-label text-start">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik"
                                value="{{ $users->nik }}" required readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label for="username" class="form-label text-start">Nama Pengguna</label>
                            <input type="text" class="form-control" id="username" value="{{ $users->username }}"
                                name="username" required>
                        </div>
                        <div class="form-group mb-3" style="display: none;">
                            <label for="role" class="form-label text-start">Peran</label>
                            <input type="text" class="form-control" id="role" value="{{ $users->role }}"
                                name="role" required readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="form-label text-start">Email</label>
                            <input type="email" class="form-control" id="email" value="{{ $users->email }}"
                                name="email" required>
                        </div>
                        <div class="form-group mb-3" style="display: none;">
                            <label class="custom-file-label mb-2" for="foto_profil">Foto Profil</label>
                            <input type="file" class="form-control" id="foto_profil"
                                value="{{ $users->foto_profil }}"name="foto_profil">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="form-label text-start">Password (Biarkan Kosong Jika Tidak Ada
                                Perubahan)</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password_confirmation" class="form-label text-start">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" title="Batal edit profil">Batal</button>
                            <button type="submit" class="btn btn-success" title="Edit profil">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        {{-- Edit Foto Profil --}}
    <div class="modal fade" id="editPicture" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ganti Foto Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Tutup"></button>
                </div>
                <div class="modal-body justify-content-start text-start">
                    <form action="{{ route('profil.foto', $users->id_user) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3" style="display: none;">
                            <label for="username" class="form-label text-start">Nama Pengguna</label>
                            <input type="text" class="form-control" id="username" value="{{ $users->username }}"
                                name="username" required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="custom-file-label mb-2" for="foto_profil">Foto Profil</label>
                            <input type="file" class="form-control" id="foto_profil" name="foto_profil" onchange="previewImage(event)">
                            <div class="d-flex justify-content-center pt-4">
                                <img id="image_preview" src="{{ asset($users->foto_profil ? 'Foto Users/' . $users->foto_profil : 'Foto Users/default.jpg') }}" class="img-thumbnail" style="height: 250px; width: 200px;" alt="Foto Profil" title="Foto profil">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="submit" class="btn btn-success" title="Perbarui foto profil">Perbarui</button>
                </div>
                </form>
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
                                    $hash = md5(strtolower(trim($users->email)));
                                    //$gravatar_url = "https://www.gravatar.com/avatar/$hash?s=200&d=mp";
                                @endphp
                                <img src="{{ asset($users->foto_profil ? 'Foto Users/' . $users->foto_profil : 'Foto Users/default.jpg') }}" class="img-thumbnail"
                                    style="height: 250px; width: 200px;" alt="" title="Foto profil anda">
                                <div class="pt-4 mx-4">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#editPicture"
                                        class="edit btn btn-edit btn-sm" title="Ganti foto profil">
                                        Ganti Foto Profil
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-8"> <!-- Kolom untuk form inputan -->
                                <form method="POST" action="{{ route('profil.update', $users->id_user) }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group mb-3">
                                        <label for="nik" class="form-label text-start">NIK</label>
                                        <input type="text" class="form-control" id="nik" name="nik"
                                            value="{{ $users->nik }}" required readonly title="NIK anda">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="username" class="form-label text-start">Nama Pengguna</label>
                                        <input type="text" class="form-control" id="username"
                                            value="{{ $users->username }}" name="username" required readonly title="Nama pengguna anda">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="role" class="form-label text-start">Peran</label>
                                        <input type="text" class="form-control" id="role"
                                            value="{{ $users->role }}" name="role" required readonly title="Peran anda">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label text-start">Email</label>
                                        <input type="email" class="form-control" id="email"
                                            value="{{ $users->email }}" name="email" required readonly title="Email anda">
                                    </div>

                                    <div class="form-group row pe-5 py-2">
                                        <div class="offset-lg-10 offset-md-5">
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#editUserPasswordModal" class="edit btn btn-edit btn-sm" title="Ubah profil">
                                                Edit Profil
                                            </button>

                                            {{-- <button type="submit" class="edit btn btn-edit btn-sm">
                                                {{ __('Simpan') }}
                                            </button> --}}
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

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById('image_preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

@endsection
