@extends('layouts.sidebar')

@section('content')
    <div class="card card-tabel">
        <div class="card-header card-header-tabel p-4 mb-3">
            <h5>
                Kriteria Perhitungan Calon Penerima Bantuan Sosial
            </h5>
        </div>
        <hr class="tabel">
        <div class="card-body">
            <div class="table-responsive tabel">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Nomor</th>
                            <th>Kriteria</th>
                            <th>Jenis</th>
                            <th>Bobot</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kriterias as $kriteria)
                            <tr>
                                <td>{{ $kriteria->id_ktr }}</td>
                                <td>{{ $kriteria->nama_ktr }}</td>
                                <td>{{ $kriteria->isBenefit }}</td>
                                <td>{{ $kriteria->bobot_ktr }}</td>
                                <td>
                                    <button class="btn btn-sm btn-edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $kriteria->id_ktr }}" data-nama="{{ $kriteria->nama_ktr }}" data-bobot="{{ $kriteria->bobot_ktr }}">Edit Bobot</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Bobot Kriteria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" action="{{ route('kriteria.update', 0) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nama_ktr" class="form-label">Kriteria</label>
                            <input type="text" class="form-control" id="nama_ktr" name="nama_ktr" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="bobot_ktr" class="form-label">Bobot</label>
                            <input type="number" class="form-control" id="bobot_ktr" name="bobot_ktr" required>
                        </div>
                        <input type="hidden" id="id_ktr" name="id_ktr">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editModal = document.getElementById('editModal');
            editModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var id = button.getAttribute('data-id');
                var nama = button.getAttribute('data-nama');
                var bobot = button.getAttribute('data-bobot');

                var modalTitle = editModal.querySelector('.modal-title');
                var namaInput = editModal.querySelector('#nama_ktr');
                var bobotInput = editModal.querySelector('#bobot_ktr');
                var idInput = editModal.querySelector('#id_ktr');
                var form = editModal.querySelector('#editForm');

                modalTitle.textContent = 'Edit Bobot Kriteria ' + nama;
                namaInput.value = nama;
                bobotInput.value = bobot;
                idInput.value = id;
                form.action = "{{ url('bansos/update') }}/" + id;
            });
        });
    </script>
@endsection
