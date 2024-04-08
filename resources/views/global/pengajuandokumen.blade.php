@extends('layouts.app')

@section('content')
    <div class="container container-p col-10">
        <!-- Modal -->
        <div class="modal fade" id="ajukanUmkmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pengajuan Dokumen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body justify-content-start text-start">
                        <!-- Form untuk pengajuan UMKM -->
                        <form action="{{ route('pengajuandokumen.store') }}" method="POST">
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
                                <datalist id="nik_pemilik_list">
                                    {{-- @foreach ($nik_penduduks as $nik_penduduk) --}}
                                        {{-- <option value="{{ $nik_penduduk->nik }}">{{ $nik_penduduk->nik }}</option> --}}
                                    {{-- @endforeach --}}
                                </datalist>
                            </div>
                            <div class="form-group mb-3">
                                <label for="no_rw" class="form-label text-start">No RW</label>
                                <input type="text" class="form-control" id="no_rw" name="no_rw"
                                    placeholder="6" value="6" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="status_umkm" class="form-label text-start">Status Pengajuan</label>
                                <input type="text" class="form-control" id="status_umkm" name="status_umkm"
                                    placeholder="Baru" value="Baru" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="wa_umkm" class="form-label">WhatsApp</label>
                                <input type="text" class="form-control" id="wa_umkm" name="wa_umkm"
                                    placeholder="Masukkan WhatsApp Pemilik/UMKM" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="custom-file-label mb-2" for="foto_umkm">Foto UMKM</label>
                                <input type="file" class="form-control" id="foto_umkm" name="foto_umkm" placeholder="Masukkan Foto Produk atau UMKM" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="desc_umkm" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="desc_umkm" name="desc_umkm" rows="3" placeholder="Masukkan Deskripsi UMKM"
                                    required></textarea>
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

        <a class="fixedButton" id="ajukanUmkmButton" data-bs-toggle="modal" data-bs-target="#ajukanUmkmModal">
            <div class="roundedFixedBtn">
                <button><i class="bi bi-box-arrow-in-up"></i>Ajukan Dokumen</button>
            </div>
        </a>

        <h1 class="heading-center">Pengajuan Dokumen</h1>
        <!-- <div class="container"> -->
        <p>Fitur pengajuan dokumen/surat dalam SIRW memberikan kemudahan bagi warga untuk mengajukan dokumen atau surat yang
            diperlukan melalui platform website. Selama proses ini berlangsung, warga dapat memantau status pengajuan
            mereka, sehingga memungkinkan sistem yang lebih transparan.</p>

        <div class="card">
            <div class="card-header card-header-tabel p-4 mb-3">
                <h5>
                    Riwayat Pengajuan Dokumen
                    {{-- <button class="btn btn-add float-end" data-bs-toggle="modal" data-bs-target="#ajukanpengumumanModal">Tambah Data</button> --}}
                </h5>
            </div>
            <hr>
            <div class="card-body">
                <div class="table-responsive">
                    {{-- {{ $dataTable->table() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
