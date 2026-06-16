<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('customer_name')->nullable()->after('order_status');
            $table->string('customer_email')->nullable()->after('customer_name');
            $table->string('customer_phone')->nullable()->after('customer_email');
            $table->string('city')->nullable()->after('shipping_address');
            $table->string('zip_code')->nullable()->after('city');
            $table->string('postal_code')->nullable()->after('zip_code');
            $table->text('notes')->nullable()->after('postal_code');
            $table->json('addons')->nullable()->after('notes');
            $table->decimal('addons_total', 10, 2)->default(0)->after('addons');
            $table->timestamp('shipped_at')->nullable()->after('addons_total');
            $table->timestamp('delivered_at')->nullable()->after('shipped_at');
            $table->timestamp('cancelled_at')->nullable()->after('delivered_at');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'customer_name',
                'customer_email',
                'customer_phone',
                'city',
                'zip_code',
                'postal_code',
                'notes',
                'addons',
                'addons_total',
                'shipped_at',
                'delivered_at',
                'cancelled_at',
            ]);
        });
    }
};