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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id('id_menu');
            $table->foreignId('id_categories')->constrained('categories', 'id_categories')->onDelete('cascade');
            $table->string('name_menu', 100);
            $table->decimal('modal', 12, 2)->default(0);
            $table->decimal('price', 12, 2)->default(0);
            $table->integer('stok')->default(0);
            $table->string('imgae_url')->nullable();
            $table->text('description')->nullable();
            $table->string('status', 50)->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
