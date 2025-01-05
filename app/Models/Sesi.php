<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_sesi';

    protected $fillable = [
        'id_sesi',
        'hari',
        'jam_mulai',
        'jam_selesai', // Sesuaikan dengan nama kolom di tabel database
        'status',
        'id_poli',
        'nip',
    ];

    // Definisi relasi dengan tabel Poli
    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli', 'id_poli');
    }

    // Definisi relasi dengan tabel Staff
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'nip', 'nip');
    }
    public $incrementing = false; // if the ID is not auto-incrementing
}
