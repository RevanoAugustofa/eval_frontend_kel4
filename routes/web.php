<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', function () {
//     return view('user_list');
// });


Route::resource('user', UserController::class);
Route::get('/dashboard/user', [UserController::class, 'index'])->name('dashboard.user');
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/', [UserController::class, 'index']);
Route::get('/user_edit', [UserController::class, 'index']);
Route::get('/user_tambah', [UserController::class, 'create'])->name("user.tambah");
Route::delete('users/{id}', [UserController::class, 'destroy'])->name("user.destroy");
Route::get('users/{id}', [UserController::class, 'edit'])->name("user.edit");
Route::get('users/{id}', [UserController::class, 'update'])->name("user.update");
Route::post('/user', [UserController::class, 'store'])->name("user.store");
