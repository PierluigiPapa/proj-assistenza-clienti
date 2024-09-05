<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Login extends Model implements AuthenticatableContract
{
    use HasFactory, HasApiTokens, Authenticatable;

    protected $table = 'login';

    protected $fillable = [
        'username',
        'password',
        'nome',
        'cognome',
        'admin'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isAdmin()
    {
        return $this->admin;
    }


    public function dettagliConto()
    {
        return $this->hasOne(DettagliConto::class, 'IDLogin');
    }

    public function interventi()
    {
        return $this->hasMany(Interventi::class, 'IDLogin');
    }

    public function movimentiRicarica()
    {
        return $this->hasMany(MovimentiRicarica::class, 'IDLogin');
    }
}

