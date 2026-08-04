<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        $makananCategory = Category::where('name_categories', 'Makanan Utama')->first() ?? Category::factory()->create(['name_categories' => 'Makanan Utama']);
        $minumanCategory = Category::where('name_categories', 'Minuman Panas & Dingin')->first() ?? Category::factory()->create(['name_categories' => 'Minuman Panas & Dingin']);
        $tambahanCategory = Category::where('name_categories', 'Sambal & Tambahan')->first() ?? Category::factory()->create(['name_categories' => 'Sambal & Tambahan']);

        $menuItems = [
            // Makanan
            [
                'id_categories' => $makananCategory->id_categories,
                'name_menu' => 'Rendang Daging Sapi',
                'modal' => 15000,
                'price' => 22000,
                'stok' => 50,
                'imgae_url' => 'https://images.unsplash.com/photo-1541832676-9b763b0239ab',
                'description' => 'Rendang daging sapi empuk bumbu rempah asli Minang',
                'status' => 'available',
            ],
            [
                'id_categories' => $makananCategory->id_categories,
                'name_menu' => 'Ayam Pop Spesial',
                'modal' => 12000,
                'price' => 18000,
                'stok' => 40,
                'imgae_url' => 'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec',
                'description' => 'Ayam pop lembut khas Bukittinggi dengan saus pedas manis',
                'status' => 'available',
            ],
            [
                'id_categories' => $makananCategory->id_categories,
                'name_menu' => 'Gulai Cincang',
                'modal' => 14000,
                'price' => 20000,
                'stok' => 30,
                'imgae_url' => 'https://images.unsplash.com/photo-1546833999-b9f581a1996d',
                'description' => 'Gulai daging cincang gurih berkuah kental',
                'status' => 'available',
            ],
            [
                'id_categories' => $makananCategory->id_categories,
                'name_menu' => 'Telur Dadar Bumbu Padang',
                'modal' => 5000,
                'price' => 10000,
                'stok' => 60,
                'imgae_url' => 'https://images.unsplash.com/photo-1525351484163-7529414344d8',
                'description' => 'Telur dadar tebal khas Padang dengan daun bawang dan cabe',
                'status' => 'available',
            ],

            // Minuman
            [
                'id_categories' => $minumanCategory->id_categories,
                'name_menu' => 'Es Teh Manis',
                'modal' => 2000,
                'price' => 5000,
                'stok' => 100,
                'imgae_url' => 'https://images.unsplash.com/photo-1556679343-c7306c1976bc',
                'description' => 'Es teh manis segar',
                'status' => 'available',
            ],
            [
                'id_categories' => $minumanCategory->id_categories,
                'name_menu' => 'Jus Pinang Muda',
                'modal' => 6000,
                'price' => 12000,
                'stok' => 25,
                'imgae_url' => 'https://images.unsplash.com/photo-1546173159-315724a31696',
                'description' => 'Jus pinang muda penambah stamina',
                'status' => 'available',
            ],

            // Tambahan
            [
                'id_categories' => $tambahanCategory->id_categories,
                'name_menu' => 'Kerupuk Jangat / Kulit',
                'modal' => 3000,
                'price' => 6000,
                'stok' => 80,
                'imgae_url' => 'https://images.unsplash.com/photo-1599487488170-d11ec9c172f0',
                'description' => 'Kerupuk kulit siram kuah gulai',
                'status' => 'available',
            ],
        ];

        foreach ($menuItems as $item) {
            MenuItem::firstOrCreate(
                ['name_menu' => $item['name_menu']],
                $item
            );
        }
    }
}
