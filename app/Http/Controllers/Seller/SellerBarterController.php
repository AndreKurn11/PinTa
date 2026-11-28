<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\BarterOffer;
use App\Models\Order;
use App\Services\BarterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SellerBarterController extends Controller
{
    private function ownedOffers(Request $request)
    {
        abort_unless($request->user()->status === 'active' && $request->user()->hasRole('penjual'), 403);
        return BarterOffer::whereHas('listing', fn ($query) => $query->where('seller_id', $request->user()->id));
    }

    public function index(Request $request)
    {
        $status = $request->validate(['status' => 'nullable|in:pending,accepted,rejected,cancelled,expired'])['status'] ?? null;
        $query = $this->ownedOffers($request);
        $counts = (clone $query)->selectRaw('status, COUNT(*) as total')->groupBy('status')->pluck('total', 'status');
        $offers = $query->when($status, fn ($q) => $q->where('status', $status))->with(['listing.primaryImage', 'offerer', 'items'])->latest('id')->paginate(10)->withQueryString();
        return view('seller.barter.index', compact('offers', 'counts', 'status'));
    }

    public function show(Request $request, int $offer)
    {
        $offer = $this->ownedOffers($request)->with(['listing.primaryImage', 'offerer', 'items', 'checkoutDraft'])->findOrFail($offer);
        $order = Order::where('barter_offer_id', $offer->id)->first();
        return view('seller.barter.show', compact('offer', 'order'));
    }

    public function accept(Request $request, int $offer, BarterService $service)
    {
        $this->ownedOffers($request)->findOrFail($offer);
        $request->validate(['agreement' => 'accepted']);
        $service->decide($offer, (int) $request->user()->id, true);
        return redirect()->route('seller.barter.show', $offer)->with('success', 'Penawaran diterima. Order barter berhasil dibuat.');
    }

    public function reject(Request $request, int $offer, BarterService $service)
    {
        $this->ownedOffers($request)->findOrFail($offer);
        $service->decide($offer, (int) $request->user()->id, false);
        return redirect()->route('seller.barter.show', $offer)->with('success', 'Penawaran ditolak.');
    }

    public function photo(Request $request, int $offer, int $item)
    {
        $offer = $this->ownedOffers($request)->findOrFail($offer);
        $item = $offer->items()->findOrFail($item);
        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        $disk = Storage::disk('local');
        abort_unless($item->image_path && $disk->exists($item->image_path), 404);
        return $disk->response($item->image_path, null, ['Cache-Control' => 'private, no-store', 'X-Content-Type-Options' => 'nosniff']);
    }
}
