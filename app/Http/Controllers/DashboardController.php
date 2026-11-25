<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Menentukan dashboard utama berdasarkan prioritas role
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasRole('penjual')) {
            return redirect()->route('penjual.dashboard');
        }

        if ($user->hasRole('pembeli')) {
            return redirect()->route('pembeli.dashboard');
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
