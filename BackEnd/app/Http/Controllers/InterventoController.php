<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interventi;
use App\Models\Login;
use App\Models\TipiIntervento;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InterventoController extends Controller
{
    public function store(Request $request)
    {
        // Log per debugging
        \Log::info('Richiesta ricevuta:', $request->all());

        // Validazione dei dati
        $validated = $request->validate([
            'IDLogin' => 'required|exists:login,id',
            'IDIntervento' => 'required|exists:tipi_intervento,id',
            'data_inizio_intervento' => 'required|date',
            'ora_inizio_intervento' => 'required|date_format:H:i',
            'data_fine_intervento' => 'required|date|after_or_equal:data_inizio_intervento',
            'ora_fine_intervento' => 'required|date_format:H:i',
        ]);

        // Ottieni i dati dal form
        $userId = $request->input('IDLogin');
        $interventoId = $request->input('IDIntervento');
        $dataInizio = $request->input('data_inizio_intervento');
        $oraInizio = $request->input('ora_inizio_intervento');
        $dataFine = $request->input('data_fine_intervento');
        $oraFine = $request->input('ora_fine_intervento');

        // Calcola la durata dell'intervento
        $start = new \DateTime("$dataInizio $oraInizio");
        $end = new \DateTime("$dataFine $oraFine");
        $interval = $start->diff($end);

        // Converti la durata in secondi
        $durataInSecondi = ($interval->days * 24 * 60 * 60) + ($interval->h * 60 * 60) + ($interval->i * 60) + $interval->s;

        // Recupera il tipo di intervento
        $tipoIntervento = TipiIntervento::find($interventoId);

        // Verifica se l'intervento è gratuito
        if ($tipoIntervento->intervento_gratuito == 1) { // Intervento a pagamento
            // Recupera il saldo attuale dell'utente
            $saldoAttuale = DB::table('dettagli_conto')
                ->select(DB::raw('TIME_TO_SEC(saldo) as saldo_seconds'))
                ->where('IDLogin', $userId)
                ->value('saldo_seconds');

            // Verifica che il saldo attuale sia stato trovato
            if ($saldoAttuale === null) {
                Log::warning("Saldo non trovato per l'utente ID: $userId");
                return response()->json(['error' => 'Saldo non trovato'], 404);
            }

            // Sottrai la durata dell'intervento dal saldo
            $nuovoSaldoSeconds = $saldoAttuale - $durataInSecondi;

            // Verifica che il nuovo saldo non sia negativo
            if ($nuovoSaldoSeconds < 0) {
                Log::warning("Saldo insufficiente per l'utente ID: $userId");
                return response()->json(['error' => 'Saldo insufficiente'], 400);
            }

            // Aggiorna il saldo nella tabella dettagli_conto
            DB::table('dettagli_conto')
                ->where('IDLogin', $userId)
                ->update(['saldo' => gmdate('H:i:s', $nuovoSaldoSeconds)]);
        }

        // Crea un nuovo intervento
        $intervento = new Interventi();
        $intervento->IDLogin = $userId;
        $intervento->IDIntervento = $interventoId;
        $intervento->data_inizio_intervento = $dataInizio;
        $intervento->ora_inizio_intervento = $oraInizio;
        $intervento->data_fine_intervento = $dataFine;
        $intervento->ora_fine_intervento = $oraFine;
        $intervento->save();

        // Log per debugging
        \Log::info('Intervento salvato:', $intervento->toArray());
        return response()->json(['message' => 'Intervento salvato e saldo aggiornato con successo.']);
    }

    public function create()
    {
        // Recupera tutti gli utenti e tipi di intervento dal database
        $users = Login::all();
        $tipiIntervento = TipiIntervento::all();

        // Ritorna la vista con la lista degli utenti e tipi di intervento
        return view('intervento.create', compact('users', 'tipiIntervento'));
    }
}



