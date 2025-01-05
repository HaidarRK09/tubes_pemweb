<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_poli';

    protected $fillable = [
        'id_poli',
        'nama',
    ];

    public function sesi()
    {
        return $this->hasMany(Sesi::class, 'id_poli', 'id_poli');
    }
}
