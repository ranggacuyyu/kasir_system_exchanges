<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        return [
            'id_order' => Order::factory(),
            'amount_paid' => fake()->numberBetween(50000, 300000),
            'status_payment' => fake()->randomElement(['paid', 'pending', 'failed']),
            'payment_method' => fake()->randomElement(['cash', 'qris', 'transfer', 'debit']),
            'payment_gateway' => fake()->optional()->randomElement(['Midtrans', 'Xendit']),
        ];
    }
}
