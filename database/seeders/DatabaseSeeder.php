<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('Starting PureBlooms database seeding...');

        // 1. Core reference data
        $this->call(CategorySeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(AddonSeeder::class);

        // 2. Products depend on categories
        $this->call(ProductSeeder::class);

        // 3. Demo users
        $this->call(DemoUserSeeder::class);

        // 4. Demo orders depend on users, products, addons, settings
        $this->call(DemoOrderSeeder::class);

        // 5. Original admin seeder (keep for backwards compat)
        $this->call(\Database\Seeders\AdminUserSeeder::class);

        $this->command->info('PureBlooms database seeding completed!');
    }
}