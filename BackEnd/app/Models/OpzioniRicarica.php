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
    ];

    public function MovimentiRicarica() {
        return $this->hasMany(MovimentiRicarica::class, 'IDOpzioneRicarica');
    }

    protected $table = 'opzioni_ricarica';

}
