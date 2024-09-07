<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Models\MovimentiRicarica;
use App\Models\OpzioniRicarica;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BraintreePaymentController extends Controller
{
    protected $gateway;

    public function __construct()
    {
        // Configurazione della gateway Braintree utilizzando le chiavi dal file .env
        $this->gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId'  => '6xqmd4knh2cjrrz9',
            'publicKey'   => '2r3sq7569k769t65',
            'privateKey'  => '067b0554674fc1e7070057855ee584ae',
        ]);
    }

    /**
     * Mostra il form di pagamento.
     */
    public function showPaymentForm()
    {
        $clientToken = $this->gateway->clientToken()->generate();
        $opzioni = OpzioniRicarica::all();

        return view('payments.payment', ['clientToken' => $clientToken, 'opzioni' => $opzioni]);
    }

    /**
     * Gestisci la transazione di pagamento.
     */
    public function processPayment(Request $request)
    {
        // Validazione della richiesta
        $request->validate([
            'payment_method_nonce' => 'required',
            'IDOpzioneRicarica' => 'required|integer|exists:opzioni_ricarica,id',
        ]);

        $user = Auth::user();
        $opzioneRicarica = OpzioniRicarica::findOrFail($request->IDOpzioneRicarica);

        // Esegui la transazione
        $amount = $opzioneRicarica->costo;
        $nonce = $request->input('payment_method_nonce');

        $result = $this->gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        // Controlla se la transazione è andata a buon fine
        if ($result->success) {
            // Registra il movimento nella tabella 'movimenti_ricarica'
            MovimentiRicarica::create([
                'IDOpzioneRicarica' => $opzioneRicarica->id,
                'IDLogin' => $user->id,
                'data' => now(),
                'ore' => $opzioneRicarica->ore,
                'paypal_orderid' => $result->transaction->id,
            ]);

            // Aggiorna il saldo dell'utente
            $this->aggiornaSaldo($user->id);

            return redirect()->route('movimenti_ricarica.index')->with('success', 'Pagamento effettuato con successo!');
        } else {
            // Gestisci l'errore
            $errorString = "";
            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Errore: ' . $error->message . "\n";
            }

            return redirect()->back()->withErrors('Errore nel pagamento: ' . $errorString);
        }
    }

    /**
     * Aggiorna il saldo dell'utente nella tabella dettagli_conto.
     *
     * @param int $userId
     * @return void
     */
    private function aggiornaSaldo($userId) {
        // Recupera il saldo attuale in formato HH:MM:SS
        $saldoAttuale = DB::table('dettagli_conto')->where('IDLogin', $userId)->value('saldo');

        // Converti il saldo attuale in secondi
        $saldoAttualeSeconds = $this->timeToSeconds($saldoAttuale);

        // Calcola il totale delle ore ricaricate
        $oreRicarica = DB::table('movimenti_ricarica')->where('IDLogin', $userId)->sum(DB::raw('TIME_TO_SEC(ore)'));

        // Recupera tutte le opzioni di ricarica e calcola la nuova durata
        $nuovoSaldoSeconds = $oreRicarica;

        // Converti il nuovo saldo in formato HH:MM:SS
        $nuovoSaldo = $this->secondsToTime($nuovoSaldoSeconds);

        // Log per debug
        \Log::info("Ore ricarica: $oreRicarica");
        \Log::info("Saldo attuale: $saldoAttuale");
        \Log::info("Saldo attuale in secondi: $saldoAttualeSeconds");
        \Log::info("Nuovo saldo in secondi: $nuovoSaldoSeconds");
        \Log::info("Nuovo saldo: $nuovoSaldo");

        // Aggiorna il saldo nella tabella dettagli_conto
        DB::table('dettagli_conto')->where('IDLogin', $userId)->update(['saldo' => $nuovoSaldo]);
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
