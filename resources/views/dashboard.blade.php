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
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-5">
            <h1 class="text-center text-primary fw-bold mb-4">👋 Selamat Datang Asesor!</h1>
            <h5 class="text-center mb-4">Di Website Penilaian Kinerja Pekerjaan Perusahaan Kepegawaian</h5>
            <p class="text-center text-secondary">Terima kasih atas dedikasi Anda dalam menilai kinerja karyawan secara objektif dan profesional.</p>
            
            <!-- Tentang Sistem Penilaian -->
            <div class="my-5">
                <h4 class="fw-bold text-success mb-3">📝 Tentang Sistem Penilaian:</h4>
                <p>Sistem ini membantu Anda memberikan penilaian berbasis:</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">📊 <strong>Performa:</strong> Hasil kerja dan pencapaian target.</li>
                    <li class="list-group-item">🤝 <strong>Sikap:</strong> Etika kerja, kedisiplinan, dan kerja sama tim.</li>
                    <li class="list-group-item">💡 <strong>Keterampilan:</strong> Kemampuan teknis sesuai bidang.</li>
                </ul>
            </div>
            
            <!-- Petunjuk Penggunaan -->
            <div class="my-5">
                <h4 class="fw-bold text-warning mb-3">📌 Petunjuk Penggunaan:</h4>
                <ul class="list-group list-group-numbered">
                    <li class="list-group-item">🖊️ Isi penilaian performa, sikap, dan keterampilan karyawan dengan nilai 1-10.</li>
                    <li class="list-group-item">📅 Pastikan data yang dimasukkan akurat dan terkini.</li>
                    <li class="list-group-item">📈 Lihat hasil peringkat performa pada halaman utama.</li>
                </ul>
            </div>
            
            <!-- Tujuan Penilaian -->
            <div class="my-5">
                <h4 class="fw-bold text-info mb-3">🎯 Tujuan Penilaian:</h4>
                <ul class="list-group">
                    <li class="list-group-item">🏆 Meningkatkan motivasi dan produktivitas karyawan.</li>
                    <li class="list-group-item">📊 Membantu perusahaan menentukan promosi dan pelatihan.</li>
                    <li class="list-group-item">🌟 Menyusun peringkat karyawan terbaik secara adil.</li>
                </ul>
            </div>

            <!-- Penutup -->
            <div class="text-center mt-5">
                <h4 class="fw-bold text-primary">💙 Terima Kasih atas Kontribusi Anda!</h4>
                <p class="text-secondary">Bersama Anda, kami menciptakan lingkungan kerja yang lebih baik. 🚀</p>
            </div>
        </div>
    </div>
</div>





