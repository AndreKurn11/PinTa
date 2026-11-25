<?php

use App\Http\Controllers\Admin\SellerApprovalController;
use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SellerRegistrationController;
use App\Http\Controllers\Seller\SellerDashboardController;
use App\Http\Controllers\Seller\SellerProductController;

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

Route::middleware(['auth', 'role:pembeli'])->group(function () {
    Route::get('/seller/register', [SellerRegistrationController::class, 'create'])
        ->name('seller.register');

    Route::post('/seller/register', [SellerRegistrationController::class, 'store'])
        ->name('seller.register.store');
});


Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard Admin
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // Pengelolaan pendaftaran penjual
        Route::get(
            '/seller-registrations',
            [SellerApprovalController::class, 'index']
        )
            ->name('seller-registrations.index');

        Route::get(
            '/seller-registrations/{id}',
            [SellerApprovalController::class, 'show']
        )
            ->name('seller-registrations.show');

        Route::post(
            '/seller-registrations/{id}/approve',
            [SellerApprovalController::class, 'approve']
        )
            ->name('seller-registrations.approve');

        Route::post(
            '/seller-registrations/{id}/reject',
            [SellerApprovalController::class, 'reject']
        )
            ->name('seller-registrations.reject');
    });

Route::middleware(['auth', 'role:penjual'])
    ->prefix('seller')
    ->name('seller.')
    ->group(function () {

        // Dashboard Penjual
        Route::get('/dashboard', [SellerDashboardController::class, 'index'])
            ->name('dashboard');

        // Pengelolaan Produk
        Route::get('/products', [SellerProductController::class, 'index'])
            ->name('products.index');
    });
