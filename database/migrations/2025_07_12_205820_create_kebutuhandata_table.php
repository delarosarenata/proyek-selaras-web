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
        // Schema::create('kebutuhandata', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });
        Schema::create('kebutuhan_data', function (Blueprint $table) {
            $table->id(); // Primary Key, Auto Increment
            // Foreign Key ke tabel 'respondents'
            // Jika responden dihapus, semua entri kebutuhan_data terkait juga akan dihapus.
            $table->foreignId('respondent_id')->constrained('respondents')->onDelete('cascade');

            // Kolom-kolom untuk BLOK III (Kebutuhan Data)
            $table->string('rincian_data'); // BLOK III.1: Rincian Data (Misal: Indek Pembangunan Manusia)
            $table->string('wilayah_data'); // BLOK III.2: Wilayah Jenis Data
            $table->string('tahun_data'); // BLOK III.3: Tahun Jenis Data (bisa string jika ada rentang tahun, misal "2020-2023")
            // $table->integer('tahun_data2', 4)->nullable();
            $table->enum('level_data', ['Nasional', 'Provinsi', 'Kabupaten/Kota', 'Kecamatan', 'Desa/Kelurahan', 'Individu', 'Lainnya']); // BLOK III.4: Level Data (nasional, provinsi, dll.)
            $table->enum('periode_data', ['Sepuluh tahunan', 'Lima tahunan', 'Tiga tahunan', 'Tahunan', 'Semesteran', 'Triwulanan', 'Bulanan', 'Mingguan', 'Harian', 'Lainnya']); // BLOK III.5: Periode Data (tahunan, bulanan, dll.)
            $table->enum('data_diperoleh', ['Ya, sesuai', 'Ya, tidak sesuai', 'Tidak diperoleh', 'Belum diperoleh']); // BLOK III.6: Apakah data sudah diperoleh?

            // Kolom-kolom ini nullable karena muncul berdasarkan kondisi di BLOK III.6
            $table->enum('jenis_sumber_data', ['Publikasi', 'Data Mikro', 'Peta', 'Tabulasi Data', 'Tabel di Website'])->nullable(); // BLOK III.7: Jenis Publikasi/Sumber Data
            $table->string('judul_sumber_data')->nullable(); // BLOK III.8: Judul Publikasi/Sumber Data
            $table->string('tahun_publikasi', 4)->nullable(); // BLOK III.9: Tahun Publikasi (misal: '2023')
            $table->boolean('digunakan_perencanaan')->nullable(); // BLOK III.10: Digunakan untuk perencanaan pembangunan nasional? (true/false)
            $table->tinyInteger('kualitas_data')->nullable(); // BLOK III.11: Kualitas (penilaian 1-10)

            $table->timestamps(); // created_at dan updated_at otomatis
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kebutuhandata');
    }
};
