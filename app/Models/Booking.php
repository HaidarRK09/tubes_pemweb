<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_booking';

    protected $fillable = [
        'id_booking',
        'tgl',
        'NIK',
        'id_sesi',
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
