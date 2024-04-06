@extends('layouts.user')

@section('content')
    <div class="container container-umkm col-12">
        <div class="card">
            <h5 class="card-header p-4 mb-3">Kelola UMKM</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
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
                                        <a href="" id="edit" data-bs-toggle="modal" data-bs-target="#editModal"
                                        class="btn p-2 btn-primary btn-sm">Validasi</a>
                                        <form action="{{ route('umkm.destroy', $umkm->id_umkm) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn p-2 btn-danger">Hapus</button>
                                        </form>
                                        {{-- <div class="modal fade" id="editModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Pengajuan UMKM</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                        <div class="modal-body justify-content-start text-start">
                                                            <form action="{{ route('umkm.update', $umkm->id_umkm) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group mb-3">
                                                                    <label for="status_umkm"
                                                                        class="form-label text-start">Status UMKM</label>
                                                                    <input type="text" name="" value="{{ $umkm->status_umkm }}" id="">
                                                                    {{-- <select class="form-control" id="status_umkm"
                                                                        name="status_umkm" required>
                                                                        <option value="Baru" {{ ($umkm->status_umkm == "Baru") ? 'selected' : '' }}>Baru</option>
                                                                        <option value="Diterima" {{ ($umkm->status_umkm == "Diterima") ? 'selected' : '' }}>Diterima</option>
                                                                        <option value="Ditolak" {{ ($umkm->status_umkm == "Ditolak") ? 'selected' : '' }}>Ditolak</option>
                                                                    </select> --}}
                                                                {{-- </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-end">
                                                            <button type="button" class="btn btn-danger"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                            document.getElementById('edit').addEventListener('click', function() {
                                                var modal = new bootstrap.Modal(document.getElementById('editModal'));
                                                modal.show();
                                            });
                                        </script> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
