<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Enums\Status;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'full_name' => 'Administrator Kasir',
                'email' => 'admin@kasir.com',
                'password' => Hash::make('password'),
                'no_hp' => '081234567890',
                'role' => RoleEnum::ADMIN->value,
                'status' => Status::ACTIVE->value,
                'email_verified_at' => now(),
            ],
            [
                'full_name' => 'Budi Santoso',
                'email' => 'kasir@kasir.com',
                'password' => Hash::make('password'),
                'no_hp' => '081234567891',
                'role' => RoleEnum::KASIR->value,
                'status' => Status::ACTIVE->value,
                'email_verified_at' => now(),
            ],
            [
                'full_name' => 'Siti Rahma',
                'email' => 'siti@kasir.com',
                'password' => Hash::make('password'),
                'no_hp' => '081234567892',
                'role' => RoleEnum::KASIR->value,
                'status' => Status::ACTIVE->value,
                'email_verified_at' => now(),
            ],
            [
                'full_name' => 'Ahmad Fauzi',
                'email' => 'ahmad@kasir.com',
                'password' => Hash::make('password'),
                'no_hp' => '081234567893',
                'role' => RoleEnum::KASIR->value,
                'status' => Status::ACTIVE->value,
                'email_verified_at' => now(),
            ],
            [
                'full_name' => 'Karyawan Nonaktif',
                'email' => 'nonaktif@kasir.com',
                'password' => Hash::make('password'),
                'no_hp' => '081234567899',
                'role' => RoleEnum::KASIR->value,
                'status' => Status::INACTIVE->value,
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }
}

