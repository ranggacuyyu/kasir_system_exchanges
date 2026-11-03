<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cashierBudi = User::where('email', 'kasir@kasir.com')->first();
        $cashierSiti = User::where('email', 'siti@kasir.com')->first();

        $custGuest = Customer::where('customer_name', 'Umum / Guest')->first();
        $custAndi = Customer::where('customer_name', 'Andi Pratama')->first();
        $custRina = Customer::where('customer_name', 'Rina Wijaya')->first();
        $custDewi = Customer::where('customer_name', 'Dewi Lestari')->first();

        $menuRendang = MenuItem::where('name_menu', 'Nasi Rendang Daging')->first();
        $menuAyamPop = MenuItem::where('name_menu', 'Ayam Pop Spesial')->first();
        $menuNasgor = MenuItem::where('name_menu', 'Nasi Goreng Spesial')->first();
        $menuEsTeh = MenuItem::where('name_menu', 'Es Teh Manis')->first();
        $menuKopiSusu = MenuItem::where('name_menu', 'Kopi Susu Gula Aren')->first();
        $menuFries = MenuItem::where('name_menu', 'French Fries Crispy')->first();

        // 1. Order Utama (Sesuai mockup UI #PSN10298283830)
        $order1 = Order::updateOrCreate(
            ['payment_code' => 'PSN10298283830'],
            [
                'id_user' => $cashierBudi?->id,
                'id_customer' => $custAndi?->id ?? $custGuest?->id,
                'payment_code' => 'PSN10298283830',
                'table_number' => 'Meja 2',
                'order_type' => 'dine_in',
                'order_source' => 'qr',
                'status' => 'pending',
                'tax' => 7900,
                'total' => 86900,
                'notes' => 'Sambal rendang dipisah, es teh manis sedikit gula',
            ]
        );

        $this->seedOrderItemsAndPayment($order1, [
            [
                'menu' => $menuRendang,
                'qty' => 2,
                'total' => 44000,
                'drink_status' => 'baru',
            ],
            [
                'menu' => $menuAyamPop,
                'qty' => 1,
                'total' => 20000,
                'drink_status' => 'baru',
            ],
            [
                'menu' => $menuEsTeh,
                'qty' => 3,
                'total' => 15000,
                'drink_status' => 'proses',
            ],
        ], [
            'amount_paid' => 0,
            'status_payment' => 'pending',
            'payment_method' => null,
            'payment_gateway' => null,
        ]);

        // 2. Order #0001 (Meja 1 - Pending)
        $order2 = Order::updateOrCreate(
            ['payment_code' => 'PSN-0001'],
            [
                'id_user' => $cashierBudi?->id,
                'id_customer' => $custDewi?->id ?? $custGuest?->id,
                'payment_code' => 'PSN-0001',
                'table_number' => 'Meja 1',
                'order_type' => 'dine_in',
                'order_source' => 'pos',
                'status' => 'pending',
                'tax' => 4000,
                'total' => 45000,
                'notes' => 'Pesanan dine in meja 1',
            ]
        );

        $this->seedOrderItemsAndPayment($order2, [
            [
                'menu' => $menuNasgor,
                'qty' => 1,
                'total' => 18000,
                'drink_status' => 'baru',
            ],
            [
                'menu' => $menuKopiSusu,
                'qty' => 1,
                'total' => 15000,
                'drink_status' => 'baru',
            ],
            [
                'menu' => $menuFries,
                'qty' => 1,
                'total' => 12000,
                'drink_status' => 'baru',
            ],
        ], [
            'amount_paid' => 0,
            'status_payment' => 'pending',
            'payment_method' => null,
            'payment_gateway' => null,
        ]);

        // 3. Order #0002 (Meja 3 - Selesai / Paid)
        $order3 = Order::updateOrCreate(
            ['payment_code' => 'PSN-0002'],
            [
                'id_user' => $cashierSiti?->id,
                'id_customer' => $custGuest?->id,
                'payment_code' => 'PSN-0002',
                'table_number' => 'Meja 3',
                'order_type' => 'dine_in',
                'order_source' => 'pos',
                'status' => 'completed',
                'tax' => 2500,
                'total' => 28000,
                'notes' => 'Pembayaran lunas via QRIS',
            ]
        );

        $this->seedOrderItemsAndPayment($order3, [
            [
                'menu' => $menuAyamPop,
                'qty' => 1,
                'total' => 20000,
                'drink_status' => 'selesai',
            ],
            [
                'menu' => $menuEsTeh,
                'qty' => 1,
                'total' => 5000,
                'drink_status' => 'selesai',
            ],
        ], [
            'amount_paid' => 28000,
            'status_payment' => 'paid',
            'payment_method' => 'qris',
            'payment_gateway' => 'QRIS BCA',
        ]);

        // 4. Order #0003 (Take Away - Selesai / Paid Cash)
        $order4 = Order::updateOrCreate(
            ['payment_code' => 'PSN-0003'],
            [
                'id_user' => $cashierBudi?->id,
                'id_customer' => $custRina?->id ?? $custGuest?->id,
                'payment_code' => 'PSN-0003',
                'table_number' => 'Take Away',
                'order_type' => 'take_away',
                'order_source' => 'pos',
                'status' => 'completed',
                'tax' => 6500,
                'total' => 72000,
                'notes' => 'Bungkus rapi, pisah kuah dan sambal',
            ]
        );

        $this->seedOrderItemsAndPayment($order4, [
            [
                'menu' => $menuRendang,
                'qty' => 2,
                'total' => 44000,
                'drink_status' => 'selesai',
            ],
            [
                'menu' => $menuNasgor,
                'qty' => 1,
                'total' => 18000,
                'drink_status' => 'selesai',
            ],
            [
                'menu' => $menuEsTeh,
                'qty' => 2,
                'total' => 10000,
                'drink_status' => 'selesai',
            ],
        ], [
            'amount_paid' => 100000,
            'status_payment' => 'paid',
            'payment_method' => 'cash',
            'payment_gateway' => 'Cash / Tunai',
        ]);
    }

    /**
     * Helper to seed order items and payment record.
     */
    private function seedOrderItemsAndPayment(Order $order, array $items, array $paymentData): void
    {
        // Bersihkan item lama jika ada untuk mencegah duplikasi saat re-seed
        OrderItem::where('id_order', $order->id_order)->delete();

        foreach ($items as $item) {
            if ($item['menu']) {
                OrderItem::create([
                    'id_order' => $order->id_order,
                    'id_menu' => $item['menu']->id_menu,
                    'quantity' => $item['qty'],
                    'change_type' => null,
                    'total' => $item['total'],
                    'drink_status' => $item['drink_status'],
                ]);
            }
        }

        Payment::updateOrCreate(
            ['id_order' => $order->id_order],
            [
                'id_order' => $order->id_order,
                'amount_paid' => $paymentData['amount_paid'],
                'status_payment' => $paymentData['status_payment'],
                'payment_method' => $paymentData['payment_method'],
                'payment_gateway' => $paymentData['payment_gateway'],
            ]
        );
    }
}

