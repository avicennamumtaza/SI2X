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
                                <input class="form-control" id="nkk" name="nkk" placeholder="Masukkan NKK calon penerima"
                                    required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="penghasilan" class="form-label">Penghasilan Keluarga per Bulan</label>
                                <input class="form-control" id="penghasilan" type="number" name="penghasilan"
                                    placeholder="Masukkan total penghasilan keluarga" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="tanggungan" class="form-label">Jumlah Tanggungan (Orang)</label>
                                <input class="form-control" id="tanggungan" name="tanggungan"
                                    placeholder="Masukkan jumlah orang yang ditanggung" type="number" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="pajak_bumibangunan" class="form-label">Pajak Bumi dan Bangunan</label>
                                <input class="form-control" id="pajak_bumibangunan" type="number" name="pajak_bumibangunan"
                                    placeholder="Masukkan total PBB dari semua tanah/bangunan" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="pajak_kendaraan" class="form-label">Pajak Kendaraan</label>
                                <input class="form-control" id="pajak_kendaraan" type="number" name="pajak_kendaraan"
                                    placeholder="Masukkan total pajak dari semua kendaraan" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="daya_listrik" class="form-label">Daya Listrik</label>
                                <select class="form-select" id="daya_listrik" name="daya_listrik" required>
                                    <option value="" disabled selected>Masukkan daya listrik</option>
                                    <option value="450">450 VA</option>
                                    <option value="900">900 VA</option>
                                    <option value="1300">1300 VA</option>
                                    <option value="2200">2200 VA</option>
                                    <option value="3500">3500 VA</option>
                                </select>
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
        <p class="">Fitur Bantuan Sosial adalah program pemberian bantuan yang <strong>ditujukan kepada keluarga yang membutuhkan.</strong> Apabila ada keluarga
            yang merasa membutuhkannya, dapat dengan mudah mengajukan melalui formulir yang tersedia, klik tombol pojok kanan bawah untuk mengakses
            formulir. Fitur ini dilengkapi sistem pendukung keputusan untuk mempermudah kalkulasi pemeringkatan calon penerima bantuan sosial.
        </p>
    </div>
@endsection
