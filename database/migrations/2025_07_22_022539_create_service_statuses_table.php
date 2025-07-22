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
    Schema::create('service_statuses', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Contoh: Email, WiFi, Sistem Akademik
        $table->string('status'); // Pilihan: Normal, Gangguan, Pemeliharaan
        $table->text('description')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_statuses');
    }
};
