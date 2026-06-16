<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Models\Addon;
use App\Models\Setting;

class DemoOrderSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Get needed models
        $customers = User::where('role', 'customer')->get();
        $products = Product::where('is_active', true)->get();
        $addons = Addon::where('is_active', true)->get();

        if ($customers->isEmpty() || $products->isEmpty()) {
            $this->command->error('Need customers and products first. Run DemoUserSeeder and ProductSeeder first.');
            return;
        }

        // Clear existing demo orders (optional - comment out if you want to keep)
        // Order::whereIn('order_number', function($q) { $q->from('orders')->where('order_number', 'like', 'DEMO-%'); })->delete();

        $demoOrders = [
            // Order 1: Pending - New order for demo (Customer: Brix)
            [
                'customer' => 'brix@customer.com',
                'status' => 'pending',
                'payment_status' => 'pending',
                'payment_method' => 'COD',
                'items' => [
                    ['product' => 'Classic Red Rose Bouquet', 'qty' => 1],
                    ['product' => 'Gift Wrapping - Premium', 'qty' => 1, 'is_addon' => true],
                    ['product' => 'Personalized Message Card', 'qty' => 1, 'is_addon' => true],
                ],
                'notes' => 'Anniversary gift for wife. Please deliver on Feb 14.',
                'days_ago' => 0,
            ],

            // Order 2: Processing - Being prepared (Customer: Ydel)
            [
                'customer' => 'ydel@customer.com',
                'status' => 'processing',
                'payment_status' => 'paid',
                'payment_method' => 'GCash',
                'items' => [
                    ['product' => 'Mixed Pastel Garden Bouquet', 'qty' => 1],
                    ['product' => 'Premium Greeting Card', 'qty' => 1, 'is_addon' => true],
                ],
                'notes' => 'Birthday surprise for mom.',
                'days_ago' => 1,
            ],

            // Order 3: Shipped - Out for delivery (Customer: Maria)
            [
                'customer' => 'maria.santos@email.com',
                'status' => 'shipped',
                'payment_status' => 'paid',
                'payment_method' => 'GCash',
                'items' => [
                    ['product' => 'Sunburst Sunflower Bouquet', 'qty' => 2],
                    ['product' => 'Gift Wrapping - Standard', 'qty' => 2, 'is_addon' => true],
                ],
                'notes' => 'Office delivery. Call upon arrival.',
                'days_ago' => 2,
            ],

            // Order 4: Delivered - Completed order (Customer: Carlos)
            [
                'customer' => 'carlos.mendoza@email.com',
                'status' => 'delivered',
                'payment_status' => 'paid',
                'payment_method' => 'COD',
                'items' => [
                    ['product' => 'Elegant White Lily & Rose Bouquet', 'qty' => 1],
                    ['product' => 'Chocolate Box - Ferrero Rocher (8pcs)', 'qty' => 1, 'is_addon' => true],
                ],
                'notes' => 'Condolence flowers. Delivered with care.',
                'days_ago' => 5,
            ],

            // Order 5: Delivered - Another completed (Customer: Ana)
            [
                'customer' => 'ana.rodriguez@email.com',
                'status' => 'delivered',
                'payment_status' => 'paid',
                'payment_method' => 'GCash',
                'items' => [
                    ['product' => 'Luxury Velvet Box - Red Roses', 'qty' => 1],
                    ['product' => 'Premium Greeting Card', 'qty' => 1, 'is_addon' => true],
                    ['product' => 'Teddy Bear - Small (12")', 'qty' => 1, 'is_addon' => true],
                ],
                'notes' => 'Valentine\'s Day delivery.',
                'days_ago' => 10,
            ],

            // Order 6: Cancelled - Cancelled order (Customer: Brix)
            [
                'customer' => 'brix@customer.com',
                'status' => 'cancelled',
                'payment_status' => 'failed',
                'payment_method' => 'GCash',
                'items' => [
                    ['product' => 'Preserved Eternity Box', 'qty' => 1],
                ],
                'notes' => 'Customer cancelled - changed mind.',
                'days_ago' => 3,
            ],

            // Order 7: Pending - Large corporate order (Customer: Maria)
            [
                'customer' => 'maria.santos@email.com',
                'status' => 'pending',
                'payment_status' => 'pending',
                'payment_method' => 'COD',
                'items' => [
                    ['product' => 'Rustic Mason Jar Wildflowers', 'qty' => 10],
                    ['product' => 'Gift Wrapping - Standard', 'qty' => 10, 'is_addon' => true],
                ],
                'notes' => 'Corporate event - 10 centerpieces needed by Friday.',
                'days_ago' => 0,
            ],

            // Order 8: Processing - Wedding order (Customer: Ydel)
            [
                'customer' => 'ydel@customer.com',
                'status' => 'processing',
                'payment_status' => 'paid',
                'payment_method' => 'GCash',
                'items' => [
                    ['product' => 'Bridal Cascade Bouquet', 'qty' => 1],
                    ['product' => 'Bridesmaid Posy Bouquet', 'qty' => 4],
                    ['product' => 'Gift Wrapping - Premium', 'qty' => 5, 'is_addon' => true],
                ],
                'notes' => 'Wedding package - delivery to venue on March 15.',
                'days_ago' => 7,
            ],
        ];

        foreach ($demoOrders as $index => $orderData) {
            $customer = $customers->firstWhere('email', $orderData['customer']);
            if (!$customer) {
                $this->command->warn("Customer not found: {$orderData['customer']}");
                continue;
            }

            $orderDate = now()->subDays($orderData['days_ago']);
            $shippedAt = in_array($orderData['status'], ['shipped', 'delivered']) ? $orderDate->copy()->addDays(1) : null;
            $deliveredAt = $orderData['status'] === 'delivered' ? $orderDate->copy()->addDays(2) : null;
            $cancelledAt = $orderData['status'] === 'cancelled' ? $orderDate->copy()->addHours(2) : null;

            // Calculate totals
            $subtotal = 0;
            $addonsTotal = 0;
            $orderItems = [];

            foreach ($orderData['items'] as $itemData) {
                if (!empty($itemData['is_addon'])) {
                    $addon = $addons->firstWhere('name', $itemData['product']);
                    if ($addon) {
                        $addonsTotal += $addon->price * $itemData['qty'];
                    }
                } else {
                    $product = $products->firstWhere('name', $itemData['product']);
                    if ($product) {
                        $subtotal += $product->price * $itemData['qty'];
                        $orderItems[] = [
                            'product' => $product,
                            'qty' => $itemData['qty'],
                            'price' => $product->price,
                        ];
                    }
                }
            }

            $totalAmount = $subtotal + $addonsTotal + Setting::get('delivery_fee_standard', 150);

            // Create order
            $order = Order::updateOrCreate(
                ['order_number' => 'DEMO-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT)],
                [
                    'user_id' => $customer->id,
                    'cart_token' => 'demo-' . uniqid(),
                    'total_amount' => $totalAmount,
                    'payment_method' => $orderData['payment_method'],
                    'payment_status' => $orderData['payment_status'],
                    'order_status' => $orderData['status'],
                    'customer_name' => $customer->name,
                    'customer_email' => $customer->email,
                    'customer_phone' => $customer->phone,
                    'contact_number' => $customer->phone,
                    'shipping_address' => '123 Sample Street, Barangay Sample, Tagudin, Ilocos Sur',
                    'city' => 'Tagudin',
                    'zip_code' => '2728',
                    'postal_code' => '2728',
                    'notes' => $orderData['notes'],
                    'addons' => $addonsTotal > 0 ? json_encode(['addons_total' => $addonsTotal]) : null,
                    'addons_total' => $addonsTotal,
                    'created_at' => $orderDate,
                    'updated_at' => $orderDate,
                    'shipped_at' => $shippedAt,
                    'delivered_at' => $deliveredAt,
                    'cancelled_at' => $cancelledAt,
                ]
            );

            // Create order items
            foreach ($orderItems as $item) {
                OrderItem::updateOrCreate(
                    ['order_id' => $order->id, 'product_id' => $item['product']->id],
                    [
                        'product_name' => $item['product']->name,
                        'price' => $item['price'],
                        'quantity' => $item['qty'],
                        'subtotal' => $item['price'] * $item['qty'],
                    ]
                );
            }

            // Reduce stock for non-cancelled orders
            if ($orderData['status'] !== 'cancelled') {
                foreach ($orderItems as $item) {
                    $item['product']->decrement('stock_quantity', $item['qty']);
                }
            }
        }

        $this->command->info('Demo orders seeded: ' . Order::where('order_number', 'like', 'DEMO-%')->count());
        $this->command->table(
            ['Status', 'Count'],
            collect(['pending', 'processing', 'shipped', 'delivered', 'cancelled'])->map(fn($s) => [
                ucfirst($s),
                Order::where('order_status', $s)->where('order_number', 'like', 'DEMO-%')->count()
            ])->toArray()
        );
    }
}