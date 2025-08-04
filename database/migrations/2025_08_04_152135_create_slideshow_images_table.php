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
    Schema::create('slideshow_images', function (Blueprint $table) {
        $table->id();
        $table->string('image_path'); // Menyimpan path file gambar
        $table->boolean('is_active')->default(true); // Untuk mengaktifkan/menonaktifkan gambar
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slideshow_images');
    }
};
