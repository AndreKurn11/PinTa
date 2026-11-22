<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

// Route untuk pengunjung yang belum login
Route::middleware('guest')->group(function () {

    // Menampilkan halaman login
    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');

    // Memproses login
    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.process');
});

// Route yang hanya bisa diakses setelah login
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::view('/dashboard', 'dashboard')
        ->name('dashboard');

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');
});