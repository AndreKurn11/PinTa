<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SellerDashboardController extends Controller
{
    /**
     * Menampilkan dashboard penjual.
     */
    public function index()
    {
        $user = Auth::user();

        // Mengambil informasi toko milik penjual.
        $store = $user->store;

        // Pastikan penjual sudah memiliki toko.
        if (!$store) {
            abort(404, 'Data toko tidak ditemukan.');
        }

        return view('seller.dashboard', compact(
            'user',
            'store'
        ));
    }
}
