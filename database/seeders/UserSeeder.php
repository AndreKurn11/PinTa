<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Store;
use App\Models\SellerRegistration;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Menambahkan akun admin, penjual, dan pembeli
     * untuk kebutuhan pengujian marketplace PinTa.
     */
    public function run(): void
    {
        // Seeder akun dummy hanya untuk development.
        if (!app()->environment(['local', 'testing'])) {
            return;
        }

        DB::transaction(function () {

            // 1. Mengambil role dari database.
            $adminRole = Role::where('name', 'admin')
                ->firstOrFail();

            $buyerRole = Role::where('name', 'pembeli')
                ->firstOrFail();

            $sellerRole = Role::where('name', 'penjual')
                ->firstOrFail();


            // ==========================================
            // AKUN ADMIN
            // ==========================================

            $admin = User::firstOrCreate(
                ['email' => 'admin@pinta.test'],
                [
                    'name' => 'Admin PinTa',
                    'password' => 'Admin123!',
                    'is_verified' => true,
                    'verified_at' => now(),
                    'status' => 'active',
                ]
            );

            // Memberikan role admin.
            $admin->roles()->syncWithoutDetaching([
                $adminRole->id,
            ]);


            // ==========================================
            // AKUN PENJUAL
            // ==========================================

            $seller = User::firstOrCreate(
                ['email' => 'penjual@pinta.test'],
                [
                    'name' => 'Penjual PinTa',
                    'password' => 'Penjual123!',
                    'phone' => '080000000001',
                    'identity_number' => 'DUMMY-001',
                    'address' => 'Mendalo Darat, Jambi',
                    'is_verified' => true,
                    'verified_at' => now(),
                    'verified_by' => $admin->id,
                    'status' => 'active',
                ]
            );

            // Penjual juga memiliki hak akses pembeli.
            $seller->roles()->syncWithoutDetaching([
                $buyerRole->id,
                $sellerRole->id,
            ]);


            // ==========================================
            // DATA TOKO PENJUAL
            // ==========================================

            Store::firstOrCreate(
                ['user_id' => $seller->id],
                [
                    'store_name' => 'PinTa Second Store',
                    'slug' => 'pinta-second-store-demo',
                    'description' => 'Toko barang bekas mahasiswa untuk pengujian PinTa.',
                    'phone' => '080000000001',
                    'address' => 'Mendalo Darat, Jambi',
                    'status' => 'active',
                ]
            );


            // ==========================================
            // RIWAYAT PENDAFTARAN PENJUAL
            // ==========================================

            SellerRegistration::firstOrCreate(
                [
                    'user_id' => $seller->id,
                    'status' => 'approved',
                ],
                [
                    'store_name' => 'PinTa Second Store',
                    'description' => 'Toko barang bekas mahasiswa.',
                    'phone' => '080000000001',
                    'address' => 'Mendalo Darat, Jambi',
                    'reviewed_by' => $admin->id,
                    'reviewed_at' => now(),
                    'rejection_reason' => null,
                ]
            );


            // ==========================================
            // AKUN PEMBELI PERTAMA
            // ==========================================

            $buyer = User::firstOrCreate(
                ['email' => 'pembeli@pinta.test'],
                [
                    'name' => 'Pembeli PinTa',
                    'password' => 'Pembeli123!',
                    'phone' => '080000000002',
                    'identity_number' => 'DUMMY-002',
                    'address' => 'Telanaipura, Jambi',
                    'is_verified' => true,
                    'verified_at' => now(),
                    'verified_by' => $admin->id,
                    'status' => 'active',
                ]
            );

            // Memberikan role pembeli.
            $buyer->roles()->syncWithoutDetaching([
                $buyerRole->id,
            ]);


            // ==========================================
            // AKUN PEMBELI KEDUA
            // ==========================================

            $secondBuyer = User::firstOrCreate(
                ['email' => 'pembeli2@pinta.test'],
                [
                    'name' => 'Pembeli Kedua PinTa',
                    'password' => 'Pembeli123!',
                    'phone' => '080000000003',
                    'identity_number' => 'DUMMY-003',
                    'address' => 'Kota Baru, Jambi',
                    'is_verified' => true,
                    'verified_at' => now(),
                    'verified_by' => $admin->id,
                    'status' => 'active',
                ]
            );

            // Memberikan role pembeli.
            $secondBuyer->roles()->syncWithoutDetaching([
                $buyerRole->id,
            ]);

        });
    }
}
