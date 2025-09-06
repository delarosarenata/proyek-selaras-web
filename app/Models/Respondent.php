<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respondent extends Model
{
    use HasFactory;

    protected $guarded  = [
        // 'unique_token', // <-- Tambahkan ini
        // 'nama',
        // 'email',
        // 'no_hp',
        // 'jenis_kelamin',
        // 'pendidikan_id',
        // 'pekerjaan_id',
        // 'instansi_id',
        // 'pemanfaatan_id',
        // 'pekerjaan_lainnya',
        // 'instansi_lainnya',
        // 'pemanfaatan_lainnya',
        // 'nama_instansi',
        // 'jenis_layanan',
        // 'sarana_digunakan',
        // 'sarana_lainnya',
        // 'pernah_pengaduan',
        // 'penilaian',
        // 'kebutuhan_data',
        // 'catatan',

        // --- PASTIKAN 'unique_token' ADA DI SINI ---
        // 'unique_token' 
    ];

    protected $with = ['petugas'];

    protected $casts = [
        'jenis_layanan' => 'array',
        'sarana_digunakan' => 'array',
        'penilaian' => 'array',
        'kebutuhan_data' => 'array',
    ];

    // app/Models/Respondent.php
    public function petugas()
    {
        return $this->belongsTo(Petugas::class);
    }

    public function getRouteKeyName()
    {
        return 'unique_token';
    }

    
}
