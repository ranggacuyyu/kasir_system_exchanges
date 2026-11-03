<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'customer_name' => 'Umum / Guest',
                'customer_phone' => null,
                'service' => 'Dine In',
                'comment' => 'Pelanggan walk-in umum',
                'status' => 'active',
            ],
            [
                'customer_name' => 'Andi Pratama',
                'customer_phone' => '082112345678',
                'service' => 'Dine In',
                'comment' => 'Pelanggan setia meja 2',
                'status' => 'active',
            ],
            [
                'customer_name' => 'Rina Wijaya',
                'customer_phone' => '082198765432',
                'service' => 'Take Away',
                'comment' => 'Sering memesan paket makan siang take away',
                'status' => 'active',
            ],
            [
                'customer_name' => 'Dewi Lestari',
                'customer_phone' => '081345678901',
                'service' => 'Dine In',
                'comment' => 'Anggota member reguler',
                'status' => 'active',
            ],
            [
                'customer_name' => 'Bambang Sudirman',
                'customer_phone' => '085234567890',
                'service' => 'Delivery',
                'comment' => 'Pemesanan online via QR / WhatsApp',
                'status' => 'active',
            ],
        ];

        foreach ($customers as $customer) {
            Customer::updateOrCreate(
                ['customer_name' => $customer['customer_name']],
                $customer
            );
        }
    }
}

