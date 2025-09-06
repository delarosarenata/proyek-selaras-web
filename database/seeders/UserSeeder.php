<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama agar tidak duplikat
        User::truncate();

        // Buat 1 Admin
        User::create([
            'name' => 'Admin Supervisor',
            'username' => 'admin',
            'email' => null,
            'password' => Hash::make('password'), // Passwordnya adalah "password"
            'role' => 'admin',
        ]);

        // Buat 1 Petugas
        User::create([
            'name' => 'Petugas PST',
            'username' => 'petugas',
            'email' => null,
            'password' => Hash::make('password'), // Passwordnya adalah "password"
            'role' => 'petugas',
        ]);
    }
}