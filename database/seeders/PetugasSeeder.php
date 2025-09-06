<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Petugas; // <-- Jangan lupa import

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Petugas::create([
            'nama' => 'Fajar',
            'path_foto' => 'fotos_petugas/Fajar.png',
        ]);

        Petugas::create([
            'nama' => 'Indah',
            'path_foto' => 'fotos_petugas/Indah.png',
        ]);

        Petugas::create([
            'nama' => 'Ismail',
            'path_foto' => 'fotos_petugas/Ismail.png',
        ]);

        Petugas::create([
            'nama' => 'Izza',
            'path_foto' => 'fotos_petugas/Izza.png',
        ]);

        Petugas::create([
            'nama' => 'Kiki',
            'path_foto' => 'fotos_petugas/Kiki.png',
        ]);

        Petugas::create([
            'nama' => 'Naja',
            'path_foto' => 'fotos_petugas/Naja.png',
        ]);

        Petugas::create([
            'nama' => 'Renata',
            'path_foto' => 'fotos_petugas/Renata.png',
        ]);

        Petugas::create([
            'nama' => 'Taslim',
            'path_foto' => 'fotos_petugas/Taslim.png',
        ]);

        Petugas::create([
            'nama' => 'Thomi',
            'path_foto' => 'fotos_petugas/Thomi.png',
        ]);

        Petugas::create([
            'nama' => 'Winda',
            'path_foto' => 'fotos_petugas/Winda.png',
        ]);

        Petugas::create([
            'nama' => 'Zidan',
            'path_foto' => 'fotos_petugas/Zidan.png',
        ]);

        Petugas::create([
            'nama' => 'Zifah',
            'path_foto' => 'fotos_petugas/Zifah.png',
        ]);
    }
}
