<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'name' => 'admin',
                'description' => 'Administrator dengan akses penuh ke sistem.',
            ],
            [
                'name' => 'pengunjung',
                'description' => 'Pengguna yang hanya dapat melihat konten tanpa melakukan tindakan.',
            ],
            [
                'name' => 'penjual',
                'description' => 'Pengguna yang dapat menjual produk dan mengelola toko mereka.',
            ],
            [
                'name' => 'pembeli',
                'description' => 'Pengguna yang dapat membeli produk dari penjual.',
            ],
        ]);
    }
}