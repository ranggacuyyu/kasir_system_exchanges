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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('id_order');
            $table->foreignId('id_user')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('id_customer')->nullable()->constrained('customers', 'id_customer')->onDelete('set null');
            $table->string('payment_code', 50)->unique()->nullable();
            $table->string('table_number', 20)->nullable();
            $table->string('order_type', 50)->default('dine_in'); // dine_in, take_away, delivery
            $table->string('order_source', 50)->default('pos');
            $table->string('status', 50)->default('pending');
            $table->decimal('tax', 12, 2)->default(0);
            $table->decimal('total', 12, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
