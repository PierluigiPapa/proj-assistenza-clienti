<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SaldoController extends Controller
{
    public function calcolaSaldoTotale()
    {
        $userId = Auth::id();

        // Somma delle ore dalla tabella movimenti_ricarica
        $oreRicarica = DB::table('movimenti_ricarica')
            ->where('IDLogin', $userId)
            ->sum(DB::raw('TIME_TO_SEC(ore)'));

        // Somma delle ore dalla tabella interventi
        $oreInterventi = DB::table('interventi')
            ->where('IDLogin', $userId)
            ->sum(DB::raw('TIME_TO_SEC(TIMEDIFF(ora_fine_intervento, ora_inizio_intervento))'));

        // Calcolo del saldo totale in secondi
        $saldoTotaleSecondi = $oreRicarica - $oreInterventi;

        // Debug: stampa delle variabili per controllo
        error_log("Ore Ricarica: $oreRicarica");
        error_log("Ore Interventi: $oreInterventi");
        error_log("Saldo Totale Secondi: $saldoTotaleSecondi");

        // Conversione del saldo totale in ore, minuti e secondi
        $ore = floor($saldoTotaleSecondi / 3600);
        $minuti = floor(($saldoTotaleSecondi % 3600) / 60);
        $secondi = $saldoTotaleSecondi % 60;

        return sprintf('%02d:%02d:%02d', $ore, $minuti, $secondi);
    }

    public function mostraSaldo()
    {
        $saldoTotale = $this->calcolaSaldoTotale();
        return view('saldo', ['saldoTotale' => $saldoTotale]);
    }
}

