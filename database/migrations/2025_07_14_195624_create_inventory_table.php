<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_variation_id')->nullable()->constrained()->onDelete('cascade');
            $table->integer('total_quantity');
            $table->integer('available_quantity');
            $table->integer('reserved_quantity')->default(0);
            $table->integer('maintenance_quantity')->default(0);
            $table->string('location')->nullable();
            $table->string('warehouse_section')->nullable();
            $table->date('last_maintenance_date')->nullable();
            $table->date('next_maintenance_date')->nullable();
            $table->enum('status', ['active', 'low_stock', 'out_of_stock', 'discontinued'])->default('active');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['product_id', 'product_variation_id']);
            $table->index('status');
            $table->index('available_quantity');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};