<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $categories = [
            ['name' => 'Hand Bouquets', 'description' => 'Fresh hand-tied bouquets for all occasions'],
            ['name' => 'Vase Arrangements', 'description' => 'Elegant arrangements in premium vases'],
            ['name' => 'Box Flowers', 'description' => 'Luxury flowers arranged in premium gift boxes'],
            ['name' => 'Preserved Flowers', 'description' => 'Long-lasting preserved and dried flower arrangements'],
            ['name' => 'Sympathy & Condolence', 'description' => 'Respectful arrangements for memorial services'],
            ['name' => 'Wedding Collection', 'description' => 'Bridal bouquets, corsages, and wedding decor'],
            ['name' => 'Indoor Plants', 'description' => 'Beautiful potted plants for home and office'],
            ['name' => 'Seasonal Specials', 'description' => 'Limited-time seasonal flower collections'],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['name' => $cat['name']],
                ['description' => $cat['description']]
            );
        }

        $this->command->info('Categories seeded: ' . Category::count());
    }
}