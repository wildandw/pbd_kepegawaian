<?php 
namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    // Tampilkan daftar karyawan
    public function index()
    {
        $karyawans = Karyawan::orderBy('nama', 'asc')->get();

        // Generate ID Karyawan berikutnya
        $lastKaryawan = Karyawan::latest('id_karyawan')->first();
        $nextNumber = $lastKaryawan ? ((int)substr($lastKaryawan->id_karyawan, 1)) + 1 : 1;
        $id_karyawan = 'K' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        return view('karyawan', compact('karyawans', 'id_karyawan'));
    }


    // Simpan data karyawan baru dengan ID otomatis
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_karyawan' => 'required|string|max:10|unique:karyawan,id_karyawan',
            'nama' => 'required|string|max:50',
            'posisi' => 'required|string|max:20',
            'username' => 'nullable|string|max:20|unique:karyawan,username',
            'password' => 'nullable|string|max:20',
        ]);        

        // Generate ID Karyawan otomatis (format: K0001, K0002, dst.)
        $lastKaryawan = Karyawan::orderBy('id_karyawan', 'desc')->first();
        $lastNumber = $lastKaryawan ? intval(substr($lastKaryawan->id_karyawan, 1)) : 0;
        $validated['id_karyawan'] = 'K' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        Karyawan::create($validated);

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan!');
    }

    // Tampilkan halaman edit
    public function edit($id_karyawan)
    {
        $karyawan = Karyawan::findOrFail($id_karyawan);
        return view('karyawan.edit', compact('karyawan'));
    }

    // Update data karyawan
    public function update(Request $request, $id_karyawan)
{
    $karyawan = Karyawan::findOrFail($id_karyawan);

    $validated = $request->validate([
        // Abaikan validasi unik pada id_karyawan saat update
        'id_karyawan' => 'required|string|max:10',
        'nama' => 'required|string|max:50',
        'posisi' => 'required|string|max:20',
        'username' => 'nullable|string|max:20|unique:karyawan,username,' . $id_karyawan . ',id_karyawan',
        'password' => 'nullable|string|max:20',
    ]);

    // Update data
    $karyawan->update($validated);

    return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil diperbarui!');
}

    // Hapus data karyawan
    public function destroy($id_karyawan)
    {
        $karyawan = Karyawan::findOrFail($id_karyawan);
        $karyawan->delete();

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus!');
    }
}