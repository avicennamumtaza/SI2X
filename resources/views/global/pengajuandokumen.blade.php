@extends('layouts.app')

@section('content')
    <div class="container container-p col-10">
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
            <hr>
            <div class="card-body">
                <div class="table-responsive">
                    {{-- {{ $dataTable->table() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
