<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;


// ==========================================
// PUBLIC ROUTES
// ==========================================

Route::get('/', function () {
    return view('dashboard.index');
})->name('dashboard');


// ==========================================
// GUEST ROUTES
// ==========================================

Route::middleware('guest')->group(function () {

    // REGISTER
    Route::get('/register', [RegisterController::class, 'create'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'store'])
        ->name('register.store');

    // LOGIN
    Route::get('/login', [LoginController::class, 'create'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'store'])
        ->name('login.store');
});


// ==========================================
// BUYER ROUTES
// ==========================================

Route::middleware(['auth', 'role:pembeli'])->group(function () {

    Route::get('/checkout', function () {
        return 'Halaman Checkout Pembeli';
    })->name('checkout');
});


// ==========================================
// ADMIN ROUTES
// ==========================================

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
    });


// ==========================================
// SELLER ROUTES
// ==========================================

Route::middleware(['auth', 'role:penjual'])
    ->prefix('seller')
    ->name('seller.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return 'Dashboard Penjual';
        })->name('dashboard');
    });


// ==========================================
// AUTHENTICATED ROUTES
// ==========================================

Route::middleware('auth')->group(function () {

    Route::post('/logout', [LoginController::class, 'destroy'])
        ->name('logout');
});
