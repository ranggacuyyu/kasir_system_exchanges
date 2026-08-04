<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MenuItem>
 */
class MenuItemFactory extends Factory
{
    protected $model = MenuItem::class;

    public function definition(): array
    {
        $modal = fake()->numberBetween(5000, 25000);
        return [
            'id_categories' => Category::factory(),
            'name_menu' => fake()->words(2, true),
            'modal' => $modal,
            'price' => $modal + fake()->numberBetween(3000, 15000),
            'stok' => fake()->numberBetween(10, 100),
            'imgae_url' => fake()->imageUrl(640, 480, 'food', true),
            'description' => fake()->sentence(),
            'status' => 'available',
        ];
    }
}
