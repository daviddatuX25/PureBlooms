<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use App\Models\User;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $statuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
        $paymentMethods = ['COD', 'GCash'];
        $paymentStatuses = ['pending', 'paid', 'failed'];

        $orderStatus = fake()->randomElement($statuses);
        $paymentMethod = fake()->randomElement($paymentMethods);
        $paymentStatus = $orderStatus === 'delivered' ? 'paid' : fake()->randomElement($paymentStatuses);

        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'order_number' => Order::generateOrderNumber(),
            'cart_token' => fake()->sha256(),
            'total_amount' => fake()->randomFloat(2, 200, 10000),
            'payment_method' => $paymentMethod,
            'payment_status' => $paymentStatus,
            'order_status' => $orderStatus,
            'customer_name' => fake()->name(),
            'customer_email' => fake()->safeEmail(),
            'customer_phone' => fake()->phoneNumber(),
            'shipping_address' => fake()->address(),
            'city' => fake()->city(),
            'zip_code' => fake()->postcode(),
            'postal_code' => fake()->postcode(),
            'notes' => fake()->optional()->sentence(),
            'addons' => null,
            'addons_total' => 0,
            'shipped_at' => in_array($orderStatus, ['shipped', 'delivered']) ? fake()->dateTimeBetween('-30 days', 'now') : null,
            'delivered_at' => $orderStatus === 'delivered' ? fake()->dateTimeBetween('-10 days', 'now') : null,
            'cancelled_at' => $orderStatus === 'cancelled' ? fake()->dateTimeBetween('-30 days', 'now') : null,
        ];
    }
}