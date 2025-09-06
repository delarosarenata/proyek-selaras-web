<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pekerjaans')->insert([
            ['id' => 1, 'nama' => 'Pelajar/Mahasiswa'],
            ['id' => 2, 'nama' => 'Peneliti/Dosen'],
            ['id' => 3, 'nama' => 'ASN/TNI/POLRI'],
            ['id' => 4, 'nama' => 'Pegawai BUMN/BUMD'],
            ['id' => 5, 'nama' => 'Pegawai Swasta'],
            ['id' => 6, 'nama' => 'Wiraswasta'],
            ['id' => 7, 'nama' => 'Lainnya'],
        ]);
    }
}
