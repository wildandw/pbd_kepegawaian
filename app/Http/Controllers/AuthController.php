<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Karyawan;
use App\Models\Asesor;

class AuthController extends Controller {
    public function showLoginForm() {
        return view('login');
    }

    public function login(Request $request) {
        $credentials = $request->only('username', 'password');

        // Cek login untuk karyawan
        $karyawan = Karyawan::where('username', $credentials['username'])->first();
        if ($karyawan && $credentials['password'] === $karyawan->password) {
            session(['user' => $karyawan, 'role' => 'karyawan']);
            return redirect('/dashboard');
        }

        // Cek login untuk asesor
        $asesor = Asesor::where('username', $credentials['username'])->first();
        if ($asesor && $credentials['password'] === $asesor->password) {
            session(['user' => $asesor, 'role' => 'asesor']);
            return redirect('/performa');
        }

        return back()->with('error', 'Username atau password salah');
    }

    public function logout() {
        session()->flush();
        return redirect('/login')->with('status', 'Anda berhasil logout.');
    }

}