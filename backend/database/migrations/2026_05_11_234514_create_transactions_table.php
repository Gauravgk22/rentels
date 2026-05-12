<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wallet_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->string('type'); // deposit, withdrawal, payment, refund
            $table->string('status')->default('pending'); // pending, completed, failed
            $table->string('reference_type')->nullable(); // booking, external_payment
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->text('description')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['reference_type', 'reference_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
