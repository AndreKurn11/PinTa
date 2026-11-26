<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Kategori induk
        $categories = [
            'fashion' => 'Fashion',
            'elektronik' => 'Elektronik',
            'makanan-minuman' => 'Makanan dan Minuman',
            'kerajinan' => 'Kerajinan',
            'rumah-tangga' => 'Rumah Tangga',
        ];

        $parents = [];

        foreach ($categories as $slug => $name) {
            $parents[$slug] = Category::updateOrCreate(
                ['slug' => $slug],
                [
                    'parent_id' => null,
                    'name' => $name,
                ]
            );
        }

        // Kategori anak
        $children = [
            'fashion' => [
                'pakaian-pria' => 'Pakaian Pria',
                'pakaian-wanita' => 'Pakaian Wanita',
                'tas-dompet' => 'Tas dan Dompet',
                'sepatu-sandal' => 'Sepatu dan Sandal',
            ],

            'elektronik' => [
                'handphone' => 'Handphone',
                'laptop-komputer' => 'Laptop dan Komputer',
                'aksesoris-elektronik' => 'Aksesoris Elektronik',
            ],

            'makanan-minuman' => [
                'makanan-ringan' => 'Makanan Ringan',
                'makanan-tradisional' => 'Makanan Tradisional',
                'minuman' => 'Minuman',
            ],

            'kerajinan' => [
                'kerajinan-tangan' => 'Kerajinan Tangan',
                'dekorasi' => 'Dekorasi',
                'aksesoris-handmade' => 'Aksesoris Handmade',
            ],

            'rumah-tangga' => [
                'peralatan-dapur' => 'Peralatan Dapur',
                'perabot-rumah' => 'Perabot Rumah',
                'perlengkapan-rumah' => 'Perlengkapan Rumah',
            ],
        ];

        foreach ($children as $parentSlug => $items) {
            foreach ($items as $slug => $name) {
                Category::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'parent_id' => $parents[$parentSlug]->id,
                        'name' => $name,
                    ]
                );
            }
        }
    }
}
