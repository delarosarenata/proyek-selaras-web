<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 1. Tambahkan kolom username setelah 'name' dan buat unik
            $table->string('username')->unique()->after('name');

            // 2. Buat kolom email menjadi boleh kosong (opsional)
            $table->string('email')->nullable()->change();

            // 3. Hapus kolom email_verified_at yang tidak kita perlukan
            // $table->dropColumn('email_verified_at');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->string('email')->nullable(false)->change();
            // $table->timestamp('email_verified_at')->nullable();
        });
    }
};