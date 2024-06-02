@extends('layouts.app')

@section('content')
    <div class="container container-p col-10">
        <!-- Modal -->
        <div class="modal fade" id="ajukanBansosModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pengajuan Bantuan Sosial</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                <label for="penghasilan" class="form-label">Penghasilan Keluarga</label>
                                <input class="form-control" id="penghasilan" name="penghasilan"
                                    placeholder="Masukkan Penghasilan anda" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="tanggungan" class="form-label">Jumlah Tanggungan</label>
                                <input class="form-control" id="tanggungan" name="tanggungan"
                                    placeholder="Masukkan Jumlah Tanggungan " required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="pajak_bumibangunan" class="form-label">Pajak Bumi dan Bangunan</label>
                                <input class="form-control" id="pajak_bumibangunan" name="pajak_bumibangunan"
                                    placeholder="Masukkan PBB " required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="pajak_kendaraan" class="form-label">Pajak Kendaraan</label>
                                <input class="form-control" id="pajak_kendaraan" name="pajak_kendaraan"
                                    placeholder="Masukkan Pajak Kendaraan" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="daya_listrik" class="form-label">Daya Listrik</label>
                                <input class="form-control" id="daya_listrik" name="daya_listrik"
                                    placeholder="Masukkan Daya Listrik" required>
                            </div>
                            {{-- <div class="form-group mb-3">
                                <label for="id_dokumen" class="form-label">Pilih Jenis Dokumen</label>
                                <select class="form-select" id="id_dokumen" name="id_dokumen" required>
                                    <option value="" selected disabled>Pilih Jenis Dokumen</option>
                                    @foreach ($dokumens as $dokumen)
                                        <option value="{{ $dokumen->id_dokumen }}">
                                            {{ $dokumen->jenis_dokumen }}
                                        </option>
                                    @endforeach
                                </select>
                            </div> --}}
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
            document.getElementById('ajukanBansosButton').addEventListener('click', function() {
                var modal = new bootstrap.Modal(document.getElementById('ajukanBansosModal'));
                modal.show();
            });
        </script>

        <a class="fixedButton" id="ajukanbansosButton" data-bs-toggle="modal" data-bs-target="#ajukanBansosModal"
            title="Ajukan Bansos">
            <div class="roundedFixedBtn">
                <button><i class="bi bi-box-arrow-in-up"></i>Ajukan Bansos</button>
            </div>
        </a>



        <h1 class="heading-center">Bantuan Sosial</h1>
        <!-- <div class="container"> -->
        <p>penjelasa AVICENNA.</p>

    </div>
@endsection
