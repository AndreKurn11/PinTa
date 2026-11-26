<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class SellerProductController extends Controller
{
    /**
     * Menampilkan daftar produk milik seller.
     */
    public function index()
    {
        $store = Auth::user()->store;

        if (!$store) {
            abort(404, 'Data toko tidak ditemukan.');
        }

        $listings = Listing::query()
            ->ownedBy(Auth::id())
            ->with([
                'category',
                'images',
                'primaryImage',
            ])
            ->latest()
            ->paginate(10);

        return view('seller.products.index', compact(
            'store',
            'listings'
        ));
    }

    /**
     * Menampilkan form posting produk.
     */
    public function create()
    {
        $store = Auth::user()->store;

        if (!$store) {
            abort(404, 'Data toko tidak ditemukan.');
        }

        $categories = Category::orderBy('name')->get();

        return view('seller.products.create', compact(
            'store',
            'categories'
        ));
    }

    /**
     * Menyimpan produk baru.
     */
    public function store(Request $request)
    {
        // Validasi input produk
        $validated = $request->validate([

            'title' => [
                'required',
                'string',
                'max:150',
            ],

            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'description' => [
                'required',
                'string',
            ],

            'item_condition' => [
                'required',
                'in:like_new,good,fair,needs_repair',
            ],

            'location' => [
                'required',
                'string',
                'max:150',
            ],

            'sale_mode' => [
                'required',
                'in:direct,auction,barter',
            ],

            'price' => [
                'nullable',
                'required_if:sale_mode,direct,auction',
                'numeric',
                'min:0',
            ],

            'images' => [
                'required',
                'array',
                'min:1',
                'max:5',
            ],

            'images.*' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

        ]);

        // Memastikan seller memiliki toko
        $store = Auth::user()->store;

        if (!$store) {
            abort(404, 'Data toko tidak ditemukan.');
        }

        // Menyiapkan data produk
        $imageFiles = $validated['images'];

        unset($validated['images']);

        $storedPaths = [];

        try {

            DB::transaction(function () use (
                $validated,
                $imageFiles,
                &$storedPaths
            ) {

                // Menyimpan data produk
                $listing = Listing::create([
                    'seller_id' => Auth::id(),
                    'category_id' => $validated['category_id'],
                    'title' => $validated['title'],
                    'description' => $validated['description'],
                    'item_condition' => $validated['item_condition'],
                    'location' => $validated['location'],
                    'sale_mode' => $validated['sale_mode'],
                    'price' => $validated['sale_mode'] === 'barter'
                        ? null
                        : $validated['price'],
                ]);

                // Menyimpan seluruh gambar produk
                foreach ($imageFiles as $index => $image) {

                    $path = $image->store('listings', 'public');

                    $storedPaths[] = $path;

                    $listing->images()->create([
                        'image_path' => $path,
                        'is_primary' => $index === 0,
                        'sort_order' => $index,
                    ]);
                }

            });

        } catch (Throwable $e) {

            // Membersihkan file jika proses database gagal
            Storage::disk('public')->delete($storedPaths);

            throw $e;
        }

        return redirect()
            ->route('seller.products.index')
            ->with('success', 'Produk berhasil diposting!');
    }
}
