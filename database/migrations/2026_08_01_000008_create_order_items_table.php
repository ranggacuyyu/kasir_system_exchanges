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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id('id_order_items');
            $table->foreignId('id_order')->constrained('orders', 'id_order')->onDelete('cascade');
            $table->foreignId('id_menu')->constrained('menu_items', 'id_menu')->onDelete('cascade');
            $table->integer('quantity');
            $table->string('change_type', 50)->nullable();
            $table->decimal('total', 12, 2)->default(0);
            $table->enum('drink_status', ['baru', 'proses', 'selesai'])->default('baru');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
