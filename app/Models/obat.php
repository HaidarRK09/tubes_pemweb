<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $primaryKey = 'id_obat';

    protected $fillable = [
        'id_obat',
        'nama',
        'merk',
        'deskripsi',
        'harga',
        'qty',
        'uom',
    ];

    public $incrementing = false; // if the ID is not auto-incrementing
}