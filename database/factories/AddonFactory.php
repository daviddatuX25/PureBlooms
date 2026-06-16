<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Addon;

class AddonFactory extends Factory
{
    protected $model = Addon::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->words(2, true),
            'slug' => fake()->unique()->slug(2),
            'price' => fake()->randomFloat(2, 10, 200),
            'description' => fake()->paragraph(),
            'is_active' => true,
            'sort_order' => fake()->numberBetween(1, 10),
        ];
    }
}