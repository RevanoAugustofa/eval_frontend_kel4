<?php

use App\Controllers\Matkul;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Di bawah ini adalah definisi route yang digunakan dalam aplikasi.
| Setiap route akan mengarah ke method yang sesuai pada controller.
*/

// --------------------------
// Halaman Utama (Default)
// --------------------------

// Menampilkan halaman utama (default diarahkan ke daftar user)
// Route::get('/', [UserController::class, 'index']);


// --------------------------
// User Routes
// --------------------------

// Menampilkan daftar user di halaman dashboard
Route::get('/dashboard/user', [UserController::class, 'index'])->name('dashboard.user');
Route::get('/dashboard/matkul', [MatkulController::class, 'index'])->name('dashboard.matkul');

// Menampilkan daftar user (alternatif akses URL '/user')
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/matkul', [MatkulController::class, 'index'])->name('matkul.index');

// Menampilkan halaman form tambah user
Route::get('/user_tambah', [UserController::class, 'create'])->name('user.tambah');
Route::get('/matkul_tambah', [MatkulController::class, 'create'])->name('matkul.tambah');

// Menyimpan data user baru ke database (method POST dari form tambah)
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::post('/matkul', [MatkulController::class, 'store'])->name('matkul.store');

// Menampilkan halaman form edit data user berdasarkan ID
Route::get('/users/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::get('/matkuls/{kode_matkul}', [MatkulController::class, 'edit'])->name('matkul.edit');

// Memperbarui data user berdasarkan ID (method PUT dari form edit)
Route::put('/users/{id}', [UserController::class, 'update'])->name('user.update');
Route::put('/matkuls/{kode_matkul}', [MatkulController::class, 'update'])->name('matkul.update');

// Menghapus data user berdasarkan ID
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');
Route::delete('/matkuls/{kode_matkul}', [MatkulController::class, 'destroy'])->name('matkul.destroy');

// Menampilkan daftar user untuk halaman '/user_edit' (bisa diarahkan ke halaman khusus edit)
Route::get('/user_edit', [UserController::class, 'index']);
Route::get('/matkul_edit', [MatkulController::class, 'index']);


// --------------------------
// Resourceful Routing (Opsional)
// --------------------------
// Jika ingin menggunakan route resource (RESTful) lengkap secara otomatis
// Pastikan tidak terjadi konflik dengan route lain di atas
Route::resource('user', UserController::class);
Route::resource('matkul', MatkulController::class);
