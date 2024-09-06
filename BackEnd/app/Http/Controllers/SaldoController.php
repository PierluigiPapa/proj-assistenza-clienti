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

        // Calcola la somma delle ore ricaricate
        $oreRicarica = DB::table('movimenti_ricarica')
            ->where('IDLogin', $userId)
            ->sum(DB::raw('TIME_TO_SEC(ore)'));

        // Recupera il saldo attuale dalla richiesta
        $saldoAttuale = $request->input('saldo');

        // Converti il saldo attuale in secondi
        $saldoAttualeSeconds = DB::select(DB::raw('TIME_TO_SEC(?)'), [$saldoAttuale])[0]->{'TIME_TO_SEC(saldo)'};

        // Calcola il nuovo saldo in secondi
        $nuovoSaldoSeconds = $saldoAttualeSeconds + $oreRicarica;

        // Verifica che il nuovo saldo non superi un limite ragionevole
        if ($nuovoSaldoSeconds > 86400) { // 24 ore in secondi
            Log::warning("Saldo troppo alto per l'utente ID: $userId");
            return response()->json(['error' => 'Saldo non valido'], 400);
        }

        // Aggiorna il saldo nella tabella dettagli_conto
        DB::table('dettagli_conto')
            ->where('IDLogin', $userId)
            ->update(['saldo' => gmdate('H:i:s', $nuovoSaldoSeconds)]);

        return response()->json(['success' => 'Saldo aggiornato con successo']);
    }
}
