<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
            $table->string('make');
            $table->string('model');
            $table->string('year');
            $table->string('type'); // Car, Bike, EV, etc.
            $table->string('registration_number')->unique();
            $table->decimal('price_per_day', 10, 2);
            $table->decimal('price_per_hour', 10, 2)->nullable();
            $table->json('features')->nullable();
            $table->json('images')->nullable();
            $table->string('status')->default('available'); // available, booked, maintenance, inactive
            $table->string('current_location_name')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('type');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
