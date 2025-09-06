<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSkd extends Model
{
    use HasFactory;

    /**
     * Izinkan semua kolom untuk diisi secara massal.
     */
    protected $guarded = [];
}