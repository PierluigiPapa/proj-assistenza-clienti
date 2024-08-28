<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DettagliConto extends Model
{
    use HasFactory;

    protected $table = 'dettagli_conto';

    protected $fillable = [
        'IDLogin',
        'saldo',
    ];

    public function login () {
        return $this->belongsTo(Login::class, 'IDLogin');
    }
}
