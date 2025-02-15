<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Performa Karyawan</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600&family=Lato:wght@400;600&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

@include('partials.navbar')
<div class="container">
    <h2 class="mb-4">Daftar Karyawan</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tombol Tambah -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Karyawan</button>

    <!-- Tabel Karyawan -->
    <table class="table table-bordered">
        <thead class="table-dark" style="text-align: center;">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Posisi</th>
                <th>Tanggal Masuk</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($karyawans as $karyawan)
            <tr>
                <td>{{ $karyawan->id_karyawan }}</td>
                <td>{{ $karyawan->nama }}</td>
                <td>{{ $karyawan->posisi }}</td>
                <td>{{ $karyawan->tanggal_masuk }}</td>
                <td>
                <a href="#" onclick="editKaryawan('{{ $karyawan->id_karyawan }}', '{{ $karyawan->nama }}', '{{ $karyawan->posisi }}', '{{ $karyawan->username }}')" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit">Edit</a>

                    <form action="{{ route('karyawan.destroy', $karyawan->id_karyawan) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Tambah Karyawan -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahLabel">Tambah Karyawan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('karyawan.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ID Karyawan</label>
                        <input type="text" name="id_karyawan" class="form-control" value="{{ $id_karyawan }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Posisi</label>
                        <select name="posisi" class="form-control" required>
                            <option value="">Pilih Posisi</option>
                            <option value="Developer">Developer</option>
                            <option value="Tester">Tester</option>
                            <option value="Designer">Designer</option>
                            <option value="DevOps">DevOps</option>
                            <option value="Analyst">Analyst</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Karyawan -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditLabel">Edit Karyawan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEdit" method="POST" action="{{ route('karyawan.update', ':id') }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">ID Karyawan</label>
                        <input type="text" id="edit_id_karyawan" name="id_karyawan" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" id="edit_nama" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Posisi</label>
                        <select id="edit_posisi" name="posisi" class="form-control" required>
                            <option value="Developer">Developer</option>
                            <option value="Tester">Tester</option>
                            <option value="Designer">Designer</option>
                            <option value="DevOps">DevOps</option>
                            <option value="Analyst">Analyst</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" id="edit_username" name="username" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password (Opsional)</label>
                        <input type="password" id="edit_password" name="password" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function editKaryawan(id_karyawan, nama, posisi, username) {
        // Isi form modal dengan data karyawan
        document.getElementById('edit_id_karyawan').value = id_karyawan;
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_posisi').value = posisi;
        document.getElementById('edit_username').value = username;

        // Set action form
        document.getElementById('formEdit').action = "/karyawan/" + id_karyawan;

        // Tampilkan modal
        var editModal = new bootstrap.Modal(document.getElementById('modalEdit'));
        editModal.show();
    }
</script>



<!-- Bootstrap Bundle JS (termasuk Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>