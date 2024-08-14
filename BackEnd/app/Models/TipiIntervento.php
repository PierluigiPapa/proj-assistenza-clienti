<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipiIntervento extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipologia',
        'dettagli',
    ];

    public function interventi () {
        return $this ->hasMany(Interventi::class, 'ID');
    }
}
