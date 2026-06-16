<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $categories = Category::all()->keyBy('name');

        $products = [
            // Hand Bouquets
            [
                'category' => 'Hand Bouquets',
                'name' => 'Classic Red Rose Bouquet',
                'description' => 'A timeless arrangement of 12 premium Ecuadorian red roses, wrapped in elegant kraft paper with satin ribbon. Perfect for anniversaries, Valentine\'s Day, or expressing deep love.',
                'price' => 2500.00,
                'stock' => 25,
            ],
            [
                'category' => 'Hand Bouquets',
                'name' => 'Mixed Pastel Garden Bouquet',
                'description' => 'A dreamy blend of garden roses, peonies, ranunculus, and sweet peas in soft pinks, creams, and lavenders. Wrapped in vintage floral paper.',
                'price' => 3200.00,
                'stock' => 15,
            ],
            [
                'category' => 'Hand Bouquets',
                'name' => 'Sunburst Sunflower Bouquet',
                'description' => 'Bright and cheerful bouquet featuring 8 premium sunflowers with seasonal fillers and eucalyptus. Wrapped in rustic burlap with jute twine.',
                'price' => 1800.00,
                'stock' => 30,
            ],
            [
                'category' => 'Hand Bouquets',
                'name' => 'Elegant White Lily & Rose Bouquet',
                'description' => 'Sophisticated combination of Oriental lilies and white roses with greenery. Perfect for sympathy, new beginnings, or elegant gestures.',
                'price' => 2800.00,
                'stock' => 12,
            ],

            // Vase Arrangements
            [
                'category' => 'Vase Arrangements',
                'name' => 'Premium Crystal Vase Arrangement',
                'description' => 'Luxury arrangement in a crystal vase featuring orchids, roses, hydrangeas, and premium foliage. A statement piece for any space.',
                'price' => 5500.00,
                'stock' => 8,
            ],
            [
                'category' => 'Vase Arrangements',
                'name' => 'Tropical Paradise Vase',
                'description' => 'Exotic arrangement with birds of paradise, anthuriums, heliconias, and tropical greens in a modern ceramic vase.',
                'price' => 4200.00,
                'stock' => 10,
            ],
            [
                'category' => 'Vase Arrangements',
                'name' => 'Rustic Mason Jar Wildflowers',
                'description' => 'Charming country-style arrangement with wildflowers, daisies, lavender, and wheat stems in a vintage mason jar.',
                'price' => 1500.00,
                'stock' => 20,
            ],

            // Box Flowers
            [
                'category' => 'Box Flowers',
                'name' => 'Luxury Velvet Box - Red Roses',
                'description' => '18 premium red roses arranged in a signature velvet hat box. The ultimate romantic gift that makes an unforgettable impression.',
                'price' => 4800.00,
                'stock' => 10,
            ],
            [
                'category' => 'Box Flowers',
                'name' => 'Pastel Garden Hat Box',
                'description' => 'Delicate mix of garden roses, ranunculus, and hydrangeas in blush, cream, and sage tones arranged in a premium round hat box.',
                'price' => 3800.00,
                'stock' => 12,
            ],
            [
                'category' => 'Box Flowers',
                'name' => 'Preserved Eternity Box',
                'description' => 'Real preserved roses that last 1-3 years in a luxury acrylic box. Available in red, pink, white, or champagne.',
                'price' => 3500.00,
                'stock' => 15,
            ],

            // Preserved Flowers
            [
                'category' => 'Preserved Flowers',
                'name' => 'Forever Rose Dome',
                'description' => 'A single perfect preserved rose encased in a glass dome with LED base. Lasts 3+ years with zero maintenance.',
                'price' => 2200.00,
                'stock' => 20,
            ],
            [
                'category' => 'Preserved Flowers',
                'name' => 'Preserved Hydrangea Wreath',
                'description' => 'Elegant wreath of preserved hydrangeas and eucalyptus on a grapevine base. Perfect for door or wall decor.',
                'price' => 2800.00,
                'stock' => 8,
            ],

            // Sympathy
            [
                'category' => 'Sympathy & Condolence',
                'name' => 'Peaceful White Standing Spray',
                'description' => 'Elegant standing spray with white lilies, roses, chrysanthemums, and greenery on an easel. For funeral services.',
                'price' => 6500.00,
                'stock' => 5,
            ],
            [
                'category' => 'Sympathy & Condolence',
                'name' => 'Serenity Sympathy Basket',
                'description' => 'Thoughtful basket arrangement with white roses, lilies, carnations, and ferns. Suitable for home or service.',
                'price' => 3500.00,
                'stock' => 10,
            ],

            // Wedding
            [
                'category' => 'Wedding Collection',
                'name' => 'Bridal Cascade Bouquet',
                'description' => 'Stunning cascading bridal bouquet with orchids, garden roses, stephanotis, and trailing greenery. Customizable to match wedding palette.',
                'price' => 4500.00,
                'stock' => 6,
            ],
            [
                'category' => 'Wedding Collection',
                'name' => 'Bridesmaid Posy Bouquet',
                'description' => 'Compact hand-tied posy for bridesmaids featuring roses, ranunculus, and waxflower. Available in multiple color combinations.',
                'price' => 1800.00,
                'stock' => 20,
            ],

            // Indoor Plants
            [
                'category' => 'Indoor Plants',
                'name' => 'Fiddle Leaf Fig Tree (Large)',
                'description' => 'Statement fiddle leaf fig in a 14-inch pot, approximately 5-6 feet tall. Includes care guide and decorative pot.',
                'price' => 3500.00,
                'stock' => 8,
            ],
            [
                'category' => 'Indoor Plants',
                'name' => 'Monstera Deliciosa',
                'description' => 'Popular Swiss cheese plant in 10-inch pot with moss pole. Easy care, dramatic foliage for modern interiors.',
                'price' => 1800.00,
                'stock' => 15,
            ],
            [
                'category' => 'Indoor Plants',
                'name' => 'Snake Plant Trio',
                'description' => 'Set of 3 snake plants in varying heights in modern concrete pots. Air-purifying and virtually indestructible.',
                'price' => 2200.00,
                'stock' => 12,
            ],

            // Seasonal
            [
                'category' => 'Seasonal Specials',
                'name' => 'Christmas Poinsettia Deluxe',
                'description' => 'Premium poinsettia in red, white, or marble in a decorative foil wrap with coordinating bow.',
                'price' => 1200.00,
                'stock' => 30,
            ],
            [
                'category' => 'Seasonal Specials',
                'name' => 'Valentine\'s Day Grand Gesture',
                'description' => '24 long-stem red roses in a premium vase with chocolates and a keepsake teddy bear. Limited edition for February.',
                'price' => 5800.00,
                'stock' => 15,
            ],
        ];

        foreach ($products as $product) {
            $category = $categories->get($product['category']);
            if ($category) {
                Product::updateOrCreate(
                    ['name' => $product['name']],
                    [
                        'category_id' => $category->id,
                        'description' => $product['description'],
                        'price' => $product['price'],
                        'stock_quantity' => $product['stock'],
                        'is_active' => true,
                    ]
                );
            }
        }

        $this->command->info('Products seeded: ' . Product::count());
    }
}