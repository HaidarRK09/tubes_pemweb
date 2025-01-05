<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;
    protected $table = 'reseps'; // Sesuaikan dengan nama tabel di database
    protected $primaryKey = 'id_resep'; // Set primary key

    protected $fillable = [
    'id_resep','id_daftar', 'qty'
    ];

    public function daftar()
    {
        return $this->belongsTo(Daftar::class, 'id_daftar', 'id_daftar');
    }

    public function resep_obat()
    {
        return $this->hasOne(ResepObat::class, 'id_resep', 'id_resep');
    }

    public $incrementing = false;
}
