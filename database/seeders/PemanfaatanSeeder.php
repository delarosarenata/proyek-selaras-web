<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PemanfaatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pemanfaatans')->insert([
            ['id' => 1, 'nama' => 'Tugas Sekolah/Tugas Kuliah'],
            ['id' => 2, 'nama' => 'Pemerintahan'],
            ['id' => 3, 'nama' => 'Komersial'],
            ['id' => 4, 'nama' => 'Penelitian'],
            ['id' => 5, 'nama' => 'Lainnya'],
        ]);
    }
}
