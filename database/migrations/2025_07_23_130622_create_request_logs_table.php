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
    Schema::create('ticket_progresses', function (Blueprint $table) {
        $table->id();
        $table->foreignId('request_form_id')->constrained()->onDelete('cascade');
        $table->string('status'); // pending, in_progress, resolved
        $table->text('note')->nullable(); // catatan tambahan
        $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_logs');
    }
};
