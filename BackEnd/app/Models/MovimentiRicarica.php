<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimentiRicarica extends Model
{
    use HasFactory;

    protected $table = 'movimenti_ricarica';

    protected $fillable = [
        'IDOpzioneRicarica',
        'IDLogin',
        'data',
        'ore',
        'paypal_orderid',
    ];

    public function login () {
        return $this->belongsTo(Login::class, 'IDLogin');
    }

    public function opzioniRicarica() {
        return $this->belongsTo(OpzioniRicarica::class, 'IDOpzioneRicarica');
    }

    public function getOpzioneRicaricaLabelAttribute()
    {
        $opzioni = [
        1 => 'Ricarica Base',
        2 => 'Ricarica Standard',
        3 => 'Ricarica Premium',
        4 => 'Ricarica Elite',
    ];

    return $opzioni[$this->IDOpzioneRicarica] ?? 'Opzione sconosciuta';
}

}
