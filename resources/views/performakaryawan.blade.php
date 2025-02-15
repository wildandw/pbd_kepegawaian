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

<div class="card p-4 shadow-lg rounded-lg">
    <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalTambah">Isi Penilaian Karyawan</button>

    @if($performas->isEmpty())
        <p>Tidak ada data peringkat.</p>
    @else
        <h2 class="text-center font-bold text-2xl mb-5">Papan Peringkat Performa Karyawan</h2>
        <table class="table table-bordered">
            <thead class="table-dark" style="text-align: center;">
                <tr>
                    <th>ID Karyawan</th>
                    <th>Nama</th>
                    <th>Skor Akhir</th>
                    <th>Peringkat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($performas as $data)
                <tr class="text-center">
                    <td>{{ $data->id_karyawan }}</td>
                    <td>{{ $data->karyawan->nama ?? 'Tidak Diketahui' }}</td>
                    <td>{{ $data->skor_akhir }}</td>
                    <td>{{ $data->peringkat }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahLabel">Tambah Penilaian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('performa.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="id_karyawan" class="form-label">Nama Karyawan</label>
                        <select id="id_karyawan" name="id_karyawan" class="form-select" required>
                            <option value="">-- Pilih Karyawan --</option>
                            @foreach($karyawans as $karyawan)
                                <option value="{{ $karyawan->id_karyawan }}">{{ $karyawan->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="skor_performa" class="form-label">Skor Performa</label>
                        <input type="number" id="skor_performa" name="skor_performa" class="form-control" required min="0" max="10">
                    </div>
                    <div class="mb-3">
                        <label for="skor_sikap" class="form-label">Skor Sikap</label>
                        <input type="number" id="skor_sikap" name="skor_sikap" class="form-control" required min="0" max="10">
                    </div>
                    <div class="mb-3">
                        <label for="skor_skill" class="form-label">Skor Skill</label>
                        <input type="number" id="skor_skill" name="skor_skill" class="form-control" required min="0" max="10">
                    </div>
                    <div class="mb-3">
                        <label for="komentar" class="form-label">Komentar</label>
                        <textarea id="komentar" name="komentar" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap Bundle JS (termasuk Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
