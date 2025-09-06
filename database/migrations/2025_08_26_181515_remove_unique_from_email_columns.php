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
        Schema::table('buku_tamus', function (Blueprint $table) {
            $table->dropUnique(['email']); // Hapus aturan unik dari tabel buku_tamus
        });

        Schema::table('data_skds', function (Blueprint $table) {
            $table->dropUnique(['email']); // Hapus aturan unik dari tabel data_skds
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('email_columns', function (Blueprint $table) {
            //
        });
    }
};
