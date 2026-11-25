<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\SellerRegistration;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SellerApprovalController extends Controller
{
    /**
     * Menampilkan daftar pengajuan penjual.
     */
    public function index()
    {
        $registrations = SellerRegistration::with('user')
            ->latest()
            ->paginate(10);

        return view('admin.seller-registrations.index', compact('registrations'));
    }

    /**
     * Menampilkan detail pengajuan.
     */
    public function show($id)
    {
        $registration = SellerRegistration::with(['user', 'reviewer'])
            ->findOrFail($id);

        return view('admin.seller-registrations.show', compact('registration'));
    }

    /**
     * Menyetujui pengajuan penjual.
     */
    public function approve($id)
    {
        DB::transaction(function () use ($id) {
            $registration = SellerRegistration::with('user')
                ->lockForUpdate()
                ->findOrFail($id);

            // Pastikan pengajuan masih pending.
            if ($registration->status !== 'pending') {
                abort(422, 'Pengajuan ini sudah diproses.');
            }

            $user = $registration->user;

            // Pastikan user belum memiliki toko.
            if ($user->store()->exists()) {
                abort(422, 'User ini sudah memiliki toko.');
            }

            // Buat slug toko yang unik.
            $baseSlug = Str::slug($registration->store_name);
            $slug = $baseSlug;
            $counter = 1;

            while (Store::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            // Buat data toko.
            Store::create([
                'user_id' => $user->id,
                'store_name' => $registration->store_name,
                'slug' => $slug,
                'description' => $registration->description,
                'phone' => $registration->phone,
                'address' => $registration->address,
                'status' => 'active',
            ]);

            // Tambahkan role penjual tanpa menghapus role pembeli.
            $sellerRole = Role::where('name', 'penjual')->firstOrFail();

            $user->roles()->syncWithoutDetaching([
                $sellerRole->id => [
                    'assigned_at' => now(),
                ],
            ]);

            // Tandai pengajuan sebagai disetujui.
            $registration->update([
                'status' => 'approved',
                'reviewed_by' => auth()->id(),
                'reviewed_at' => now(),
                'rejection_reason' => null,
            ]);
        });

        return redirect()
            ->route('admin.seller-registrations.index')
            ->with('success', 'Pengajuan penjual berhasil disetujui.');
    }

    /**
     * Menolak pengajuan penjual.
     */
    public function reject(Request $request, $id)
    {
        $validated = $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        $registration = SellerRegistration::findOrFail($id);

        if ($registration->status !== 'pending') {
            return back()->with('error', 'Pengajuan ini sudah diproses.');
        }

        $registration->update([
            'status' => 'rejected',
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
            'rejection_reason' => $validated['rejection_reason'],
        ]);

        return redirect()
            ->route('admin.seller-registrations.index')
            ->with('success', 'Pengajuan penjual berhasil ditolak.');
    }
}
