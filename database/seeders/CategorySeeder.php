<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name_categories' => 'Makanan Utama',
                'description' => 'Aneka menu olahan nasi, ayam, dan daging khas pilihan lezat dan mengenyangkan',
                'status' => 'active',
            ],
            [
                'name_categories' => 'Minuman Dingin',
                'description' => 'Aneka es teh, kopi dingin, dan jus segar pelepas dahaga',
                'status' => 'active',
            ],
            [
                'name_categories' => 'Minuman Panas',
                'description' => 'Seduhan kopi panas, teh hangat, dan jahe spesial',
                'status' => 'active',
            ],
            [
                'name_categories' => 'Camilan & Snack',
                'description' => 'Camilan renyah, gurih, dan manis sebagai teman santai',
                'status' => 'active',
            ],
            [
                'name_categories' => 'Paket Hemat',
                'description' => 'Kombinasi makanan dan minuman dengan harga bersahabat',
                'status' => 'active',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name_categories' => $category['name_categories']],
                $category
            );
        }
    }
}

