<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('type'); // Flat, PG, Villa, etc.
            $table->string('address');
            $table->string('city');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->decimal('price_per_month', 12, 2);
            $table->decimal('security_deposit', 12, 2);
            $table->json('amenities')->nullable();
            $table->json('images')->nullable();
            $table->string('status')->default('available'); // available, rented, maintenance
            $table->timestamps();
            $table->softDeletes();

            $table->index('city');
            $table->index('type');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
