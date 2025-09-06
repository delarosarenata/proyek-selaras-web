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
    //     Schema::create('buku_tamus', function (Blueprint $table) {
    //         $table->id();
    //         $table->timestamps();
    //     });
    // }

    // database/migrations/xxxx_create_buku_tamus_table.php

    public function up(): void
    {
        Schema::create('buku_tamus', function (Blueprint $table) {
            $table->id();
            $table->timestamp('timestamp')->nullable();                     // Kolom 1: Timestamp
            $table->string('nama_lengkap')->nullable();                     // Kolom 2: Nama Lengkap
            $table->string('nomor_hp')->nullable();                         // Kolom 3: Nomor Ponsel/Whatsapp
            $table->string('email')->unique()->nullable();                  // Kolom 4: Email (dibuat unik)
            $table->string('jenis_kelamin')->nullable();                    // Kolom 5: Jenis Kelamin
            $table->string('tempat_lahir')->nullable();                     // Kolom 6: Tempat Lahir
            $table->date('tanggal_lahir')->nullable();                      // Kolom 7: Tanggal Lahir
            $table->string('profesi')->nullable();                          // Kolom 8: Profesi Pekerjaan
            $table->text('deskripsi_pekerjaan')->nullable();                // Kolom 9: Deskripsikan Pekerjaan Anda
            $table->string('pendidikan')->nullable();                       // Kolom 10: Pendidikan Terakhir
            $table->string('layanan_dibutuhkan')->nullable();               // Kolom 11: Layanan yang Anda butuhkan
            $table->text('detail_layanan')->nullable();                     // Kolom 12: Tuliskan dengan jelas...
            $table->string('pemanfaatan')->nullable();                      // Kolom 13: Pemanfaatan hasil...
            $table->date('tanggal_layanan')->nullable();                    // Kolom 14: Tanggal memperoleh layanan...
            $table->string('sarana')->nullable();                           // Kolom 15: Sarana yang digunakan...
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku_tamus');
    }
};
