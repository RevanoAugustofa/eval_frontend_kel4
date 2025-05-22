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
Route::delete('users/{id}', [UserController::class, 'destroy'])->name("user.destroy");
Route::put()