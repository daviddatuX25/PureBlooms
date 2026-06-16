<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Setting;

class SettingFactory extends Factory
{
    protected $model = Setting::class;

    public function definition(): array
    {
        return [
            'key' => fake()->unique()->slug(2),
            'value' => fake()->sentence(),
            'type' => 'string',
            'group' => 'general',
        ];
    }
}