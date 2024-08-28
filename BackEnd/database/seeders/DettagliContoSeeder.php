<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DettagliContoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dettagli_conto')->insert([
            [
                'IDLogin' => 1,
                'saldo' => '12:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'IDLogin' => 2,
                'saldo' => '14:45:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
