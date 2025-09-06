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
        Schema::table('respondents', function (Blueprint $table) {
            $table->foreignId('petugas_id')->nullable()->constrained('petugas');
            $table->string('petugas_lainnya_nama')->nullable();
            $table->tinyInteger('rating')->nullable();
            $table->text('kritik_saran')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('respondents', function (Blueprint $table) {
            //
        });
    }
};
