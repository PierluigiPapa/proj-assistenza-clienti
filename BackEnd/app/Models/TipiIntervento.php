<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipiIntervento extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipologia',
        'intervento_gratuito',
        'dettagli',
    ];

    protected $table = 'tipi_intervento';

    public function interventi () {
        return $this ->hasMany(Interventi::class, 'ID');
    }
}
