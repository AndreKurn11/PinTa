<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Halaman utama marketplace
    public function index(Request $request)
    {
        $query = Listing::active()
            ->with(['category', 'primaryImage']);

        // Pencarian berdasarkan nama dan deskripsi produk
        if ($request->filled('q')) {
            $search = $request->q;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter mode transaksi
        $allowedModes = ['direct', 'barter', 'auction'];

        $saleModes = array_intersect(
            (array) $request->input('sale_mode', []),
            $allowedModes
        );

        if (!empty($saleModes)) {
            $query->whereIn('sale_mode', $saleModes);
        }

        // Pengurutan produk
        switch ($request->input('sort', 'latest')) {
            case 'cheapest':
                $query->orderByRaw('price IS NULL ASC')
                    ->orderBy('price', 'asc');
                break;

            case 'expensive':
                $query->orderByRaw('price IS NULL ASC')
                    ->orderBy('price', 'desc');
                break;

            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(9)->withQueryString();

        return view('dashboard.index', compact('products'));
    }

    // Dashboard berdasarkan role pengguna
    public function redirectByRole()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasRole('penjual')) {
            return redirect()->route('seller.dashboard');
        }

        if ($user->hasRole('pembeli')) {
            return redirect()->route('dashboard');
        }

        abort(403, 'Anda belum memiliki role yang sesuai.');
    }

    // Dashboard Admin
    public function admin()
    {
        return view('dashboard.admin');
    }

    // Dashboard Pembeli
    public function pembeli()
    {
        return view('dashboard.pembeli');
    }

    // Dashboard Penjual
    public function penjual()
    {
        return view('dashboard.penjual');
    }
}
