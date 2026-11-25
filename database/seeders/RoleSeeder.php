<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'description' => 'Administrator sistem',
            ],
            [
                'name' => 'pembeli',
                'description' => 'Pengguna yang melakukan pembelian',
            ],
            [
                'name' => 'penjual',
                'description' => 'Pengguna yang menjual produk',
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
