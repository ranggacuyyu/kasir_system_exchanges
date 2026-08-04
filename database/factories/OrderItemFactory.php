<?php

namespace Database\Factories;

use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition(): array
    {
        $quantity = fake()->numberBetween(1, 5);
        $price = fake()->numberBetween(15000, 45000);

        return [
            'id_order' => Order::factory(),
            'id_menu' => MenuItem::factory(),
            'quantity' => $quantity,
            'change_type' => fake()->optional()->randomElement(['normal', 'extra_rice', 'no_chili']),
            'total' => $price * $quantity,
            'drink_status' => fake()->randomElement(['baru', 'proses', 'selesai']),
        ];
    }
}
