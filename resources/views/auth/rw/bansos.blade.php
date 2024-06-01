@extends('layouts.sidebar')

@section('content')
    <div class="card card-tabel">
        <div class="card-header card-header-tabel p-4 mb-3">
            <h5>
                Bantuan Sosial
                <span>
                    {{-- <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#exportPenduduk">Ekspor
                        Data</button>
                    <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#importPenduduk">Impor
                        Data</button> --}}
                        <a href="{{ route('spk.result') }}"><button class="btn btn-add">Kalkulasi Sistem Pendukung Keputusan</button></a>
                </span>
            </h5>
        </div>
        <hr class="tabel">
        <div class="card-body">
            <div class="table-responsive tabel">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
    @push('scripts')
        {{ $dataTable->scripts() }}
    @endpush
@endsection
