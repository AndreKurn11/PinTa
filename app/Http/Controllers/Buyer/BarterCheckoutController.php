<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBarterCheckoutRequest;
use App\Models\BarterCheckoutDraft;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarterCheckoutController extends Controller
{
    // Menampilkan checkout tanpa membuat pesanan.
    public function create(Request $request, int $listing)
    {
        $product = Listing::with(['seller', 'primaryImage', 'images'])->findOrFail($listing);
        $this->checkProduct($request->user(), $product);

        $draft = BarterCheckoutDraft::where('user_id', $request->user()->id)
            ->where('listing_id', $product->id)->where('status', 'draft')
            ->where('expires_at', '>', now())->latest('id')->first();

        return view('buyer.checkout.index', compact('product', 'draft'));
    }

    // Menyimpan atau memperbarui draft milik pembeli.
    public function store(StoreBarterCheckoutRequest $request, int $listing)
    {
        $draft = DB::transaction(function () use ($request, $listing) {
            $user = User::whereKey($request->user()->id)->lockForUpdate()->firstOrFail();
            $product = Listing::whereKey($listing)->lockForUpdate()->firstOrFail();
            $this->checkProduct($user, $product);

            $query = BarterCheckoutDraft::where('user_id', $user->id)
                ->where('listing_id', $product->id)->where('status', 'draft');

            (clone $query)->where('expires_at', '<=', now())->update(['status' => 'expired']);
            $draft = (clone $query)->where('expires_at', '>', now())->latest('id')->first();

            $data = array_merge($request->validated(), [
                'user_id' => $user->id,
                'listing_id' => $product->id,
                'status' => 'draft',
                'expires_at' => now()->addMinutes(30),
            ]);

            if ($draft) {
                $draft->update($data);
                return $draft;
            }

            return BarterCheckoutDraft::create($data);
        }, 3);

        return redirect()->route('barter.checkout.ready', $draft->id);
    }

    // Halaman persiapan sebelum form penawaran pada tahap 3.
    public function ready(Request $request, int $draft)
    {
        $draft = BarterCheckoutDraft::where('user_id', $request->user()->id)->findOrFail($draft);
        abort_unless($draft->status === 'draft' && $draft->expires_at->isFuture(), 409, 'Checkout sudah tidak berlaku. Silakan checkout kembali.');
        $product = Listing::findOrFail($draft->listing_id);
        $this->checkProduct($request->user(), $product);

        return view('buyer.checkout.ready', compact('draft', 'product'));
    }

    private function checkProduct(User $user, Listing $product): void
    {
        abort_unless($user->status === 'active' && $user->hasRole('pembeli'), 403);
        abort_if((int) $product->seller_id === (int) $user->id, 403, 'Tidak dapat barter produk sendiri.');
        abort_unless($product->sale_mode === 'barter' && $product->status === 'active', 409, 'Produk tidak tersedia untuk barter.');
    }
}
