<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpzioniRicarica extends Model
{
    use HasFactory;

    protected $fillable = [
        'descrizione',
        'costo',
        'ore',
        'admin',
    ];

    public function MovimentiRicarica() {
        return $this->hasMany(MovimentiRicarica::class, 'IDOpzioneRicarica');
    }
}
