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
                                <label for="no_rt" class="form-label">RT Pengaju</label>
                                <select class="form-select" id="no_rt" name="no_rt" required>
                                    <option value="" selected disabled>Pilih RT Pengaju</option>
                                    <?php $no_rts = $no_rts->toArray(); ?>
                                    <?php sort($no_rts); ?>
                                    @foreach ($no_rts as $rt)
                                        <option value="{{ $rt }}">{{ $rt }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nik_pengaju" class="form-label">NIK Pengaju</label>
                                <input list="nik_pengaju_list" class="form-control" id="nik_pengaju" name="nik_pengaju"
                                    placeholder="Masukkan NIK Pengaju" required>
                                <datalist id="nik_pengaju_list">
                                    @foreach ($penduduks as $penduduk)
                                        <option value="{{ $penduduk->nik }}">{{ $penduduk->nik }}</option>
                                    @endforeach
                                </datalist>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama_pengaju" class="form-label">Nama Pengaju</label>
                                <input list="nama_pengaju_list" class="form-control" id="nama_pengaju" name="nama_pengaju"
                                    placeholder="Masukkan Nama Pengaju" required>
                                <datalist id="nama_pengaju_list">
                                    @foreach ($penduduks as $penduduk)
                                        <option value="{{ $penduduk->nama }}">{{ $penduduk->nama }}</option>
                                    @endforeach
                                </datalist>
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
                                        <option value="{{ $dokumen->id_dokumen }}">{{ $dokumen->jenis_dokumen }}</option>
                                    @endforeach
                                </select>
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
            <hr class="tabel">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No. RT</th>
                                <th>Jenis Dokumen</th>
                                <th>Nama Pengaju</th>
                                <th>Status Pengajuan</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengajuanDokumens as $pengajuanDokumen)
                                <tr>
                                    <td>{{ $pengajuanDokumen->no_rt }}</td>
                                    <td>{{ $pengajuanDokumen->dokumen->jenis_dokumen }}</td>
                                    <td>{{ $pengajuanDokumen->nama_pengaju }}</td>
                                    <td>
                                        @if ($pengajuanDokumen->status_pengajuan == 'Baru')
                                            <span
                                                class="badge bg-warning text-dark">{{ $pengajuanDokumen->status_pengajuan }}</span>
                                        @elseif ($pengajuanDokumen->status_pengajuan == 'Selesai')
                                            <span class="badge bg-success">{{ $pengajuanDokumen->status_pengajuan }}</span>
                                        @else
                                            <span
                                                class="badge bg-secondary">{{ $pengajuanDokumen->status_pengajuan }}</span>
                                        @endif
                                    </td>
                                    <td>
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
                </div>
            </div>
        </div>
    </div>
@endsection
