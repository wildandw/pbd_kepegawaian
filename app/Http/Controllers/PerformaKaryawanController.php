<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\Karyawan;
use App\Models\PerformaKaryawan;
use Illuminate\Http\Request;

class PerformaKaryawanController extends Controller
{
    public function index()
{
    // Ambil semua id_karyawan yang sudah memiliki penilaian
    $karyawanSudahDinilai = Penilaian::pluck('id_karyawan');

    // Ambil hanya karyawan yang belum dinilai
    $karyawans = Karyawan::whereNotIn('id_karyawan', $karyawanSudahDinilai)
                         ->select('id_karyawan', 'nama')
                         ->get();

    // Ambil semua performa
    $performas = PerformaKaryawan::with('karyawan')
                                 ->orderBy('peringkat')
                                 ->get();

    return view('performakaryawan', compact('performas', 'karyawans'));
}

    public function store(Request $request)
{
    $validated = $request->validate([
        'id_karyawan' => 'required|string|max:10',
        'skor_performa' => 'required|numeric',
        'skor_sikap' => 'required|numeric',
        'skor_skill' => 'required|numeric',
        'komentar' => 'nullable|string',
    ]);

    Penilaian::create([
        'id_penilaian' => 'P' . str_pad(Penilaian::count() + 1, 3, '0', STR_PAD_LEFT), // Auto-generate ID
        'id_karyawan' => $validated['id_karyawan'],
        'id_asesor' => 'A001', // Contoh, bisa diambil dari session atau input lain
        'skor_performa' => $validated['skor_performa'],
        'skor_sikap' => $validated['skor_sikap'],
        'skor_skill' => $validated['skor_skill'],
        'tanggal_penilaian' => now(),
        'komentar' => $validated['komentar'],
    ]);

    return redirect()->route('performa.index')->with('success', 'Penilaian berhasil ditambahkan!');
}
}
