<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Listing;

class ProductController extends Controller
{
    /**
     * Menampilkan halaman detail produk.
     */
    public function show(int $listing)
    {
        $product = Listing::active()
            ->with([
                'seller',
                'category',
                'images',
                'primaryImage',
            ])
            ->findOrFail($listing);

        return view('buyer.products.show', [
            'product' => $product,
        ]);
    }
}
