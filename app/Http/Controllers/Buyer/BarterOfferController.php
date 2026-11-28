<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBarterOfferRequest;
use App\Models\AuditLog;
use App\Models\BarterCheckoutDraft;
use App\Models\BarterOffer;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class BarterOfferController extends Controller
{
    // Form pengajuan setelah checkout.
    public function create(Request $request, int $draft)
    {
        $user = $request->user();
        abort_unless($user->status === 'active', 403);
        $draft = BarterCheckoutDraft::where('user_id', $user->id)->findOrFail($draft);
        if ($draft->status === 'submitted') {
            $offer = BarterOffer::where('checkout_draft_id', $draft->id)->firstOrFail();
            return redirect()->route('barter.offers.show', $offer->id);
        }
        $this->checkDraft($draft);
        $product = Listing::with(['primaryImage', 'images', 'seller'])->findOrFail($draft->listing_id);
        $this->checkProduct($product, $user);
        $ownedListings = Listing::active()->ownedBy($user->id)->where('sale_mode', '!=', 'auction')->with('primaryImage')->get();

        return view('buyer.barter.create', compact('draft', 'product', 'ownedListings'));
    }

    // Simpan penawaran dan barang secara atomik.
    public function store(StoreBarterOfferRequest $request, int $draft)
    {
        $data = $request->validated();
        $storedPath = null;
        try {
            $offer = DB::transaction(function () use ($request, $draft, $data, &$storedPath) {
                // Urutan penguncian mengikuti checkout tahap 2: user, listing, draft.
                $user = User::whereKey($request->user()->id)->lockForUpdate()->firstOrFail();
                abort_unless($user->status === 'active' && $user->hasRole('pembeli'), 403);
                $initial = BarterCheckoutDraft::where('user_id', $user->id)->findOrFail($draft);
                if ($initial->status === 'submitted') {
                    return BarterOffer::where('checkout_draft_id', $initial->id)->firstOrFail();
                }
                $ids = [$initial->listing_id];
                if ($data['source'] === 'listing') $ids[] = $data['offered_listing_id'];
                $listings = Listing::whereIn('id', $ids)->orderBy('id')->lockForUpdate()->get()->keyBy('id');
                $draft = BarterCheckoutDraft::where('user_id', $user->id)->lockForUpdate()->findOrFail($initial->id);
                $this->checkDraft($draft);
                $product = $listings->get($draft->listing_id);
                abort_unless($product, 404);
                $this->checkProduct($product, $user);

                if (BarterOffer::where('listing_id', $product->id)->where('offerer_id', $user->id)->where('status', 'pending')->exists()) {
                    throw ValidationException::withMessages(['source' => 'Anda masih memiliki tawaran pending untuk produk ini.']);
                }

                $item = null;
                if ($data['source'] === 'listing') {
                    $owned = $listings->get($data['offered_listing_id']);
                    if (!$owned || (int) $owned->seller_id !== (int) $user->id || $owned->status !== 'active' || $owned->sale_mode === 'auction') {
                        throw ValidationException::withMessages(['offered_listing_id' => 'Barang harus milik Anda, aktif, dan bukan lelang.']);
                    }
                    $photo = $owned->primaryImage ?? $owned->images()->first();
                    // Salin foto ke disk privat sebagai snapshot jika tersedia.
                    if ($photo && Storage::disk('public')->exists($photo->image_path)) {
                        $storedPath = 'barter-offers/'.\Illuminate\Support\Str::uuid().'.'.pathinfo($photo->image_path, PATHINFO_EXTENSION);
                        if (!Storage::disk('local')->put($storedPath, Storage::disk('public')->get($photo->image_path))) {
                            throw new \RuntimeException('Foto gagal disalin.');
                        }
                    }
                    $item = ['offered_listing_id' => $owned->id, 'item_name' => $owned->title, 'description' => $owned->description, 'item_condition' => $owned->item_condition, 'estimated_value' => $owned->price, 'image_path' => $storedPath];
                } elseif ($data['source'] === 'manual') {
                    $storedPath = $request->file('photo')->store('barter-offers', 'local');
                    if (!$storedPath) throw new \RuntimeException('Foto gagal disimpan.');
                    $item = ['offered_listing_id' => null, 'item_name' => $data['item_name'], 'description' => $data['description'] ?? null, 'item_condition' => $data['item_condition'], 'estimated_value' => $data['estimated_value'] ?? null, 'image_path' => $storedPath];
                }

                $offer = BarterOffer::create([
                    'checkout_draft_id' => $draft->id, 'listing_id' => $product->id, 'offerer_id' => $user->id,
                    'offer_type' => !$item ? 'cash' : ($data['cash_amount'] > 0 ? 'mixed' : 'item'),
                    'cash_amount' => $data['cash_amount'], 'price_difference' => 0,
                    'message' => $data['message'] ?? null, 'status' => 'pending',
                ]);
                if ($item) {
                    $savedItem = $offer->items()->create($item);
                    AuditLog::create([
                        'user_id' => $user->id, 'action' => 'create', 'table_name' => 'barter_offer_items', 'record_id' => $savedItem->id,
                        'new_values' => ['offer_id' => $offer->id, 'offered_listing_id' => $savedItem->offered_listing_id],
                    ]);
                }
                $draft->update(['status' => 'submitted']);
                AuditLog::create([
                    'user_id' => $user->id, 'action' => 'create', 'table_name' => 'barter_offers', 'record_id' => $offer->id,
                    'new_values' => ['status' => 'pending', 'checkout_draft_id' => $draft->id, 'listing_id' => $product->id, 'offer_type' => $offer->offer_type, 'cash_amount' => $offer->cash_amount],
                ]);
                AuditLog::create([
                    'user_id' => $user->id, 'action' => 'status_change', 'table_name' => 'barter_checkout_drafts', 'record_id' => $draft->id,
                    'old_values' => ['status' => 'draft'], 'new_values' => ['status' => 'submitted'],
                ]);
                return $offer;
            });
        } catch (\Throwable $e) {
            if ($storedPath) Storage::disk('local')->delete($storedPath);
            throw $e;
        }
        return redirect()->route('barter.offers.show', $offer->id)->with('success', 'Penawaran barter telah dikirim.');
    }

    public function index(Request $request)
    {
        abort_unless($request->user()->status === 'active', 403);
        $offers = BarterOffer::where('offerer_id', $request->user()->id)->with('listing')->latest('id')->paginate(12);
        return view('buyer.barter.index', compact('offers'));
    }

    public function show(Request $request, int $offer)
    {
        abort_unless($request->user()->status === 'active', 403);
        $offer = BarterOffer::where('offerer_id', $request->user()->id)->with(['listing', 'items', 'checkoutDraft'])->findOrFail($offer);
        return view('buyer.barter.show', compact('offer'));
    }

    public function photo(Request $request, int $offer, int $item)
    {
        abort_unless($request->user()->status === 'active', 403);
        $offer = BarterOffer::where('offerer_id', $request->user()->id)->findOrFail($offer);
        $item = $offer->items()->findOrFail($item);
        abort_unless($item->image_path && Storage::disk('local')->exists($item->image_path), 404);
        
        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        $disk = Storage::disk('local');

        return $disk->response(
            $item->image_path,
            null,
            [
                'Cache-Control' => 'private, no-store',
                'X-Content-Type-Options' => 'nosniff',
            ]
        );

    }

    private function checkDraft(BarterCheckoutDraft $draft): void
    {
        abort_unless($draft->status === 'draft' && $draft->expires_at->isFuture(), 409, 'Checkout tidak berlaku. Silakan checkout kembali.');
    }

    private function checkProduct(Listing $product, User $user): void
    {
        abort_if((int) $product->seller_id === (int) $user->id, 403);
        abort_unless($product->status === 'active' && $product->sale_mode === 'barter', 409, 'Produk tidak tersedia untuk barter.');
    }
}
