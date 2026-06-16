<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Addon;

class AddonSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $addons = [
            [
                'name' => 'Gift Wrapping - Premium',
                'slug' => 'gift-wrapping-premium',
                'price' => 150.00,
                'description' => 'Luxury gift wrapping with premium paper, ribbon, and gift tag',
                'sort_order' => 1,
            ],
            [
                'name' => 'Gift Wrapping - Standard',
                'slug' => 'gift-wrapping-standard',
                'price' => 80.00,
                'description' => 'Standard gift wrapping with kraft paper and twine',
                'sort_order' => 2,
            ],
            [
                'name' => 'Personalized Message Card',
                'slug' => 'message-card',
                'price' => 50.00,
                'description' => 'Handwritten-style message card with your custom message (up to 160 characters)',
                'sort_order' => 3,
            ],
            [
                'name' => 'Premium Greeting Card',
                'slug' => 'premium-greeting-card',
                'price' => 120.00,
                'description' => 'High-quality folded greeting card with envelope, printed with your message',
                'sort_order' => 4,
            ],
            [
                'name' => 'Chocolate Box - Ferrero Rocher (8pcs)',
                'slug' => 'chocolate-ferrero-8',
                'price' => 350.00,
                'description' => 'Box of 8 Ferrero Rocher chocolates to accompany your flowers',
                'sort_order' => 5,
            ],
            [
                'name' => 'Chocolate Box - Belgian Assortment (12pcs)',
                'slug' => 'chocolate-belgian-12',
                'price' => 550.00,
                'description' => 'Premium Belgian chocolate assortment, 12 pieces in a gift box',
                'sort_order' => 6,
            ],
            [
                'name' => 'Scented Candle - Small',
                'slug' => 'candle-small',
                'price' => 450.00,
                'description' => 'Hand-poured soy candle in a travel tin (60hr burn time)',
                'sort_order' => 7,
            ],
            [
                'name' => 'Scented Candle - Large',
                'slug' => 'candle-large',
                'price' => 850.00,
                'description' => 'Large jar soy candle with premium fragrance (100hr burn time)',
                'sort_order' => 8,
            ],
            [
                'name' => 'Teddy Bear - Small (12")',
                'slug' => 'teddy-small',
                'price' => 400.00,
                'description' => 'Soft plush teddy bear holding a heart, 12 inches tall',
                'sort_order' => 9,
            ],
            [
                'name' => 'Teddy Bear - Large (24")',
                'slug' => 'teddy-large',
                'price' => 850.00,
                'description' => 'Large premium plush teddy bear, 24 inches tall with bow',
                'sort_order' => 10,
            ],
            [
                'name' => 'Balloon Bouquet (3 pcs)',
                'slug' => 'balloon-bouquet-3',
                'price' => 200.00,
                'description' => 'Three helium-filled foil balloons with weights and curling ribbon',
                'sort_order' => 11,
            ],
            [
                'name' => 'Rush Delivery (Same Day)',
                'slug' => 'rush-delivery',
                'price' => 300.00,
                'description' => 'Guaranteed same-day delivery within Metro Manila (order before 12 PM)',
                'sort_order' => 12,
            ],
        ];

        foreach ($addons as $addon) {
            Addon::updateOrCreate(
                ['slug' => $addon['slug']],
                $addon
            );
        }

        $this->command->info('Addons seeded: ' . Addon::count());
    }
}