@extends('layouts.sidebar')

@section('content')
    <div class="card card-tabel">
        <div class="card-header card-header-tabel p-4 mb-3">
            <h5>
                Sistem Pendukung Keputusan Metode A
                <span>
                    {{-- <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#exportPenduduk">Ekspor
                    Data</button>
                <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#importPenduduk">Impor
                    Data</button> --}}
                    {{-- <a href="{{ route('spk.result') }}"><button class="btn btn-add">Kalkulasi Metode A</button></a>
                    <a href="{{ route('spkk.result') }}"><button class="btn btn-add">Kalkulasi Metode B</button></a> --}}
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
