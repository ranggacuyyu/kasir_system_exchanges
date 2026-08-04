<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use App\Models\StokLog;
use Illuminate\Database\Seeder;

class StokLogSeeder extends Seeder
{
    public function run(): void
    {
        $items = MenuItem::all();

        foreach ($items as $item) {
            StokLog::create([
                'id_menu' => $item->id_menu,
                'change_type' => 'in',
                'quantity' => $item->stok,
                'note' => 'Stok awal dapur',
            ]);
        }
    }
}
