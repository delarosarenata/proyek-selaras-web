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
        Schema::create('respondents', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('no_hp');
            $table->string('jenis_kelamin');
            $table->unsignedBigInteger('pendidikan_id');
            $table->unsignedBigInteger('pekerjaan_id');
            $table->unsignedBigInteger('instansi_id');
            $table->unsignedBigInteger('pemanfaatan_id');
            $table->string('pekerjaan_lainnya')->nullable();
            $table->string('instansi_lainnya')->nullable();
            $table->string('pemanfaatan_lainnya')->nullable();
            $table->string('nama_instansi');
            $table->json('jenis_layanan');
            $table->json('sarana_digunakan');
            $table->string('sarana_lainnya')->nullable();
            $table->string('pernah_pengaduan');
            $table->json('penilaian')->nullable();
            $table->json('kebutuhan_data')->nullable();
            $table->text('catatan')->nullable();
            // --- Atribut Tambahan ---
            // $table->enum('status_pengisian', ['in_progress', 'completed'])->default('in_progress');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respondents');
    }
};
