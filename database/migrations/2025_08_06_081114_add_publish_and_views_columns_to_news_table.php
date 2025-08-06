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
        Schema::table('news', function (Blueprint $table) {
            // Tambahkan kolom untuk status publish setelah kolom 'content'
            $table->boolean('is_published')->default(true)->after('content');
            
            // Tambahkan kolom untuk menghitung views setelah 'is_published'
            $table->unsignedBigInteger('views')->default(0)->after('is_published');
        });
    }

    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            // Perintah untuk menghapus kolom jika migrasi di-rollback
            $table->dropColumn(['is_published', 'views']);
        });
    }
};
