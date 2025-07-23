<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name', 100); // Nama Pengirim
            $table->string('email');     // Email Pengirim
            $table->text('message');     // Isi Pesan
            $table->enum('status', ['pending', 'responded'])->default('pending'); // Status
            $table->boolean('is_admin')->default(false); // Menandai apakah pesan dari admin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
