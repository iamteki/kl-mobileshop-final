<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_provider_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_provider_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->integer('rating');
            $table->string('title')->nullable();
            $table->text('comment')->nullable();
            $table->json('ratings_breakdown')->nullable();
            $table->boolean('verified_booking')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();

            $table->index('service_provider_id');
            $table->index('customer_id');
            $table->index('status');
            $table->index('rating');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_provider_reviews');
    }
};