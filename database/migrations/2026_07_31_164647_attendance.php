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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id('id_attendance');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_schedule')->nullable()->constrained('schedules', 'id_schedule')->onDelete('set null');
            $table->timestamp('check_in')->nullable();
            $table->timestamp('check_out')->nullable();
            $table->integer('late_minute')->default(0);
            $table->string('overtime', 50)->nullable();
            $table->string('status', 50)->default('present');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};

