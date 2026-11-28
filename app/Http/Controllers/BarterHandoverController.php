<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\BarterHandoverService;
use Illuminate\Http\Request;

class BarterHandoverController extends Controller
{
    private function ownedOrder(Request $request, int $order): Order
    {
        $user = $request->user();
        abort_unless($user->status === 'active', 403);
        $order = Order::where('order_type', 'barter')
            ->where(fn ($q) => $q->where('buyer_id', $user->id)->orWhere('seller_id', $user->id))
            ->with(['listing', 'barterOffer.items', 'barterOffer.checkoutDraft', 'barterTransaction', 'buyer', 'seller'])->findOrFail($order);
        abort_unless((int) $order->buyer_id === (int) $user->id ? $user->hasRole('pembeli') : $user->hasRole('penjual'), 403);
        return $order;
    }

    public function show(Request $request, int $order, BarterHandoverService $service)
    {
        $order = $this->ownedOrder($request, $order);
        $paymentReady = $service->paymentReady($order);
        return view((int) $order->buyer_id === (int) $request->user()->id ? 'barter.handover' : 'barter.seller-handover', compact('order', 'paymentReady'));
    }

    public function send(Request $request, int $order, BarterHandoverService $service)
    {
        $this->ownedOrder($request, $order);
        $data = $request->validate(['tracking_number' => 'required|string|max:100', 'agreement' => 'accepted']);
        $service->handover($order, (int) $request->user()->id, 'send', $data['tracking_number']);
        return redirect()->route('barter.handover.show', $order)->with('success', 'Pengiriman telah dicatat.');
    }

    public function receive(Request $request, int $order, BarterHandoverService $service)
    {
        $this->ownedOrder($request, $order);
        $request->validate(['agreement' => 'accepted']);
        $service->handover($order, (int) $request->user()->id, 'receive');
        return redirect()->route('barter.handover.show', $order)->with('success', 'Penerimaan barang telah dicatat.');
    }

    public function cancel(Request $request, int $offer, BarterHandoverService $service)
    {
        $request->validate(['agreement' => 'accepted']);
        $service->cancelPending($offer, (int) $request->user()->id);
        return redirect()->route('barter.offers.show', $offer)->with('success', 'Penawaran dibatalkan.');
    }
}
