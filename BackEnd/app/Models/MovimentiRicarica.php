<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimentiRicarica extends Model
{
    use HasFactory;

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
}
