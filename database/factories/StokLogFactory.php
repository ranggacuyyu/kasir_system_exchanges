<?php

namespace Database\Factories;

use App\Models\MenuItem;
use App\Models\StokLog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StokLog>
 */
class StokLogFactory extends Factory
{
    protected $model = StokLog::class;

    public function definition(): array
    {
        return [
            'id_menu' => MenuItem::factory(),
            'change_type' => fake()->randomElement(['in', 'out', 'adjustment']),
            'quantity' => fake()->numberBetween(1, 50),
            'note' => fake()->sentence(),
        ];
    }
}
