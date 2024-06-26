@extends('layouts.sidebar')

@section('content')
    {{-- Edit Laporan Keuangan --}}
    <?php
    use Carbon\Carbon;
    ?>
    <div class="modal fade" id="editLaporanKeuanganModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Laporan Keuangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Tutup"></button>
                </div>

                <div class="modal-body justify-content-start text-start">
                    <form id='editLaporanKeuanganForm' method="POST">
                        @method('PUT')
                        @csrf

                        <div class="form-group mb-3">
                            <label for="status_pemasukan" class="form-label">Jenis Laporan</label>
                            <select class="form-select" id="status_pemasukan" name="status_pemasukan" required>
                                <option value="" selected disabled>Pilih Jenis Laporan Keuangan</option>
                                <option value="1">Pemasukan</option>
                                <option value="0">Pengeluaran</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nominal" class="form-label text-start">Nominal</label>
                            <input type="text" class="form-control" id="nominal" name="nominal" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="detail" class="form-label text-start">Detail</label>
                            <textarea class="form-control" id="detail" name="detail" rows="3" required></textarea>
                            {{-- <input type="text" class="form-control" id="detail" name="detail" required> --}}
                        </div>

                        <div class="form-group mb-3">
                            <label for="tanggal" class="form-label text-start">Tanggal</label>
                            <input type="text" class="form-control" id="tanggal" name="tanggal"
                                value="{{ Carbon::now()->format('Y-m-d') }}" required readonly style="background-color: #e0e0de">
                        </div>

                        <div class="form-group mb-3">
                            <label for="pihak_terlibat" class="form-label text-start">Pihak Terlibat</label>
                            <input type="text" class="form-control" id="pihak_terlibat" name="pihak_terlibat" required>
                        </div>

                        {{-- <div class="form-group mb-3">
                            <label for="saldo" class="form-label text-start">saldo</label>
                            <input type="text" class="form-control" id="saldo" name="saldo"
                                 required readonly disabled>
                        </div> --}}

                        <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" title="Batal ubah laporan keuangan">Batal</button>
                            <button type="submit" class="btn btn-success" name="submit" value="Submit" title="Ubah laporan keuangan">Simpan
                                Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambah Laporan Keuangan -->
    <div class="modal fade" id="tambahLaporanKeuangan" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Laporan Keuangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Tutup"></button>
                </div>

                <div class="modal-body justify-content-start text-start">
                    <form action="{{ route('laporankeuangan.store') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="status_pemasukan" class="form-label">Jenis Laporan</label>
                            <select class="form-select" id="status_pemasukan" name="status_pemasukan" required>
                                <option value="" selected disabled>Pilih Jenis Laporan Keuangan</option>
                                <option value="1">Pemasukan</option>
                                <option value="0">Pengeluaran</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nominal" class="form-label text-start">Nominal</label>
                            <input type="number" class="form-control" id="nominal" name="nominal"
                                placeholder="Masukkan Nominal" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="detail" class="form-label">Detail</label>
                            <textarea class="form-control" id="detail" name="detail" rows="3" placeholder="Masukkan Detail" required></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                value="{{ Carbon::now()->format('Y-m-d') }}" required readonly style="background-color: #e0e0de">
                        </div>

                        <div class="form-group mb-3">
                            <label for="pihak_terlibat" class="form-label">Pihak Terlibat</label>
                            <input type="text" class="form-control" id="pihak_terlibat" name="pihak_terlibat"
                                placeholder="Masukkan Pihak Terlibat" required>
                        </div>

                        {{-- <div class="form-group mb-3">
                            <label for="saldo" class="form-label text-start">Saldo</label>
                            <input type="text" class="form-control" id="saldo" name="saldo"
                                placeholder="Saldo dikalkulasi secara otomatis" readonly disabled>
                        </div> --}}

                        <!-- Tambahkan input lainnya sesuai kebutuhan -->
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" title="Batal tambah laporan keuangan">Batal</button>
                    <button type="submit" class="btn btn-success" title="Tambah laporan keuangan">Kirim</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteLaporanKeuanganModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Penghapusan</h5>
                    {{-- <h5 class="modal-title" id="exampleModalLabel">Delete pengumuman</h5> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Form untuk penghapusan pengumuman -->
                    <form id="deleteLaporanKeuanganForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="text-center mb-4">
                            <p>Apakah anda yakin akan menghapus laporan keuangan berikut? Sebagai informasi, anda tidak bisa memulihkan data yang telah dihapus.</p>
                            <h5 class="text-danger"><strong id="detailDisplay"></strong></h5>
                            <p class="">(Laporan Tanggal <strong id="tanggalDisplay"></strong>)</p>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" title="Batal hapus laporan keuangan">Batal</button>
                            <button type="submit" class="btn btn-danger" title="Hapus laporan keuangan">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exportLaporanKeuangan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ekspor Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body justify-content-start text-start">
                    <form action="{{ route('laporankeuangan.export') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <p>Anda akan mengunduh data laporan keuangan dengan format file xlsx.
                            <p>
                        </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="submit" class="btn btn-success" title="Unduh laporanKeuangan.xlsx">Unduh</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card card-tabel">
        <div class="card-header card-header-tabel p-4 mb-3">
            <h5>
                Laporan Keuangan
                <span>
                <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#exportLaporanKeuangan" title="Ekspor laporan keuangan">Ekspor Data</button>
                <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#tambahLaporanKeuangan" title="Tambah laporan keuangan">Tambah Data</button>
                </span>
            </h5>
        </div>
        <hr class="tabel">
        <div class="card-body">
            <div class="table-responsive tabel">
                <div class="text-start" style="margin-bottom: -2rem; margin-left: 1rem;">
                    <div class="align-self-center">
                        <h3>Kas RW</h3>
                    </div>
                    <div class="align-self-center">
                        <h2 class="">
                            <b>Rp {{ number_format($saldo, 0, ',', '.') }}</b>
                        </h2>
                    </div>
                </div>
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>

    @push('scripts')
        {{ $dataTable->scripts() }}
        <script>
            $('#laporankeuangan-table').ready(function() {

                $('#deleteLaporanKeuanganModal').on('show.bs.modal', function(event) {
                    var target = $(event.relatedTarget);
                    let id_laporankeuangan = target.data('id');
                    let detail_laporankeuangan = target.data('detail');
                    let tanggal_laporankeuangan = target.data('tanggal');

                    // Set detail pengumuman di elemen teks
                    $('#deleteLaporanKeuanganModal #detailDisplay').text(detail_laporankeuangan);
                    $('#deleteLaporanKeuanganModal #tanggalDisplay').text(tanggal_laporankeuangan);

                    // Generate URL untuk form action
                    let url = "{{ route('laporankeuangan.destroy', ':__id') }}";
                    url = url.replace(':__id', id_laporankeuangan);

                    // Set form action attribute
                    $('#deleteLaporanKeuanganForm').attr('action', url);
                });

                $("#editLaporanKeuanganModal").on("show.bs.modal", function(event) {

                    var target = $(event.relatedTarget);
                    let id_laporankeuangan = target.data('id_laporankeuangan')
                    let nominal = target.data('nominal')
                    let detail = target.data('detail')
                    let tanggal = target.data('tanggal')
                    let pihak_terlibat = target.data('pihak_terlibat')
                    // let saldo = target.data('saldo')
                    let status_pemasukan = target.data('status_pemasukan')

                    $('#editLaporanKeuanganModal #id_laporankeuangan').val(id_laporankeuangan);
                    $('#editLaporanKeuanganModal #nominal').val(nominal);
                    $('#editLaporanKeuanganModal #detail').val(detail);
                    $('#editLaporanKeuanganModal #tanggal').val(tanggal);
                    $('#editLaporanKeuanganModal #pihak_terlibat').val(pihak_terlibat);
                    // $('#editLaporanKeuanganModal #saldo').val(saldo);
                    $('#editLaporanKeuanganModal #status_pemasukan').val(status_pemasukan);

                    let url = "{{ route('laporankeuangan.update', ':__id') }}";
                    url = url.replace(':__id', id_laporankeuangan);
                    $('#editLaporanKeuanganForm').attr('action', url)
                });
            });
        </script>
    @endpush
@endsection

@push('css')
@endpush
