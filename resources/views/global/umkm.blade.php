@extends('layouts.app')

@section('content')
    <div class="container container-umkm col-10">
        <!-- Modal -->
        <div class="modal fade" id="ajukanUmkmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pengajuan UMKM</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body justify-content-start text-start">
                        <!-- Form untuk pengajuan UMKM -->
                        <form action="{{ route('umkm.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Tambahkan input form sesuai kebutuhan -->
                            <div class="form-group mb-3">
                                <label for="nama_umkm" class="form-label text-start">Nama UMKM</label>
                                <input type="text" class="form-control" id="nama_umkm" name="nama_umkm"
                                    placeholder="Masukkan Nama UMKM" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nik_pemilik" class="form-label">NIK Pemilik</label>
                                {{-- <input list="browsers" name="browserr">
                                <datalist id="browsers">
                                    <option value="Chrome">
                                    <option value="Firefox">
                                    <option value="Internet Explorer">
                                    <option value="Opera">
                                    <option value="Safari">
                                </datalist> --}}
                                <input list="nik_pemilik_list" class="form-control" id="nik_pemilik" name="nik_pemilik_umkm"
                                    placeholder="Masukkan Nik Pemilik" required>
                                {{-- <datalist id="nik_pemilik_list">
                                    @foreach ($nik_penduduks as $nik_penduduk)
                                        <option value="{{ $nik_penduduk->nik }}">{{ $nik_penduduk->nik }}</option>
                                    @endforeach
                                </datalist> --}}
                            </div>
                            {{-- <div class="form-group mb-3">
                                <label for="no_rw" class="form-label text-start">No RW</label>
                                <input type="text" class="form-control" id="no_rw" name="no_rw"
                                    placeholder="6" value="6" readonly>
                            </div> --}}
                            <div class="form-group mb-3">
                                <label for="status_umkm" class="form-label text-start">Status Pengajuan</label>
                                <input type="text" class="form-control" id="status_umkm" name="status_umkm"
                                    placeholder="Baru" value="Baru" disabled readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="wa_umkm" class="form-label">WhatsApp</label>
                                <input type="text" class="form-control" id="wa_umkm" name="wa_umkm"
                                    placeholder="Masukkan WhatsApp Pemilik/UMKM" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="custom-file-label mb-2" for="foto_umkm">Foto UMKM</label>
                                <input type="file" class="form-control" id="foto_umkm" name="foto_umkm"
                                    placeholder="Masukkan Foto Produk atau UMKM" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="deskripsi_umkm" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi_umkm" name="deskripsi_umkm" rows="3" placeholder="Masukkan Deskripsi UMKM"
                                    required></textarea>
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

        <script>
            document.getElementById('ajukanUmkmButton').addEventListener('click', function() {
                var modal = new bootstrap.Modal(document.getElementById('ajukanUmkmModal'));
                modal.show();
            });
        </script>

        <a class="fixedButton" id="ajukanUmkmButton" data-bs-toggle="modal" data-bs-target="#ajukanUmkmModal">
            <div class="roundedFixedBtn">
                <button><i class="bi bi-box-arrow-in-up"></i>Ajukan UMKM</button>
            </div>
        </a>

        <!-- Tambahkan di mana pun Anda ingin menampilkan pesan -->
        {{-- @if ($errors->any())
            {{ alert()->error('Title',' $errors->first() '); }}
        @endif --}}

        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <h1 class="heading-center">UMKM</h1>
        <p>Fitur UMKM pada SIRW memungkinkan para warga untuk dengan mudah mengakses dan menjelajahi daftar UMKM yang
            beroperasi di lingkungan mereka. Melalui fitur ini, pengguna dapat mengetahui beragam usaha mikro, kecil, dan
            menengah (UMKM) yang terdaftar dalam lingkungan RW ini.</p>
        <div class="card-container">
            @foreach ($umkms as $umkm)
                <div class="card">
                    <img src="{{ $umkm->foto_umkm ? asset('Foto UMKM/' . $umkm->foto_umkm) : 'https://img.freepik.com/free-photo/stylish-asian-girl-making-announcement-megaphone-shouting-with-speakerphone-smiling-inviting-people-recruiting-standing-blue-background_1258-89437.jpg?w=900' }}"
                        class="card-img-top" alt="Foto UMKM" />
                    <div class="card-body">
                        <h5 class="card-title text-start">{{ $umkm->nama_umkm }}</h5>
                        <p class="card-text">{{ $umkm->deskripsi_umkm }}</p>
                    </div>
                    <div class="card-footer py-3 hub-umkm d-flex justify-content-end">
                        <a href="https://wa.me/{{ substr_replace($umkm->wa_umkm, '62', 0, 1) }}" class="btn btn-success"
                            data-mdb-ripple-init><i class="bi bi-whatsapp"></i>&nbsp;Hubungi</a>
                        {{-- <button class="btn btn-primary"
                            href="https://wa.me/{{ substr_replace($umkm->wa_umkm, '62', 0, 1) }}"><i
                                class="bi bi-box-arrow-in-up"></i>Hubungi</button> --}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- <h1>pagination</h1> --}}
@endsection
