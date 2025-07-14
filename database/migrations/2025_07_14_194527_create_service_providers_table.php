<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_providers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('stage_name')->nullable();
            $table->text('bio')->nullable();
            $table->text('short_description')->nullable();
            $table->decimal('base_price', 10, 2);
            $table->string('price_unit')->default('event');
            $table->json('features')->nullable();
            $table->string('experience_level')->nullable();
            $table->integer('years_experience')->default(0);
            $table->json('languages')->nullable();
            $table->json('specialties')->nullable();
            $table->json('equipment_owned')->nullable();
            $table->boolean('equipment_provided')->default(false);
            $table->integer('min_booking_hours')->default(1);
            $table->integer('max_booking_hours')->nullable();
            $table->json('availability')->nullable();
            $table->json('portfolio_links')->nullable();
            $table->decimal('rating', 3, 2)->default(0.00);
            $table->integer('total_reviews')->default(0);
            $table->integer('total_bookings')->default(0);
            $table->string('badge')->nullable();
            $table->string('badge_class')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('featured')->default(false);
            $table->enum('status', ['active', 'inactive', 'on_leave'])->default('active');
            $table->timestamps();

            $table->index('service_category_id');
            $table->index('slug');
            $table->index('status');
            $table->index('featured');
            $table->index('experience_level');
            $table->index('rating');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_providers');
    }
};