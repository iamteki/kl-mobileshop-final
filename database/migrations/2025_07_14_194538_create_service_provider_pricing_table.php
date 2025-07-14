<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_provider_pricing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_provider_id')->constrained()->onDelete('cascade');
            $table->string('tier_name');
            $table->decimal('price', 10, 2);
            $table->string('duration');
            $table->json('included_features')->nullable();
            $table->json('additional_costs')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_popular')->default(false);
            $table->timestamps();

            $table->index('service_provider_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_provider_pricing');
    }
};