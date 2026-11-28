<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SellerRegistrationController;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\SellerApprovalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Seller\SellerDashboardController;
use App\Http\Controllers\Seller\SellerProductController;

use App\Http\Controllers\Buyer\ProductController;

use App\Http\Controllers\Buyer\BarterCheckoutController;
use App\Http\Controllers\Buyer\BarterOfferController;

// ==========================================
// PUBLIC ROUTES
// ==========================================

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::get('/products/{listing}', [ProductController::class, 'show'])
    ->whereNumber('listing')
    ->name('products.show');


// ==========================================
// GUEST ROUTES
// ==========================================

Route::middleware('guest')->group(function () {

    Route::get('/register', [RegisterController::class, 'create'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'store'])
        ->name('register.store');

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

    // Pendaftaran menjadi penjual
    Route::get('/seller/register', [SellerRegistrationController::class, 'create'])
        ->name('seller.register');

    Route::post('/seller/register', [SellerRegistrationController::class, 'store'])
        ->name('seller.register.store');

    // Menampilkan halaman checkout barter
    Route::get('/barter/checkout/{listing}', [
        BarterCheckoutController::class, 'create'
    ])
        ->whereNumber('listing')
        ->name('barter.checkout.create');

    // Menyimpan checkout barter
    Route::post('/barter/checkout/{listing}', [
        BarterCheckoutController::class, 'store'
    ])
        ->whereNumber('listing')
        ->name('barter.checkout.store');

    // Menampilkan hasil checkout
    Route::get('/barter/checkout/drafts/{draft}', [
        BarterCheckoutController::class, 'ready'
    ])
        ->whereNumber('draft')
        ->name('barter.checkout.ready');
    
    // ==========================================
    // BARTER OFFER ROUTES
    // ==========================================
    
    // Daftar penawaran barter milik pembeli.
    Route::get('/barter/offers', [
        BarterOfferController::class, 'index'
    ])->name('barter.offers.index');

    // Menampilkan form pengajuan barter.
    Route::get('/barter/checkout/drafts/{draft}/offer', [
        BarterOfferController::class, 'create'
    ])
        ->whereNumber('draft')
        ->name('barter.offers.create');

    // Menyimpan pengajuan barter.
    Route::post('/barter/checkout/drafts/{draft}/offer', [
        BarterOfferController::class, 'store'
    ])
        ->whereNumber('draft')
        ->name('barter.offers.store');

    // Menampilkan detail penawaran.
    Route::get('/barter/offers/{offer}', [
        BarterOfferController::class, 'show'
    ])
        ->whereNumber('offer')
        ->name('barter.offers.show');

    // Menampilkan foto barang tawaran.
    Route::get('/barter/offers/{offer}/items/{item}/photo', [
        BarterOfferController::class, 'photo'
    ])
    ->whereNumber('offer')
    ->whereNumber('item')
    ->name('barter.offers.photo');

});



// ==========================================
// ADMIN ROUTES
// ==========================================

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard Admin
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // Daftar pendaftaran penjual
        Route::get('/seller-registrations', [SellerApprovalController::class, 'index'])
            ->name('seller-registrations.index');

        // Detail pendaftaran
        Route::get('/seller-registrations/{id}', [SellerApprovalController::class, 'show'])
            ->name('seller-registrations.show');

        // Menyetujui pendaftaran
        Route::post('/seller-registrations/{id}/approve', [SellerApprovalController::class, 'approve'])
            ->name('seller-registrations.approve');

        // Menolak pendaftaran
        Route::post('/seller-registrations/{id}/reject', [SellerApprovalController::class, 'reject'])
            ->name('seller-registrations.reject');
    });


// ==========================================
// SELLER ROUTES
// ==========================================

Route::middleware(['auth', 'role:penjual'])
    ->prefix('seller')
    ->name('seller.')
    ->group(function () {

        // Dashboard Penjual
        Route::get('/dashboard', [SellerDashboardController::class, 'index'])
            ->name('dashboard');

        // Katalog Produk
        Route::get('/products', [SellerProductController::class, 'index'])
            ->name('products.index');

        // Form tambah produk
        Route::get('/products/create', [SellerProductController::class, 'create'])
            ->name('products.create');

        // Simpan produk
        Route::post('/products', [SellerProductController::class, 'store'])
            ->name('products.store');
    });


// ==========================================
// AUTHENTICATED ROUTES
// ==========================================

Route::middleware('auth')->group(function () {

    Route::post('/logout', [LoginController::class, 'destroy'])
        ->name('logout');
});
