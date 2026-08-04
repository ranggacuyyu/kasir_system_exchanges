<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $kasir = User::where('role', 'kasir')->first() ?? User::first();
        $customer = Customer::first();
        $menuItems = MenuItem::all();

        if ($menuItems->count() < 2) {
            return;
        }

        // Sample Order 1
        $item1 = $menuItems[0];
        $item2 = $menuItems[4] ?? $menuItems[1]; // Es teh manis or second menu

        $subtotal = ($item1->price * 2) + ($item2->price * 2);
        $tax = $subtotal * 0.1;
        $total = $subtotal + $tax;

        $order = Order::create([
            'id_user' => $kasir->id,
            'id_customer' => $customer?->id_customer,
            'payment_code' => 'ORD-' . strtoupper(Str::random(8)),
            'table_number' => '05',
            'order_type' => 'dine_in',
            'order_source' => 'pos',
            'status' => 'completed',
            'tax' => $tax,
            'total' => $total,
            'notes' => 'Pesanan di meja 05',
        ]);

        OrderItem::create([
            'id_order' => $order->id_order,
            'id_menu' => $item1->id_menu,
            'quantity' => 2,
            'change_type' => 'normal',
            'total' => $item1->price * 2,
            'drink_status' => 'selesai',
        ]);

        OrderItem::create([
            'id_order' => $order->id_order,
            'id_menu' => $item2->id_menu,
            'quantity' => 2,
            'change_type' => 'normal',
            'total' => $item2->price * 2,
            'drink_status' => 'selesai',
        ]);

        Payment::create([
            'id_order' => $order->id_order,
            'amount_paid' => $total,
            'status_payment' => 'paid',
            'payment_method' => 'cash',
            'payment_gateway' => null,
        ]);
    }
}
