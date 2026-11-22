<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// REDIRECT HALAMAN UTAMA
Route::get('/', function () {
    // Jika belum login, arahkan ke halaman login
    if (!Auth::check()) {
        return redirect()->route('login');
    }
    // Ambil role user yang sedang login
    $role = Auth::user()->role?->name;
    // Mapping role ke route dashboard
    $dashboards = [
        'admin'      => 'admin.dashboard',
        'pengunjung' => 'pengunjung.dashboard',
        'pembeli'    => 'pembeli.dashboard',
        'penjual'    => 'penjual.dashboard',
    ];
    // Validasi role
    if (!isset($dashboards[$role])) {
        abort(403, 'Role akun tidak valid.');
    }
    // Redirect ke dashboard sesuai role
    return redirect()->route($dashboards[$role]);
});


// ROUTE UNTUK PENGGUNA BELUM LOGIN
Route::middleware('guest')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        // Menampilkan halaman login
        Route::get('/login', 'showLoginForm')
            ->name('login');
        // Memproses login
        Route::post('/login', 'login')
            ->name('login.process');
    });
});


// ROUTE UNTUK PENGGUNA SUDAH LOGIN
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');
    // Daftar role pengguna
    $roles = [
        'admin',
        'pengunjung',
        'pembeli',
        'penjual',
    ];
    // Generate route dashboard berdasarkan role
    foreach ($roles as $role) {
        Route::middleware("role:{$role}")
            ->prefix($role)
            ->name("{$role}.")
            ->group(function () use ($role) {
                Route::view('/dashboard', "{$role}.dashboard")
                    ->name('dashboard');
            });
    }
});
