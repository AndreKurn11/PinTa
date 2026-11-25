<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Menambahkan data role ke dalam tabel roles.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'description' => 'Administrator yang mengelola seluruh sistem marketplace.',
            ],
            [
                'name' => 'pembeli',
                'description' => 'Pengguna yang dapat melakukan pembelian produk.',
            ],
            [
                'name' => 'penjual',
                'description' => 'Pengguna yang dapat mengelola toko dan menjual produk.',
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['name' => $role['name']],
                ['description' => $role['description']]
            );
        }
    }
}