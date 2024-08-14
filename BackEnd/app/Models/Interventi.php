<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interventi extends Model
{
    use HasFactory;

    protected $fillable = [
        'NomeIntervento',
        'IDLogin',
        'data_inizio_intervento',
        'data_fine_intervento',
        'ora_inizio_intervento',
        'ora_fine_intervento',
    ];

    public function login () {
        return $this->belongsTo(Login::class, 'IDLogin');
    }

    public function tipiIntervento () {
        return $this ->hasOne(tipiIntervento::class, 'ID');
    }
}
