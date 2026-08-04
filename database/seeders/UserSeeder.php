<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Enums\Status;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::firstOrCreate(
            ['email' => 'admin@lapau.com'],
            [
                'full_name' => 'Admin Uda Sutan',
                'password' => Hash::make('password'),
                'no_hp' => '081234567890',
                'role' => RoleEnum::ADMIN->value,
                'status' => Status::ACTIVE->value,
                'email_verified_at' => now(),
            ]
        );

        // Kasir User
        User::firstOrCreate(
            ['email' => 'kasir@lapau.com'],
            [
                'full_name' => 'Kasir Lapau 1',
                'password' => Hash::make('password'),
                'no_hp' => '081298765432',
                'role' => RoleEnum::KASIR->value,
                'status' => Status::ACTIVE->value,
                'email_verified_at' => now(),
            ]
        );

        // Create 3 addition staff users
        User::factory(3)->create();
    }
}
