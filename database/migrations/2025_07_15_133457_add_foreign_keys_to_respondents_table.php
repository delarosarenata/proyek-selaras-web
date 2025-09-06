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
        // Kita modifikasi tabel 'respondents' yang sudah ada
        Schema::table('respondents', function (Blueprint $table) {
            // Buat sambungan untuk setiap foreign key
            $table->foreign('pendidikan_id')->references('id')->on('pendidikans')->onDelete('cascade');
            $table->foreign('pekerjaan_id')->references('id')->on('pekerjaans')->onDelete('cascade');
            $table->foreign('instansi_id')->references('id')->on('instansis')->onDelete('cascade');
            $table->foreign('pemanfaatan_id')->references('id')->on('pemanfaatans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('respondents', function (Blueprint $table) {
            // Hapus sambungan jika migrasi di-rollback
            $table->dropForeign(['pendidikan_id']);
            $table->dropForeign(['pekerjaan_id']);
            $table->dropForeign(['instansi_id']);
            $table->dropForeign(['pemanfaatan_id']);
        });
    }
};
