@extends('layouts.app')

@section('content')
    <div class="container container-umkm col-10">
        <!-- Modal -->
        <div class="modal fade" id="ajukanUmkmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pengajuan UMKM</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form untuk pengajuan UMKM -->
                        <form action="{{ route('submit.umkm') }}" method="POST">
                            @csrf
                            <!-- Tambahkan input form sesuai kebutuhan -->
                            <div class="form-group mb-3">
                                <label for="nama_umkm" class="form-label">Nama UMKM</label>
                                <input type="text" class="form-control" id="nama_umkm" name="nama_umkm" placeholder="Masukkan Nama UMKM" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama_pemilik" class="form-label">Nama Pemilik</label>
                                <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik" placeholder="Masukkan Nama Pemilik" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="custom-file-label" for="foto_umkm">Foto UMKM</label>
                                <input type="file" class="form-control" id="foto_umkm" name="foto_umkm" required>
                              </div>
                            <div class="form-group mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi UMKM</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Masukkan Deskripsi UMKM" required></textarea>
                            </div>
                            <!-- Tambahkan input lainnya sesuai kebutuhan -->
                        </div>
                            <div class="modal-footer justify-content-end">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
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

        <!-- Tambahkan di mana pun Anda ingin menampilkan pesan -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <a class="fixedButton" id="ajukanUmkmButton" data-bs-toggle="modal" data-bs-target="#ajukanUmkmModal">
            <div class="roundedFixedBtn">
                <button><i class="bi bi-box-arrow-in-up"></i>Ajukan UMKM</button>
            </div>
        </a>
        <h1 class="heading-center">UMKM</h1>
        <p>Fitur UMKM pada SIRW memungkinkan para warga untuk dengan mudah mengakses dan menjelajahi daftar UMKM yang
            beroperasi di lingkungan mereka. Melalui fitur ini, pengguna dapat mengetahui beragam usaha mikro, kecil, dan
            menengah (UMKM) yang terdaftar dalam lingkungan RW ini.</p>
        <div class="card-container">
            <div class="card">
                <img src="https://blog-static.mamikos.com/wp-content/uploads/2023/06/Polinema.jpg" class="card-img-top"
                    alt="Fissure in Sandstone" />
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                    <a href="#!" class="btn btn-primary" data-mdb-ripple-init>Button</a>
                </div>
            </div>
            <div class="card">
                <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/184.webp" class="card-img-top"
                    alt="Fissure in Sandstone" />
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                    <a href="#!" class="btn btn-primary" data-mdb-ripple-init>Button</a>
                </div>
            </div>
            <div class="card">
                <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/184.webp" class="card-img-top"
                    alt="Fissure in Sandstone" />
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                    <a href="#!" class="btn btn-primary" data-mdb-ripple-init>Button</a>
                </div>
            </div>
            <div class="card">
                <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/184.webp" class="card-img-top"
                    alt="Fissure in Sandstone" />
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                    <a href="#!" class="btn btn-primary" data-mdb-ripple-init>Button</a>
                </div>
            </div>
            <div class="card">
                <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/184.webp" class="card-img-top"
                    alt="Fissure in Sandstone" />
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                    <a href="#!" class="btn btn-primary" data-mdb-ripple-init>Button</a>
                </div>
            </div>
            <div class="card">
                <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/184.webp" class="card-img-top"
                    alt="Fissure in Sandstone" />
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                    <a href="#!" class="btn btn-primary" data-mdb-ripple-init>Button</a>
                </div>
            </div>
        </div>
    </div>
    {{-- <h1>pagination</h1> --}}
@endsection
