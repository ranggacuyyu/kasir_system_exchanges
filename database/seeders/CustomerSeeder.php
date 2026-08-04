<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            [
                'customer_name' => 'Budi Santoso',
                'customer_phone' => '081234567891',
                'service' => 'Dine In',
                'comment' => 'Pelanggan setia',
                'status' => 'active',
            ],
            [
                'customer_name' => 'Siti Nurhaliza',
                'customer_phone' => '081298765412',
                'service' => 'Takeaway',
                'comment' => 'Pesanan katering kantor',
                'status' => 'active',
            ],
            [
                'customer_name' => 'Rian Hidayat',
                'customer_phone' => '085712345678',
                'service' => 'VIP',
                'comment' => 'Meja langganan 05',
                'status' => 'active',
            ],
        ];

        foreach ($customers as $c) {
            Customer::firstOrCreate(
                ['customer_phone' => $c['customer_phone']],
                $c
            );
        }

        Customer::factory(5)->create();
    }
}
