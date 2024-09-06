<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovimentiRicarica;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Gestisce il pagamento e registra la ricarica nel database.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processPayment(Request $request)
    {
        // Log dei dati ricevuti per il debug
        Log::info('Dati ricevuti per il pagamento:', $request->all());

        // Validazione dei dati del modulo
        $validatedData = $request->validate([
            'IDOpzioneRicarica' => 'required|integer',
            'IDLogin' => 'required|integer',
            'ore' => 'required|integer',
            'payment_method_nonce' => 'required|string',
        ]);

        // Simula una transazione di successo
        $transaction = (object) [
            'id' => $this->generateCustomOrderId()
        ];

        // Converti il valore delle ore in formato HH:MM:SS
        $ore = (int) $request->ore;
        Log::info('Valore di ore ricevuto: ' . $ore);
        $formattedOre = sprintf('%02d:00:00', $ore);

        try {
            // Crea un nuovo record nel database
            $movimento = MovimentiRicarica::create([
                'IDOpzioneRicarica' => $validatedData['IDOpzioneRicarica'],
                'IDLogin' => $validatedData['IDLogin'],
                'data' => now(),
                'ore' => $formattedOre,
                'paypal_orderid' => $transaction->id
            ]);

            // Log del movimento creato per il debug
            Log::info('Movimento creato:', $movimento->toArray());

            // Aggiorna il saldo dell'utente
            $this->aggiornaSaldo($validatedData['IDLogin']);

            return redirect()->back()->with('success', 'Nuova ricarica registrata con successo!');
        } catch (\Exception $e) {
            // Log dell'errore
            Log::error('Errore durante la registrazione della ricarica:', ['exception' => $e->getMessage()]);

            return redirect()->back()->with('error', 'Si è verificato un errore durante la registrazione della ricarica.');
        }
    }

    /**
     * Genera un ID ordine personalizzato.
     *
     * @return string
     */
    private function generateCustomOrderId()
    {
        return Str::lower(Str::random(10));
    }

    /**
     * Aggiorna il saldo dell'utente nella tabella dettagli_conto.
     *
     * @param int $userId
     * @return void
     */
    private function aggiornaSaldo($userId)
    {
        // Calcola la somma delle ore ricaricate in secondi
        $oreRicarica = DB::table('movimenti_ricarica')
            ->where('IDLogin', $userId)
            ->sum(DB::raw('TIME_TO_SEC(ore)'));

        // Recupera il saldo attuale in formato HH:MM:SS
        $saldoAttuale = DB::table('dettagli_conto')
            ->where('IDLogin', $userId)
            ->value('saldo');

        // Converti il saldo attuale in secondi
        $saldoAttualeSeconds = $this->timeToSeconds($saldoAttuale);

        // Calcola il nuovo saldo in secondi
        $nuovoSaldoSeconds = $saldoAttualeSeconds + $oreRicarica;

        // Converti il nuovo saldo in formato HH:MM:SS
        $nuovoSaldo = $this->secondsToTime($nuovoSaldoSeconds);

        // Aggiorna il saldo nella tabella dettagli_conto
        DB::table('dettagli_conto')
            ->where('IDLogin', $userId)
            ->update(['saldo' => $nuovoSaldo]);
    }

    /**
     * Converte un formato di tempo HH:MM:SS in secondi.
     *
     * @param string $time
     * @return int
     */
    private function timeToSeconds($time)
    {
        list($hours, $minutes, $seconds) = explode(':', $time);
        return ($hours * 3600) + ($minutes * 60) + $seconds;
    }

    /**
     * Converte secondi in formato di tempo HH:MM:SS.
     *
     * @param int $seconds
     * @return string
     */
    private function secondsToTime($seconds)
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = $seconds % 60;
        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }
}
