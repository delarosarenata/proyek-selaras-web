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
            $table->timestamp('run_request')->nullable()->after('status'); // atau after('status_entri') kalau itu nama kolommu
        });
    }

    public function down(): void
    {
        Schema::table('respondents', function (Blueprint $table) {
            $table->dropColumn('run_request');
        });
    }

};
