<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->id('id_payment');
            $table->foreignId('id_order')->constrained('orders', 'id_order')->onDelete('cascade');
            $table->decimal('amount_paid', 12, 2)->default(0);
            $table->string('status_payment', 50)->default('pending');
            $table->string('payment_method', 50)->nullable();
            $table->string('payment_gateway', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};
