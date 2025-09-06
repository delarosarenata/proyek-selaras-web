<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstansiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('instansis')->insert([
            ['id' => 1, 'nama' => 'Lembaga Negara'],
            ['id' => 2, 'nama' => 'Kementerian & Lembaga Pemerintah'],
            ['id' => 3, 'nama' => 'TNI/POLRI/BIN/Kejaksaan'],
            ['id' => 4, 'nama' => 'Pemerintah Daerah'],
            ['id' => 5, 'nama' => 'Lembaga Internasional'],
            ['id' => 6, 'nama' => 'Lembaga Penelitian & Pendidikan'],
            ['id' => 7, 'nama' => 'BUMN/BUMD'],
            ['id' => 8, 'nama' => 'Swasta'],
            ['id' => 9, 'nama' => 'Lainnya'],
        ]);
    }
}
