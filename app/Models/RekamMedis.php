<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    use HasFactory;
    protected $table = 'rekam_mediss'; // Sesuaikan dengan nama tabel di database
    protected $primaryKey = 'id_rmedis'; // Set primary key

    protected $fillable = [
    'id_rmedis','tgl_berobat', 'penyakit', 'sistolik', 'diastolik', 'NIK', 'status', 'tempat_rujuk' , 'anamnesa'
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'NIK', 'NIK');
    }

    public $incrementing = false;
}
