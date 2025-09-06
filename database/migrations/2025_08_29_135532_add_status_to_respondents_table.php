<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('respondents', function (Blueprint $table) {
            // TAMBAHKAN BARIS INI
            $table->enum('status', ['pending', 'sukses', 'gagal'])
                  ->default('pending')
                  ->after('catatan'); // Letakkan setelah kolom 'catatan'
        });
    }

    public function down(): void
    {
        Schema::table('respondents', function (Blueprint $table) {
            $table->dropColumn('status'); // Untuk rollback jika diperlukan
        });
    }
};