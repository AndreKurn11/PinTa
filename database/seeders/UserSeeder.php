<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'role' => 'admin',
                'name' => 'Administrator',
                'email' => 'admin@example.com',
                'password' => 'password123',
            ],
            [
                'role' => 'pengunjung',
                'name' => 'Pengunjung',
                'email' => 'pengunjung@example.com',
                'password' => 'password123',
            ],
            [
                'role' => 'penjual',
                'name' => 'Penjual',
                'email' => 'penjual@example.com',
                'password' => 'password123',
            ],
            [
                'role' => 'pembeli',
                'name' => 'Pembeli',
                'email' => 'pembeli@example.com',
                'password' => 'password123',
            ],
        ];

        foreach ($users as $user) {

            // Ambil ID role berdasarkan nama role
            $roleId = DB::table('roles')
                ->where('name', $user['role'])
                ->value('id');

            if (!$roleId) {
                throw new RuntimeException(
                    "Role {$user['role']} tidak ditemukan."
                );
            }

            // Simpan data user
            DB::table('users')->updateOrInsert(
                ['email' => $user['email']],
                [
                    'role_id' => $roleId,
                    'name' => $user['name'],
                    'password' => Hash::make($user['password']),
                ]
            );
        }
    }
}
