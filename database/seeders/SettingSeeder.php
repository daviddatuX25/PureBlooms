<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $settings = [
            // General Settings
            ['key' => 'shop_name', 'value' => 'PureBlooms', 'type' => 'string', 'group' => 'general'],
            ['key' => 'shop_tagline', 'value' => 'Fresh Flowers Delivered with Love', 'type' => 'string', 'group' => 'general'],
            ['key' => 'shop_email', 'value' => 'hello@pureblooms.com', 'type' => 'string', 'group' => 'general'],
            ['key' => 'shop_phone', 'value' => '+63 917 123 4567', 'type' => 'string', 'group' => 'general'],
            ['key' => 'shop_address', 'value' => '123 Flower Street, Tagudin, Ilocos Sur', 'type' => 'string', 'group' => 'general'],
            ['key' => 'shop_description', 'value' => 'Your trusted local flower shop delivering fresh, beautiful arrangements for every occasion. We believe flowers speak the language of the heart.', 'type' => 'string', 'group' => 'general'],
            ['key' => 'currency_symbol', 'value' => '₱', 'type' => 'string', 'group' => 'general'],
            ['key' => 'maintenance_mode', 'value' => '0', 'type' => 'boolean', 'group' => 'general'],

            // Delivery Settings
            ['key' => 'delivery_fee_standard', 'value' => '150.00', 'type' => 'float', 'group' => 'delivery'],
            ['key' => 'delivery_fee_express', 'value' => '300.00', 'type' => 'float', 'group' => 'delivery'],
            ['key' => 'free_delivery_threshold', 'value' => '3000.00', 'type' => 'float', 'group' => 'delivery'],
            ['key' => 'delivery_areas', 'value' => json_encode(['Tagudin', 'Candon', 'Vigan', 'Santa Cruz', 'Narvacan']), 'type' => 'array', 'group' => 'delivery'],
            ['key' => 'cutoff_time_same_day', 'value' => '12:00', 'type' => 'string', 'group' => 'delivery'],
            ['key' => 'delivery_schedule', 'value' => json_encode(['Monday' => '9:00-17:00', 'Tuesday' => '9:00-17:00', 'Wednesday' => '9:00-17:00', 'Thursday' => '9:00-17:00', 'Friday' => '9:00-17:00', 'Saturday' => '9:00-15:00', 'Sunday' => 'Closed']), 'type' => 'array', 'group' => 'delivery'],

            // Payment Settings
            ['key' => 'cod_enabled', 'value' => '1', 'type' => 'boolean', 'group' => 'payment'],
            ['key' => 'gcash_enabled', 'value' => '1', 'type' => 'boolean', 'group' => 'payment'],
            ['key' => 'gcash_number', 'value' => '09171234567', 'type' => 'string', 'group' => 'payment'],
            ['key' => 'gcash_name', 'value' => 'PureBlooms Flower Shop', 'type' => 'string', 'group' => 'payment'],

            // Order Settings
            ['key' => 'order_prefix', 'value' => 'PB', 'type' => 'string', 'group' => 'orders'],
            ['key' => 'auto_confirm_orders', 'value' => '0', 'type' => 'boolean', 'group' => 'orders'],
            ['key' => 'order_cancellation_hours', 'value' => '24', 'type' => 'integer', 'group' => 'orders'],
            ['key' => 'low_stock_threshold', 'value' => '5', 'type' => 'integer', 'group' => 'orders'],

            // Email/SMS Settings
            ['key' => 'email_notifications_enabled', 'value' => '1', 'type' => 'boolean', 'group' => 'notifications'],
            ['key' => 'sms_notifications_enabled', 'value' => '0', 'type' => 'boolean', 'group' => 'notifications'],
            ['key' => 'admin_order_notification_email', 'value' => 'admin@pureblooms.com', 'type' => 'string', 'group' => 'notifications'],

            // SEO / Social
            ['key' => 'meta_title', 'value' => 'PureBlooms - Fresh Flowers & Gift Delivery', 'type' => 'string', 'group' => 'seo'],
            ['key' => 'meta_description', 'value' => 'Order fresh flowers online for delivery in Ilocos Sur. Bouquets, arrangements, plants, and gifts for every occasion.', 'type' => 'string', 'group' => 'seo'],
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/pureblooms', 'type' => 'string', 'group' => 'seo'],
            ['key' => 'instagram_url', 'value' => 'https://instagram.com/pureblooms', 'type' => 'string', 'group' => 'seo'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        $this->command->info('Settings seeded: ' . Setting::count());
    }
}