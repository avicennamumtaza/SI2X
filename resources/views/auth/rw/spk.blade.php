@extends('layouts.sidebar')

@section('content')

{{-- Ekspor Data Bansos MAUT --}}
<div class="modal fade" id="exportMAUT" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ekspor Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    title="Tutup"></button>
            </div>
            <div class="modal-body justify-content-start text-start">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <p>Anda akan mengunduh data penerima bansos dengan format file xlsx.
                        <p>
                    </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="submit" class="btn btn-success" title="Unduh data penerima bansos">Unduh</button>
            </div>
            </form>
        </div>
    </div>
</div>

    <div class="card card-tabel">
        <div class="card-header card-header-tabel p-4 mb-3">
            <h5>
                Sistem Pendukung Keputusan Metode MAUT
                <span>
                    <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#exportMAUT">Ekspor
                        Data</button>
                </span>
            </h5>
        </div>
        <hr class="tabel">
        <div class="card-body">
            <h5>Kriteria</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Bobot</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ktr as $index => $bobot)
                        <tr>
                            <td>Kriteria {{ $bobot->id_ktr }}</td>
                            <td>{{ $bobot->nama_ktr }}</td>
                            <td>{{ $bobot->bobot_ktr }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Tabel Alternatif Awal -->
            <h5>Alternatif Awal</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NKK</th>
                        <th>Penghasilan</th>
                        <th>Tanggungan</th>
                        <th>Pajak Bumi Bangunan</th>
                        <th>Pajak Kendaraan</th>
                        <th>Daya Listrik</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alternatifs as $alternatif)
                        <tr>
                            <td>{{ $alternatif['nkk'] }}</td>
                            <td>{{ $alternatif['penghasilan'] }}</td>
                            <td>{{ $alternatif['tanggungan'] }}</td>
                            <td>{{ $alternatif['pajak_bumibangunan'] }}</td>
                            <td>{{ $alternatif['pajak_kendaraan'] }}</td>
                            <td>{{ $alternatif['daya_listrik'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Tabel Alternatif Ternormalisasi -->
            <h5>Alternatif Ternormalisasi</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NKK</th>
                        <th>Penghasilan</th>
                        <th>Tanggungan</th>
                        <th>Pajak Bumi Bangunan</th>
                        <th>Pajak Kendaraan</th>
                        <th>Daya Listrik</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($normalizedAlternatifs as $index => $alternatif)
                        <tr>
                            <td>{{ $alternatifs[$index]['nkk'] }}</td>
                            <td>{{ $alternatif['penghasilan'] }}</td>
                            <td>{{ $alternatif['tanggungan'] }}</td>
                            <td>{{ $alternatif['pajak_bumibangunan'] }}</td>
                            <td>{{ $alternatif['pajak_kendaraan'] }}</td>
                            <td>{{ $alternatif['daya_listrik'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Tabel Alternatif Terbobot -->
            <h5>Alternatif Terbobot</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NKK</th>
                        <th>Penghasilan</th>
                        <th>Tanggungan</th>
                        <th>Pajak Bumi Bangunan</th>
                        <th>Pajak Kendaraan</th>
                        <th>Daya Listrik</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($finalAlternatifs as $index => $alternatif)
                        <tr>
                            <td>{{ $alternatifs[$index]['nkk'] }}</td>
                            <td>{{ $alternatif['penghasilan'] }}</td>
                            <td>{{ $alternatif['tanggungan'] }}</td>
                            <td>{{ $alternatif['pajak_bumibangunan'] }}</td>
                            <td>{{ $alternatif['pajak_kendaraan'] }}</td>
                            <td>{{ $alternatif['daya_listrik'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Tabel Hasil Akhir (Skor) -->
            <h5>Hasil Akhir (Skor)</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NKK</th>
                        <th>Skor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ranks as $rank)
                        <tr>
                            <td>{{ $rank['nkk'] }}</td>
                            <td>{{ $rank['skor'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
