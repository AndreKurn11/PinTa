<?php

namespace App\Http\Controllers;

use App\Models\SellerRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerRegistrationController extends Controller
{
    /**
     * Menampilkan form pendaftaran penjual.
     */
    public function create()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Pastikan user belum memiliki role penjual.
        if ($user->hasRole('penjual')) {
            return redirect('/')
                ->with('error', 'Kamu sudah terdaftar sebagai penjual.');
        }

        // Ambil pengajuan terakhir milik user.
        $registration = SellerRegistration::where(
            'user_id',
            $user->id
        )->latest()->first();

        return view('seller.register', compact('registration'));
    }

    /**
     * Menyimpan pengajuan pendaftaran penjual.
     */
    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->hasRole('penjual')) {
            return redirect('/')
                ->with('error', 'Kamu sudah terdaftar sebagai penjual.');
        }

        // Cegah pengajuan baru jika masih ada yang pending.
        $hasPending = SellerRegistration::where('user_id', $user->id)
            ->where('status', 'pending')
            ->exists();

        if ($hasPending) {
            return back()->with(
                'error',
                'Pengajuan kamu masih menunggu persetujuan Admin.'
            );
        }

        // Validasi data toko.
        $validated = $request->validate([
            'store_name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        // Simpan pengajuan menggunakan user yang sedang login.
        SellerRegistration::create([
            'user_id' => $user->id,
            'store_name' => $validated['store_name'],
            'description' => $validated['description'] ?? null,
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'status' => 'pending',
        ]);

        return redirect('/')
            ->with(
                'success',
                'Pendaftaran penjual berhasil dikirim. Silakan tunggu persetujuan Admin.'
            );
    }
}
