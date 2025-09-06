<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KebutuhanData extends Model
{
    // use HasFactory;
    use HasFactory;

    protected $table = 'kebutuhan_data'; // Pastikan nama tabel benar jika tidak plural
    
    protected $fillable = [
        'respondent_id', 'rincian_data', 'wilayah_data', 'tahun_data',
        'level_data', 'periode_data', 'data_diperoleh', 'jenis_sumber_data',
        'judul_sumber_data', 'tahun_publikasi', 'digunakan_perencanaan', 'kualitas_data'
    ];

    // Definisikan casting untuk kolom boolean/integer jika ada
    protected $casts = [
        'digunakan_perencanaan' => 'boolean',
        'kualitas_data' => 'integer',
    ];

    // Definisikan relasi ke tabel Respondent
    public function respondent()
    {
        return $this->belongsTo(Respondent::class);
    }
}
