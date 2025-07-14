<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('category');
            $table->decimal('price', 10, 2);
            $table->string('suitable_for')->nullable();
            $table->json('features')->nullable();
            $table->json('items')->nullable();
            $table->integer('service_duration')->default(8);
            $table->string('badge')->nullable();
            $table->string('image')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('featured')->default(false);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            $table->index('slug');
            $table->index('category');
            $table->index('status');
            $table->index('featured');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};