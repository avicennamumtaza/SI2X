@extends('layouts.user')

@section('content')
    {{-- <div class="container container-pengumuman col-12"> --}}
        <!-- Modal -->
        <div class="modal fade" id="ajukanpengumumanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambahkan pengumuman</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body justify-content-start text-start">
                        <!-- Form untuk pengajuan pengumuman -->
                        <form action="{{ route('pengumuman.store') }}" method="POST">
                            @csrf
                            <!-- Tambahkan input form sesuai kebutuhan -->
                            <div class="form-group mb-3">
                                <label for="nama_pengumuman" class="form-label text-start">Judul</label>
                                <input type="text" class="form-control" id="nama_pengumuman" name="nama_pengumuman"
                                    placeholder="Masukkan Nama pengumuman" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="desc_pengumuman" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="desc_pengumuman" name="desc_pengumuman" rows="3"
                                    placeholder="Masukkan Deskripsi pengumuman" required></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="tanggal_pengumuman" class="form-label">Tanggal Pengumuman</label>
                                <input type="date" class="form-control" id="tanggal_pengumuman" name="tanggal_pengumuman"
                                    required>
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

    {{-- <div class="container"> --}}
        {{-- <table id="myTable" class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">judul</th>
                    <th scope="col">deskripsi</th>
                    <th scope="col">tanggal Pengumuman</th>
                    <th scope="col">aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengumumans as $pengumuman)
                    <tr>
                        {{-- <td>{{ ++$i }}</td> --}}
        {{-- <td>{{ $pengumuman->id_pengumuman }}</td>
                        <td>{{ $pengumuman->judul }}</td>
                        <td>{{ $pengumuman->deskripsi }}</td>
                        <td>{{ $pengumuman->tanggal_pengumuman }}</td>
                        <td>
                            <form style="display: inline-block;"
                                action="{{ route('pengumuman.destroy', $pengumuman->id_pengumuman) }}" method="POST">
                                <a class="btn btn-primary"
                                    href="{{ route('pengumuman.edit', $pengumuman->id_pengumuman) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form> --}}
        {{-- </td>
                    </tr>
                @endforeach
            </tbody>
        </table> --}}
        <div class="card">
            <div class="card-header card-header-tabel p-4 mb-3">
                <h5>
                    Pengumuman
                    <button class="btn btn-add float-end" data-bs-toggle="modal"
                        data-bs-target="#ajukanpengumumanModal">Tambah Data</button>
                </h5>
            </div>
            <hr>
            <div class="card-body">
                <div class="table-responsive">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>

        @push('scripts')
            {{ $dataTable->scripts() }}
        @endpush


        {{-- <div class="card">
            <h5 class="card-header p-4 mb-3">Kelola Pengumuman
                <button class="btn btn-success float-end" data-bs-toggle="modal"
                    data-bs-target="#ajukanpengumumanModal">Add</button>
            </h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                        <thead> --}}
        {{-- <tr>
                                <th scope="col">id</th>
                                <th scope="col">judul</th>
                                <th scope="col">deskripsi</th>
                                <th scope="col">tanggal Pengumuman</th>
                                <th scope="col">aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengumumans as $pengumuman)
                                <tr> --}}
        {{-- <td>{{ ++$i }}</td> --}}
        {{-- <td>{{ $pengumuman->id_pengumuman }}</td>
                                    <td>{{ $pengumuman->judul }}</td>
                                    <td>{{ $pengumuman->deskripsi }}</td>
                                    <td>{{ $pengumuman->tanggal_pengumuman }}</td> --}}
        {{-- <td>
                                        <form style="display: inline-block;"
                                            action="{{  route('pengumuman.destroy', $pengumuman->id_pengumuman) }}"
                                            method="POST">
                                            <a class="btn btn-primary"
                                                href="{{  route('pengumuman.edit', $pengumuman->id_pengumuman) }}">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> --}}
        {{-- </div>
            </div>
        </div> --}}
        {{-- <script>
        let table = new DataTable('#myTable');
        <script src="https://cdn.datatables.net/v/bs5/dt-2.0.3/datatables.min.js"></script>
    </script> --}}
    @endsection
