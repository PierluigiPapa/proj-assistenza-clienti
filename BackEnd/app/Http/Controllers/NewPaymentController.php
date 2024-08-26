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
            'movimentoId' => 'required|integer',
        ]);

        // Ottieni i dati dal form
        $userId = $request->input('IDLogin');
        $opzioneRicaricaId = $request->input('IDOpzioneRicarica');
        $ore = (int) $request->input('ore');
        $movimentoId = $request->input('movimentoId');
        \Log::info('Valore di ore: ' . $ore);

        // Converti il valore delle ore in formato HH:MM:SS
        $formattedOre = sprintf('%02d:00:00', $ore);

        // Esegui l'aggiornamento del movimento specifico
        $movimento = MovimentiRicarica::where('IDLogin', $userId)->where('id', $movimentoId)->first();
        if ($movimento) {
            $movimento->IDOpzioneRicarica = $opzioneRicaricaId;
            $movimento->ore = $formattedOre;
            $movimento->save();
            return redirect()->back()->with('success', 'Dati aggiornati con successo.');
        } else {
            // Gestisci il caso in cui il movimento non esista
            return redirect()->back()->with('error', 'Movimento non trovato.');
        }
    }
}


