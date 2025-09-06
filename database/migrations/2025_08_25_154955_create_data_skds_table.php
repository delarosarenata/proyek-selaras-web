<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::create('data_skds', function (Blueprint $table) {
    //         $table->id();
    //         $table->timestamps();
    //     });
    // }

    // database/migrations/xxxx_create_data_skds_table.php

    public function up(): void
    {
        Schema::create('data_skds', function (Blueprint $table) {
            $table->id();
            $table->string('kategori')->nullable();          // Kolom 1: Kategori
            $table->string('nama')->nullable();              // Kolom 2: Nama
            $table->string('nomor_hp')->nullable();          // Kolom 3: No. HP
            $table->string('email')->unique()->nullable();   // Kolom 4: Email (dibuat unik)
            $table->string('nama_instansi')->nullable();     // Kolom 5: Nama Instansi
            $table->string('blok_1')->nullable();            // Kolom 6: BLOK 1 (Simbol centang/silang)
            $table->string('blok_2')->nullable();            // Kolom 7: BLOK 2
            $table->string('blok_3')->nullable();            // Kolom 8: BLOK 3
            $table->string('blok_4')->nullable();            // Kolom 9: BLOK 4
            $table->date('tanggal_cacah')->nullable();       // Kolom 10: Tanggal Cacah
            // Kolom '#' dan 'Aksi' tidak perlu kita simpan karena tidak relevan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_skds');
    }
};
