<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Pasien extends Model  implements AuthenticatableContract
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'NIK',
        'password',
        'nama',
        'nobpjs',
        'notlp',
        'email',
        'email_verified_at',
        'alamat',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'NIK';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $table = 'pasiens';

    public function getAuthIdentifierName()
    {
        return 'NIK';
    }

    public function getAuthIdentifier()
    {
        return $this->attributes['NIK'];
    }

    public function getAuthPassword()
    {
        return $this->attributes['password'];
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }
    
    public function rekam_medis()
    {
        return $this->hasOne(RekamMedis::class, 'NIK', 'NIK');
    }
}
