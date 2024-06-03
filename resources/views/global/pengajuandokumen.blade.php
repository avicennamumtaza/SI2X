@extends('layouts.app')

@section('content')
    <div class="container container-p col-10">
        <!-- Modal -->
        <div class="modal fade" id="ajukanDokumenModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Permintaan Dokumen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body justify-content-start text-start">
                        <!-- Form untuk pengajuan dokumen -->
                        <form action="{{ route('pengajuandokumen.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="nik_pemohon" class="form-label">NIK Pengaju</label>
                                <input class="form-control" id="nik_pemohon" name="nik_pemohon"
                                    placeholder="Masukkan NIK Pengaju" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="status_umkm" class="form-label text-start">Status Pengajuan</label>
                                <input type="text" class="form-control" id="status_umkm" name="status_umkm"
                                    placeholder="Baru" value="Baru" disabled readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="id_dokumen" class="form-label">Pilih Jenis Dokumen</label>
                                <select class="form-select" id="id_dokumen" name="id_dokumen" required>
                                    <option value="" selected disabled>Pilih Jenis Dokumen</option>
                                    @foreach ($dokumens as $dokumen)
                                        <option value="{{ $dokumen->id_dokumen }}">
                                            {{ $dokumen->jenis_dokumen }}
                                            {{-- <br>{{ $dokumen->deskripsi }} --}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="keperluan" class="form-label">Keperluan</label>
                                <textarea class="form-control" id="keperluan" name="keperluan" rows="3"
                                    placeholder="Contoh : Untuk Pendaftaran Kuliah" required></textarea>
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
            document.getElementById('ajukanDokumenButton').addEventListener('click', function() {
                var modal = new bootstrap.Modal(document.getElementById('ajukanDokumenModal'));
                modal.show();
            });
        </script>

        <a class="fixedButton" id="ajukanDokumenButton" data-bs-toggle="modal" data-bs-target="#ajukanDokumenModal" title="Ajukan Dokumen">
            <div class="roundedFixedBtn">
                <button><i class="bi bi-box-arrow-in-up"></i>Ajukan Dokumen</button>
            </div>
        </a>

        <h1 class="heading-center">Permintaan Dokumen</h1>
        <!-- <div class="container"> -->
        <p>Fitur permintaan dokumen/surat dalam SIRW memberikan kemudahan bagi warga untuk mengajukan dokumen atau surat
            yang
            diperlukan melalui platform website. Selama proses ini berlangsung, warga dapat memantau status pengajuan
            mereka, sehingga memungkinkan sistem yang lebih transparan.</p>

        <div class="card">
            <div class="card-header card-header-tabel p-4 mb-3">
                <h5>
                    Riwayat Permintaan Dokumen
                    {{-- <button class="btn btn-add float-end" data-bs-toggle="modal" data-bs-target="#ajukanpengumumanModal">Tambah Data</button> --}}
                </h5>
            </div>
            <hr class="tabel">
            <div class="card-body">
                {{-- <div class="table-responsive"> --}}
                <table class="table">
                    <thead>
                        <tr>
                            <th title="Nomor RT">RT</th>
                            <th title="NIK yang mengajukan dokumen.">NIK Pemohon</th>
                            <th title="Dokumen yang diajukan">Dokumen</th>
                            <th title="Status pengajuan">Status</th>
                            <th title="Catatan">Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengajuanDokumens as $pengajuanDokumen)
                            <tr>
                                <td style="width: 5%" title="Nomor RT">{{ $pengajuanDokumen->penduduk->no_rt }}</td>
                                <td style="width: 25%" title="NIK yang mengajukan dokumen">
                                    {{ substr($pengajuanDokumen->nik_pemohon, 0, 3) . str_repeat('*', strlen($pengajuanDokumen->nik_pemohon) - 7) . substr($pengajuanDokumen->nik_pemohon, -4) }}
                                </td>
                                <td style="width: 15%" title="Dokumen yang diajukan">{{ $pengajuanDokumen->dokumen->jenis_dokumen }}</td>
                                <td style="width: 5%" title="Status pengajuan">
                                    @if ($pengajuanDokumen->status_pengajuan == 'Baru')
                                        <span style="background-color: darkgoldenrod"
                                            class="badge rounded-pill">{{ $pengajuanDokumen->status_pengajuan }}</span>
                                    @elseif ($pengajuanDokumen->status_pengajuan == 'Disetujui')
                                        <span style="background-color: green"
                                            class="badge rounded-pill">{{ $pengajuanDokumen->status_pengajuan }}</span>
                                    @else
                                        <span style="background-color: red"
                                            class="badge rounded-pill">{{ $pengajuanDokumen->status_pengajuan }}</span>
                                    @endif
                                </td>
                                <td style="width: 40%" title="Catatan">
                                    @if ($pengajuanDokumen->status_pengajuan == 'Baru')
                                        Pengajuan Belum Diproses RT
                                    @else
                                        @if (!$pengajuanDokumen->catatan || $pengajuanDokumen->catatan == '')
                                            Tidak Ada Catatan
                                        @else
                                            {{ $pengajuanDokumen->catatan }}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- </div> --}}
            </div>
            <div class="mx-4" style="margin-block: -0.5rem">
                {{ $pengajuanDokumens->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
@endsection
