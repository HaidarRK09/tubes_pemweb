<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daftar extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_daftar';

    protected $fillable = [
        'id_daftar',
        'tgl',
        'id_booking',
        'NIK',
        'id_sesi',
        'antrian',
        'status',   
    ];

    // Definisi relasi dengan tabel Poli
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'NIK', 'NIK');
    }

    // Definisi relasi dengan tabel Staff
    public function sesi()
    {
        return $this->belongsTo(Sesi::class, 'id_sesi', 'id_sesi');
    }

    public $incrementing = false; // if the ID is not auto-incrementing
}
