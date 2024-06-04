@extends('layouts.app')

@section('content')
    <div class="container container-p col-10">
        <!-- Modal -->
        <div class="modal fade" id="ajukanBansosModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pengajuan Bantuan Sosial</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            style="filter: invert(39%) sepia(75%) saturate(6472%) hue-rotate(352deg) brightness(98%) contrast(104%);"></button>
                    </div>

                    <div class="modal-body justify-content-start text-start">
                        <!-- Form untuk pengajuan dokumen -->
                        <form action="{{ route('bansos.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="nkk" class="form-label">Nomor Kartu Keluarga</label>
                                <input class="form-control" id="nkk" name="nkk" placeholder="Masukkan NKK anda"
                                    required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="penghasilan" class="form-label">Penghasilan Keluarga per Bulan</label>
                                <input class="form-control" id="penghasilan" type="number" name="penghasilan"
                                    placeholder="Masukkan Penghasilan anda" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="tanggungan" class="form-label">Jumlah Tanggungan</label>
                                <input class="form-control" id="tanggungan" name="tanggungan"
                                    placeholder="Masukkan Jumlah Tanggungan" type="number" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="pajak_bumibangunan" class="form-label">Pajak Bumi dan Bangunan</label>
                                <input class="form-control" id="pajak_bumibangunan" type="number" name="pajak_bumibangunan"
                                    placeholder="Masukkan PBB" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="pajak_kendaraan" class="form-label">Pajak Kendaraan</label>
                                <input class="form-control" id="pajak_kendaraan" type="number" name="pajak_kendaraan"
                                    placeholder="Masukkan Pajak Kendaraan" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="daya_listrik" class="form-label">Daya Listrik</label>
                                <input class="form-control" id="daya_listrik" type="number" name="daya_listrik"
                                    placeholder="Masukkan Daya Listrik" required>
                            </div>
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
            document.getElementById('ajukanbansosButton').addEventListener('click', function() {
                var modal = new bootstrap.Modal(document.getElementById('ajukanBansosModal'));
                modal.show();
            });
        </script>

        <a class="fixedButton" id="ajukanbansosButton" data-bs-toggle="modal" data-bs-target="#ajukanBansosModal"
            title="Ajukan Bansos">
            <div class="roundedFixedBtn">
                <button><i class="bi bi-box-arrow-in-up"></i> Ajukan Bansos</button>
            </div>
        </a>

        <h1 class="heading-center">Bantuan Sosial</h1>
        <p>Bantuan Sosial adalah program yang <strong>ditujukan untuk membantu penduduk yang membutuhkan.</strong> Penduduk
            dapat mengajukan
            bantuan sosial dengan mengisi formulir pengajuan yang tersedia, klik tombol pojok kanan bawah untuk mengakses
            formulir. Program Bantuan Sosial ini didasarkan pada
            beberapa dasar hukum seperti Undang-Undang Nomor 11 Tahun 2009 tentang Kesejahteraan Sosial, Peraturan
            Pemerintah Nomor 39 Tahun 2012 tentang Penyelenggaraan Kesejahteraan Sosial, Peraturan Menteri Sosial Nomor 28
            Tahun 2017 tentang Pedoman Umum Verifikasi dan Validasi Data Terpadu
            Penanganan Fakir Miskin dan Orang Tidak Mampu.
        </p>
    </div>
    </div>
@endsection
