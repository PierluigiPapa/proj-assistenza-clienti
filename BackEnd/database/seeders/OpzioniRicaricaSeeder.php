<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OpzioniRicaricaSeeder extends Seeder
{
    public function run()
    {
        DB::table('opzioni_ricarica')->insert([
            [
                'descrizione' => 'Ricarica Base',
                'costo' => 5.00,
                'ore' => '06:00:00',
            ],
            [
                'descrizione' => 'Ricarica Standard',
                'costo' => 10.00,
                'ore' => '12:00:00',
            ],
            [
                'descrizione' => 'Ricarica Avanzata',
                'costo' => 20.00,
                'ore' => '24:00:00',
            ],
            [
                'descrizione' => 'Ricarica Elite',
                'costo' => 50.00,
                'ore' => '48:00:00',
            ]
        ]);
    }
}

