<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $total = fake()->numberBetween(25000, 250000);
        $tax = $total * 0.1;

        return [
            'id_user' => User::factory(),
            'id_customer' => Customer::factory(),
            'payment_code' => 'ORD-' . strtoupper(Str::random(8)),
            'table_number' => (string) fake()->numberBetween(1, 20),
            'order_type' => fake()->randomElement(['dine_in', 'take_away', 'delivery']),
            'order_source' => 'pos',
            'status' => fake()->randomElement(['pending', 'completed', 'cancelled']),
            'tax' => $tax,
            'total' => $total + $tax,
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
