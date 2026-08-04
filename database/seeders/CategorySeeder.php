<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name_categories' => 'Makanan Utama',
                'description' => 'Aneka lauk pauk khas Padang dan nasi hangat',
                'status' => 'active',
            ],
            [
                'name_categories' => 'Minuman Panas & Dingin',
                'description' => 'Aneka jus, es teh, kopi, dan minuman menyegarkan',
                'status' => 'active',
            ],
            [
                'name_categories' => 'Sambal & Tambahan',
                'description' => 'Sambal hijau, kerupuk kulit, kuah gulai extra',
                'status' => 'active',
            ],
            [
                'name_categories' => 'Paket Hemat',
                'description' => 'Paket nasi komplit lauk pilihan',
                'status' => 'active',
            ],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(
                ['name_categories' => $cat['name_categories']],
                $cat
            );
        }
    }
}
