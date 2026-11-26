<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    /**
     * Menampilkan daftar produk milik seller.
     */
    public function index()
    {
        $listings = Listing::query()
            ->ownedBy(auth()->id())
            ->with([
                'category',
                'images',
                'primaryImage',
            ])
            ->latest()
            ->paginate(10);

        return view('seller.listings.index', compact('listings'));
    }
}
