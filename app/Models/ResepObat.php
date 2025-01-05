<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResepObat extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'resep_obats'; // Sesuaikan dengan nama tabel di database
    protected $primaryKey = ['id_resep','id_obat']; // Set primary key

    protected $fillable = [
    'id_resep','id_obat','qty',
    ];

    public function resep()
    {
        return $this->belongsTo(Resep::class, 'id_resep', 'id_resep');
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat', 'id_obat');
    }

    public $incrementing = false;
}
