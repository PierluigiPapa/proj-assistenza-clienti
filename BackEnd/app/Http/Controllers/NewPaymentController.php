<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovimentiRicarica;

class NewPaymentController extends Controller
{
    public function handlePayment(Request $request)
    {
        // Validazione dei dati
        $request->validate([
            'IDLogin' => 'required|integer',
            'IDOpzioneRicarica' => 'required|integer',
            'ore' => 'required|integer',
            'payment_method_nonce' => 'required|string',
        ]);

        // Ottieni l'utente e l'opzione di ricarica selezionata
        $userId = $request->input('IDLogin');
        $opzioneRicaricaId = $request->input('IDOpzioneRicarica');
        $ore = (int) $request->input('ore');
        \Log::info('Valore di ore: ' . $ore);

        // Converti il valore delle ore in formato HH:MM:SS
        $formattedOre = sprintf('%02d:00:00', $ore);

        // Esegui l'aggiornamento delle colonne 'IDOpzioneRicarica' e 'ore' nella tabella 'movimenti_ricarica'
        $movimento = MovimentiRicarica::where('IDLogin', $userId)->first();
        if ($movimento) {
            $movimento->IDOpzioneRicarica = $opzioneRicaricaId;
            $movimento->ore = $formattedOre;
            $movimento->save();
        } else {
            // Gestisci il caso in cui il movimento non esista
            return redirect()->back()->with('error', 'Movimento non trovato.');
        }

        return redirect()->back()->with('success', 'Pagamento effettuato e dati aggiornati con successo.');
    }
}
