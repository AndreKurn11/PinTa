<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Store;
use App\Models\SellerRegistration;

class AdminDashboardController extends Controller
{
    /**
     * Menampilkan dashboard Admin.
     */
    public function index()
    {
        // Menghitung jumlah seluruh user.
        $totalUsers = User::count();

        // Menghitung jumlah toko.
        $totalStores = Store::count();

        // Menghitung pengajuan yang menunggu persetujuan.
        $pendingRegistrations = SellerRegistration::where(
            'status',
            'pending'
        )->count();

        // Menghitung pengajuan yang disetujui.
        $approvedRegistrations = SellerRegistration::where(
            'status',
            'approved'
        )->count();

        // Menghitung pengajuan yang ditolak.
        $rejectedRegistrations = SellerRegistration::where(
            'status',
            'rejected'
        )->count();

        // Mengambil 5 pengajuan terbaru.
        $latestRegistrations = SellerRegistration::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalStores',
            'pendingRegistrations',
            'approvedRegistrations',
            'rejectedRegistrations',
            'latestRegistrations'
        ));
    }
}
