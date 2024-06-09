@extends('layouts.app')

@section('content')
    <div class="container container-umkm col-10">
        <!-- Modal -->
        <div class="modal fade" id="ajukanUmkmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pengajuan UMKM</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            style="filter: invert(39%) sepia(75%) saturate(6472%) hue-rotate(352deg) brightness(98%) contrast(104%);"></button>
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
                                <input list="nik_pemilik_list" class="form-control" id="nik_pemilik" name="nik_pemilik_umkm"
                                    placeholder="Masukkan Nik Pemilik" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="status_umkm" class="form-label text-start">Status Pengajuan</label>
                                <input type="text" class="form-control" id="status_umkm" name="status_umkm"
                                    placeholder="Baru" value="Baru" disabled readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="wa_umkm" class="form-label">WhatsApp UMKM</label>
                                <input type="text" class="form-control" id="wa_umkm" name="wa_umkm"
                                    placeholder="Masukkan WhatsApp Pemilik/UMKM" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="custom-file-label mb-2" for="foto_umkm">Foto UMKM</label>
                                <input type="file" class="form-control" id="foto_umkm" name="foto_umkm"
                                    placeholder="Masukkan Foto Produk atau UMKM" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="deskripsi_umkm" class="form-label">Deskripsi UMKM</label>
                                <textarea class="form-control" id="deskripsi_umkm" name="deskripsi_umkm" rows="3"
                                    placeholder="Masukkan Deskripsi UMKM" required></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="alamat_umkm" class="form-label text-start">Alamat UMKM</label>
                                <textarea type="text" class="form-control" id="alamat_umkm" name="alamat_umkm" placeholder="Masukkan Alamat UMKM"
                                    required></textarea>
                            </div>
                            <!-- Tambahkan input lainnya sesuai kebutuhan -->
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Kirim</button>
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

        <a class="fixedButton" id="ajukanUmkmButton" data-bs-toggle="modal" data-bs-target="#ajukanUmkmModal"
            title="Ajukan UMKM">
            <div class="roundedFixedBtn">
                <button><i class="bi bi-box-arrow-in-up"></i>Ajukan UMKM</button>
            </div>
        </a>

        <h1 class="heading-center">UMKM</h1>
        <p>Fitur UMKM pada SIRW memungkinkan para warga untuk dengan mudah mengakses dan menjelajahi daftar UMKM yang
            beroperasi di lingkungan mereka. Melalui fitur ini, pengguna dapat mengetahui beragam usaha mikro, kecil, dan
            menengah (UMKM) yang terdaftar dalam lingkungan RW ini.</p>
        <div class="card-container">
            @foreach ($umkms as $umkm)
                <div class="card">

                    <a class="umkm_img_link" href="#" data-toggle="modal" title="Foto UMKM"
                        data-target="#fotoModal{{ $umkm->id_umkm }}">
                        <img src="{{ $umkm->foto_umkm ? asset('storage/' . $umkm->foto_umkm) : 'https://img.freepik.com/free-photo/stylish-asian-girl-making-announcement-megaphone-shouting-with-speakerphone-smiling-inviting-people-recruiting-standing-blue-background_1258-89437.jpg?w=900' }}"
                            class="card-img-top" alt="Foto UMKM{{ $umkm->id_umkm }}" data-id_umkm="{{ $umkm->id_umkm }}"
                            data-target="#fotoModal{{ $umkm->id_umkm }}" />
                    </a>
                    <div class="card-body">
                        <h5 class="card-title text-start" title="Nama UMKM">{{ $umkm->nama_umkm }}</h5>
                        <p class="card-title text-start" style="font-size: 13px;" title="Alamat UMKM">Alamat
                            :&nbsp;{{ $umkm->alamat_umkm }}</p>
                        {{-- <br> --}}
                        <hr class="main" style="height: 2px; background-color: black;">
                        <p class="card-text" title="Deskripsi UMKM">{{ $umkm->deskripsi_umkm }}</p>
                    </div>
                    <div class="card-footer py-3 hub-umkm d-flex justify-content-end">
                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($umkm->alamat_umkm) }}"
                            title="Lokasi UMKM" class="btn btn-warning me-2" data-mdb-ripple-init><svg
                                xmlns="http://www.w3.org/2000/svg" width="0.7em" height="1em" viewBox="0 0 256 367"
                                style="stroke: black; stroke-width: 10px;">
                                <path fill="#34a853"
                                    d="M70.585 271.865a370.712 370.712 0 0 1 28.911 42.642c7.374 13.982 10.448 23.463 15.837 40.31c3.305 9.308 6.292 12.086 12.714 12.086c6.998 0 10.173-4.726 12.626-12.035c5.094-15.91 9.091-28.052 15.397-39.525c12.374-22.15 27.75-41.833 42.858-60.75c4.09-5.354 30.534-36.545 42.439-61.156c0 0 14.632-27.035 14.632-64.792c0-35.318-14.43-59.813-14.43-59.813l-41.545 11.126l-25.23 66.451l-6.242 9.163l-1.248 1.66l-1.66 2.078l-2.914 3.319l-4.164 4.163l-22.467 18.304l-56.17 32.432z" />
                                <path fill="#fbbc04"
                                    d="M12.612 188.892c13.709 31.313 40.145 58.839 58.031 82.995l95.001-112.534s-13.384 17.504-37.662 17.504c-27.043 0-48.89-21.595-48.89-48.825c0-18.673 11.234-31.501 11.234-31.501l-64.489 17.28z" />
                                <path fill="#4285f4"
                                    d="M166.705 5.787c31.552 10.173 58.558 31.53 74.893 63.023l-75.925 90.478s11.234-13.06 11.234-31.617c0-27.864-23.463-48.68-48.81-48.68c-23.969 0-37.735 17.475-37.735 17.475v-57z" />
                                <path fill="#1a73e8"
                                    d="M30.015 45.765C48.86 23.218 82.02 0 127.736 0c22.18 0 38.89 5.823 38.89 5.823L90.29 96.516H36.205z" />
                                <path fill="#ea4335"
                                    d="M12.612 188.892S0 164.194 0 128.414c0-33.817 13.146-63.377 30.015-82.649l60.318 50.759z" />
                            </svg>
                            &nbsp;Lokasi</a>
                        <a href="https://wa.me/{{ substr_replace($umkm->wa_umkm, '62', 0, 1) }}" title="WhatsApp UMKM"
                            class="btn btn-success" data-mdb-ripple-init><i class="bi bi-whatsapp"></i>&nbsp; Hubungi</a>
                        {{-- <button class="btn btn-primary"
                            href="https://wa.me/{{ substr_replace($umkm->wa_umkm, '62', 0, 1) }}"><i
                                class="bi bi-box-arrow-in-up"></i>Hubungi</button> --}}
                    </div>
                </div>
                <!-- Modal untuk setiap UMKM -->
                @if (isset($umkm) && !empty($umkm))
                    <div class="modal fade" id="fotoModal{{ $umkm->id_umkm }}" tabindex="-1" role="dialog"
                        aria-labelledby="fotoModalLabel{{ $umkm->id_umkm }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header d-flex justify-content-between">
                                    <h5 class="modal-title" id="fotoModalLabel{{ $umkm->id_umkm }}">
                                        {{ $umkm->nama_umkm }}</h5>
                                    <i class="bi bi-x-lg text-danger" data-dismiss="modal" aria-label="Close"
                                        style="font-size: 1.5rem; cursor: pointer;"></i>
                                </div>
                                <div class="modal-body">
                                    <img id="modalImg{{ $umkm->id_umkm }}"
                                        src="{{ $umkm->foto_umkm ? asset('storage/' . $umkm->foto_umkm) : 'https://img.freepik.com/free-photo/stylish-asian-girl-making-announcement-megaphone-shouting-with-speakerphone-smiling-inviting-people-recruiting-standing-blue-background_1258-89437.jpg?w=900' }}"
                                        class="img-fluid" alt="Foto UMKM{{ $umkm->id_umkm }}"
                                        style="min-width: 100%; max-height: auto;">
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="mt-4" style="margin-bottom: -2rem">
            {{ $umkms->onEachSide(1)->links() }}
        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Mengatur modal yang akan ditampilkan ketika gambar pengumuman diklik
        $(document).ready(function() {
            $('.umkm_img_link').click(function(event) {
                event.preventDefault(); // Prevent default link behavior
                var modalTarget = $(this).attr('data-target');
                var imgUrl = $(this).find('.modal_img').attr('src');
                var id_umkm = $(this).find('.modal_img').data('id_umkm');

                $('#fotoModalLabel').text('Modal ID: ' + id_umkm); // Example, modify as needed
                $('#modalImg').attr('src', imgUrl);
                $(modalTarget).modal('show');
            });
        });
    </script>
    {{-- <h1>pagination</h1> --}}
@endsection
