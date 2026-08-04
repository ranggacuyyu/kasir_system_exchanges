<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            MenuItemSeeder::class,
            CustomerSeeder::class,
            ScheduleSeeder::class,
            AttendanceSeeder::class,
            PayrollSeeder::class,
            StokLogSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
