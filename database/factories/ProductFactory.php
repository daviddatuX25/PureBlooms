<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Category;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'name' => fake()->unique()->words(3, true),
            'description' => fake()->paragraph(2),
            'price' => fake()->randomFloat(2, 150, 5000),
            'stock_quantity' => fake()->numberBetween(0, 100),
            'image_path' => null,
            'is_active' => true,
        ];
    }
}