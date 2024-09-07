<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SaldoController extends Controller
{
    public function aggiornaSaldo(Request $request)
    {
        // Validazione dei dati della richiesta
        $validator = Validator::make($request->all(), [
            'IDLogin' => 'required|integer',
            'saldo' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $userId = Auth::id();

        // Verifica che l'IDLogin passato sia lo stesso dell'utente autenticato
        if ($request->input('IDLogin') != $userId) {
            return response()->json(['error' => 'IDLogin non corrisponde all\'utente autenticato'], 403);
        }

        // Recupera il saldo attuale dalla richiesta e convertilo in secondi
        $saldoAttualeSeconds = DB::select(DB::raw('TIME_TO_SEC(?) as saldo_seconds'), [$request->input('saldo')])[0]->saldo_seconds;

        // Calcola la somma delle ore ricaricate
        $oreRicarica = DB::table('movimenti_ricarica')
            ->where('IDLogin', $userId)
            ->sum(DB::raw('TIME_TO_SEC(ore)'));

        // Calcola la somma totale delle ore ricaricate e aggiungi al saldo attuale
        $nuovoSaldoSeconds = $saldoAttualeSeconds + $oreRicarica;

        // Calcola la somma delle ore degli interventi che devono essere sottratte
        // Considera solo interventi completati dopo l'ultima ricarica
        $ultimoPagamento = DB::table('movimenti_ricarica')
            ->where('IDLogin', $userId)
            ->latest('created_at')
            ->value('created_at');

        if ($ultimoPagamento) {
            $oreInterventi = DB::table('interventi')
                ->where('IDLogin', $userId)
                ->where('data_fine_intervento', '>=', $ultimoPagamento)
                ->sum(DB::raw('TIME_TO_SEC(TIMEDIFF(CONCAT(data_fine_intervento, " ", ora_fine_intervento), CONCAT(data_inizio_intervento, " ", ora_inizio_intervento)))'));
        } else {
            $oreInterventi = 0;
        }

        // Sottrai la durata totale degli interventi
        $nuovoSaldoSeconds -= $oreInterventi;

        // Verifica che il nuovo saldo non superi un limite ragionevole
        if ($nuovoSaldoSeconds > 86400) { // 24 ore in secondi
            Log::warning("Saldo troppo alto per l'utente ID: $userId");
            return response()->json(['error' => 'Saldo non valido'], 400);
        }

        // Verifica che il nuovo saldo non sia negativo
        if ($nuovoSaldoSeconds < 0) {
            Log::warning("Saldo insufficiente per l'utente ID: $userId");
            return response()->json(['error' => 'Saldo insufficiente'], 400);
        }

        // Aggiorna il saldo nella tabella dettagli_conto
        DB::table('dettagli_conto')
            ->where('IDLogin', $userId)
            ->update(['saldo' => gmdate('H:i:s', $nuovoSaldoSeconds)]);

        return response()->json(['success' => 'Saldo aggiornato con successo']);
    }
}

