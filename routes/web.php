<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PerformaKaryawanController;


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/performa', [PerformaKaryawanController::class, 'index'])->name('performa.index');

Route::get('/', function () {
    return view('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function() {
    if(session('user')) {
        return view('dashboard', ['user' => session('user')]);
    }
    return redirect('/login');
});

Route::post('/performa', [PerformaKaryawanController::class, 'store'])->name('performa.store');



Route::resource('karyawan', KaryawanController::class);
Route::put('/karyawan/{id}', [KaryawanController::class, 'update'])->name('karyawan.update');

Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
Route::post('/karyawan', [KaryawanController::class, 'store'])->name('karyawan.store');
Route::get('/karyawan/{id_karyawan}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');
Route::put('/karyawan/{id_karyawan}', [KaryawanController::class, 'update'])->name('karyawan.update');
Route::delete('/karyawan/{id_karyawan}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');