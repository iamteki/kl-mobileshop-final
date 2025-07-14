<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booking_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->enum('item_type', ['product', 'service', 'service_provider', 'package'])->default('product');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('service_provider_id')->nullable();
            $table->unsignedBigInteger('service_provider_pricing_id')->nullable();
            $table->string('item_name');
            $table->string('item_sku')->nullable();
            $table->foreignId('product_variation_id')->nullable()->constrained();
            $table->string('variation_name')->nullable();
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->integer('rental_days');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->json('selected_addons')->nullable();
            $table->decimal('addons_price', 10, 2)->default(0.00);
            $table->enum('status', ['pending', 'confirmed', 'delivered', 'returned', 'damaged', 'lost'])->default('pending');
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('returned_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index('booking_id');
            $table->index(['item_type', 'item_id']);
            $table->index('status');
            $table->index('service_provider_id');
            $table->index('service_provider_pricing_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_items');
    }
};