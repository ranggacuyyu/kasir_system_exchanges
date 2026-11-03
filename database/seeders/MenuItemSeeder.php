<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\MenuItem;
use App\Models\StokLog;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryMakanan = Category::where('name_categories', 'Makanan Utama')->first();
        $categoryMinumanDingin = Category::where('name_categories', 'Minuman Dingin')->first();
        $categoryMinumanPanas = Category::where('name_categories', 'Minuman Panas')->first();
        $categorySnack = Category::where('name_categories', 'Camilan & Snack')->first();
        $categoryPaket = Category::where('name_categories', 'Paket Hemat')->first();

        $menuList = [
            // Makanan Utama
            [
                'category_id' => $categoryMakanan?->id_categories,
                'name_menu' => 'Nasi Rendang Daging',
                'modal' => 15000,
                'price' => 22000,
                'stok' => 35,
                'imgae_url' => null,
                'description' => 'Nasi putih dengan rendang sapi empuk berbumbu rempah autentik',
                'status' => 'available',
            ],
            [
                'category_id' => $categoryMakanan?->id_categories,
                'name_menu' => 'Ayam Pop Spesial',
                'modal' => 12000,
                'price' => 20000,
                'stok' => 25,
                'imgae_url' => null,
                'description' => 'Ayam pop gurih khas Minang disajikan dengan sambal lado merah',
                'status' => 'available',
            ],
            [
                'category_id' => $categoryMakanan?->id_categories,
                'name_menu' => 'Nasi Goreng Spesial',
                'modal' => 10000,
                'price' => 18000,
                'stok' => 40,
                'imgae_url' => null,
                'description' => 'Nasi goreng harum dengan suwiran ayam, bakso, dan telur ceplok',
                'status' => 'available',
            ],
            [
                'category_id' => $categoryMakanan?->id_categories,
                'name_menu' => 'Mie Goreng Aceh',
                'modal' => 11000,
                'price' => 19000,
                'stok' => 30,
                'imgae_url' => null,
                'description' => 'Mie kuning tebal dengan bumbu kari Aceh pedas kaya rempah',
                'status' => 'available',
            ],
            [
                'category_id' => $categoryMakanan?->id_categories,
                'name_menu' => 'Ayam Bakar Madu',
                'modal' => 13000,
                'price' => 21000,
                'stok' => 20,
                'imgae_url' => null,
                'description' => 'Potongan ayam bakar gurih karamel madu disajikan dengan sambal terasi',
                'status' => 'available',
            ],

            // Minuman Dingin
            [
                'category_id' => $categoryMinumanDingin?->id_categories,
                'name_menu' => 'Es Teh Manis',
                'modal' => 2000,
                'price' => 5000,
                'stok' => 100,
                'imgae_url' => null,
                'description' => 'Teh melati seduh segar dengan es batu dan gula asli',
                'status' => 'available',
            ],
            [
                'category_id' => $categoryMinumanDingin?->id_categories,
                'name_menu' => 'Es Jeruk Peras',
                'modal' => 3500,
                'price' => 8000,
                'stok' => 60,
                'imgae_url' => null,
                'description' => 'Perasan jeruk segar asli tanpa pemanis buatan',
                'status' => 'available',
            ],
            [
                'category_id' => $categoryMinumanDingin?->id_categories,
                'name_menu' => 'Kopi Susu Gula Aren',
                'modal' => 6000,
                'price' => 15000,
                'stok' => 50,
                'imgae_url' => null,
                'description' => 'Perpaduan espresso blend, susu creamy, dan sirup gula aren alami',
                'status' => 'available',
            ],
            [
                'category_id' => $categoryMinumanDingin?->id_categories,
                'name_menu' => 'Matcha Ice Latte',
                'modal' => 7500,
                'price' => 18000,
                'stok' => 40,
                'imgae_url' => null,
                'description' => 'Bubuk matcha murni berpadu dengan susu segar dingin yang lembut',
                'status' => 'available',
            ],
            [
                'category_id' => $categoryMinumanDingin?->id_categories,
                'name_menu' => 'Es Cincau Susu',
                'modal' => 4000,
                'price' => 10000,
                'stok' => 45,
                'imgae_url' => null,
                'description' => 'Cincau hitam kenyal dengan susu segar manis gurih',
                'status' => 'available',
            ],

            // Minuman Panas
            [
                'category_id' => $categoryMinumanPanas?->id_categories,
                'name_menu' => 'Kopi Tubruk Robusta',
                'modal' => 3000,
                'price' => 7000,
                'stok' => 80,
                'imgae_url' => null,
                'description' => 'Kopi hitam tradisional dengan rasa pekat dan aroma kuat',
                'status' => 'available',
            ],
            [
                'category_id' => $categoryMinumanPanas?->id_categories,
                'name_menu' => 'Teh Tarik Hangat',
                'modal' => 4000,
                'price' => 9000,
                'stok' => 50,
                'imgae_url' => null,
                'description' => 'Teh susu berbusa kaya rasa manis dan creamy khas',
                'status' => 'available',
            ],
            [
                'category_id' => $categoryMinumanPanas?->id_categories,
                'name_menu' => 'Hot Americano',
                'modal' => 4500,
                'price' => 12000,
                'stok' => 60,
                'imgae_url' => null,
                'description' => 'Double shot espresso dengan air panas murni tanpa gula',
                'status' => 'available',
            ],
            [
                'category_id' => $categoryMinumanPanas?->id_categories,
                'name_menu' => 'Wedang Jahe Susu',
                'modal' => 3500,
                'price' => 8500,
                'stok' => 40,
                'imgae_url' => null,
                'description' => 'Seduhan jahe merah hangat berpadu kental manis menghangatkan tubuh',
                'status' => 'available',
            ],

            // Camilan & Snack
            [
                'category_id' => $categorySnack?->id_categories,
                'name_menu' => 'French Fries Crispy',
                'modal' => 6000,
                'price' => 12000,
                'stok' => 50,
                'imgae_url' => null,
                'description' => 'Kentang goreng renyah disajikan dengan saus sambal dan mayones',
                'status' => 'available',
            ],
            [
                'category_id' => $categorySnack?->id_categories,
                'name_menu' => 'Pisang Goreng Crispy',
                'modal' => 5000,
                'price' => 10000,
                'stok' => 35,
                'imgae_url' => null,
                'description' => 'Pisang goreng tepung renyah dengan taburan keju parut dan susu cokelat',
                'status' => 'available',
            ],
            [
                'category_id' => $categorySnack?->id_categories,
                'name_menu' => 'Tahu Walik Krispi',
                'modal' => 5500,
                'price' => 12000,
                'stok' => 40,
                'imgae_url' => null,
                'description' => 'Tahu walik isi adonan ayam garing disajikan dengan sambal kecap pedas',
                'status' => 'available',
            ],
            [
                'category_id' => $categorySnack?->id_categories,
                'name_menu' => 'Roti Bakar Cokelat Keju',
                'modal' => 6500,
                'price' => 14000,
                'stok' => 30,
                'imgae_url' => null,
                'description' => 'Roti panggang krispi berbalur mentega dengan isian cokelat lumer dan keju cheddar',
                'status' => 'available',
            ],

            // Paket Hemat
            [
                'category_id' => $categoryPaket?->id_categories,
                'name_menu' => 'Paket Nasi Rendang + Es Teh',
                'modal' => 16500,
                'price' => 25000,
                'stok' => 30,
                'imgae_url' => null,
                'description' => 'Paket komplit Nasi Rendang Daging dan Es Teh Manis segar',
                'status' => 'available',
            ],
            [
                'category_id' => $categoryPaket?->id_categories,
                'name_menu' => 'Paket Nasi Goreng + Es Jeruk',
                'modal' => 13000,
                'price' => 23000,
                'stok' => 25,
                'imgae_url' => null,
                'description' => 'Paket komplit Nasi Goreng Spesial dan Es Jeruk Peras segar',
                'status' => 'available',
            ],
        ];

        foreach ($menuList as $item) {
            $menu = MenuItem::updateOrCreate(
                ['name_menu' => $item['name_menu']],
                [
                    'id_categories' => $item['category_id'],
                    'name_menu' => $item['name_menu'],
                    'modal' => $item['modal'],
                    'price' => $item['price'],
                    'stok' => $item['stok'],
                    'imgae_url' => $item['imgae_url'],
                    'description' => $item['description'],
                    'status' => $item['status'],
                ]
            );

            // Log stok awal jika belum ada
            if (!StokLog::where('id_menu', $menu->id_menu)->exists()) {
                StokLog::create([
                    'id_menu' => $menu->id_menu,
                    'change_type' => 'in',
                    'quantity' => $menu->stok,
                    'note' => 'Stok awal sistem kasir',
                ]);
            }
        }
    }
}

