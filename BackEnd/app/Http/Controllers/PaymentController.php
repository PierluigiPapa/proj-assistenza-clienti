<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovimentiRicarica;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

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
}
