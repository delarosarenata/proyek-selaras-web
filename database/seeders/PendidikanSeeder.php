<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pendidikans')->insert([
            ['id' => 1, 'nama' => '<= SLTA/Sederajat'],
            ['id' => 2, 'nama' => 'D1/D2/D3'],
            ['id' => 3, 'nama' => 'D4/S1'],
            ['id' => 4, 'nama' => 'S2'],
            ['id' => 5, 'nama' => 'S3'],
        ]);
    }
}
