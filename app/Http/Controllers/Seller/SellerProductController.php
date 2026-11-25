<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SellerProductController extends Controller
{
    /**
     * Menampilkan halaman pengelolaan produk.
     */
    public function index()
    {
        $store = Auth::user()->store;

        if (!$store) {
            abort(404, 'Data toko tidak ditemukan.');
        }

        return view('seller.products.index', compact('store'));
    }
}
