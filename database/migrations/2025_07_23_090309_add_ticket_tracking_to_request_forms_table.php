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
    Schema::table('request_forms', function (Blueprint $table) {
        if (!Schema::hasColumn('request_forms', 'ticket_code')) {
            $table->string('ticket_code')->unique()->after('id');
        }

        // Hapus baris ini kalau 'status' sudah ada
        // $table->enum('status', ['pending', 'in_progress', 'resolved'])->default('pending')->after('message');
    });
}

public function down()
    {
    Schema::table('request_forms', function (Blueprint $table) {
        $table->dropColumn(['ticket_code', 'status']);
        });
    }
};
