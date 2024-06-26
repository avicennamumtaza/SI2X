@extends('layouts.sidebar')

@section('content')
    <div class="card card-tabel">
        <div class="card-header card-header-tabel p-4 mb-3">
            <h5>
                Penduduk Lanjut Usia
                <a href="{{ route('penduduk.manage') }}" class="btn btn-add float-end">Kelola Penduduk</a>
            </h5>
        </div>
        <hr class="tabel">
        <div class="card-body">
            <div class="table-responsive tabel">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Usia</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penduduk as $data)
                            <tr>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->nik }}</td>
                                <td>{{ $data->tempat_lahir }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->tanggal_lahir)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->tanggal_lahir)->age }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-1" style="margin-bottom: -1rem">
                {{ $penduduk->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
@endsection
