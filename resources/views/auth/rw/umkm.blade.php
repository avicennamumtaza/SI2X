@extends('layouts.user')

@section('content')
    <div class="card">
        <h5 class="card-header p-4 mb-3">Kelola UMKM</h5>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">nama</th>
                            <th scope="col">nik pemilik</th>
                            <th scope="col">foto</th>
                            <th scope="col">deskripsi</th>
                            <th scope="col">status</th>
                            <th scope="col">aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($umkms as $umkm)
                            <tr>
                                <td>{{ $umkm->id_umkm }}</td>
                                <td>{{ $umkm->nama_umkm }}</td>
                                <td>{{ $umkm->nik_pemilik }}</td>
                                <td>{{ $umkm->foto_umkm }}</td>
                                <td>{{ $umkm->desc_umkm }}</td>
                                <td>{{ $umkm->status_umkm }}</td>
                                <td>
                                    <a href="" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('umkm.destroy', $umkm->id_umkm) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
