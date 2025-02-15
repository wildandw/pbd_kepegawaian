<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\PerformaKaryawan;

class DashboardController extends Controller
{
    public function index()
    {
        // Total karyawan
        $totalKaryawan = Karyawan::count();

        // Ambil Top 5 Peringkat Performa
        $peringkatPerforma = PerformaKaryawan::with('karyawan')
            ->orderByDesc('skor')
            ->take(5)
            ->get();

        // Kirim data ke view
        return view('dashboard', compact('totalKaryawan', 'peringkatPerforma'));
    }
}
