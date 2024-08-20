<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'password',
        'nome',
        'cognome',
        'admin'
    ];

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
