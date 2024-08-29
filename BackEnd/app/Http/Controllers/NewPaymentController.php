<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovimentiRicarica;

class NewPaymentController extends Controller {
    public function handlePayment(Request $request) {
        // Log per debugging
        \Log::info('Richiesta ricevuta:', $request->all());

        // Validazione dei dati
        $request->validate([
            'IDLogin' => 'required|integer',
            'IDOpzioneRicarica' => 'required|integer',
            'ore' => 'required',
            'paymentMethodNonce' => 'required|string',
        ]);

        // Ottieni i dati dal form
        $userId = $request->input('IDLogin');
        $opzioneRicaricaId = $request->input('IDOpzioneRicarica');
        $ore = $request->input('ore');
        $paypalOrderId = $request->input('paymentMethodNonce');

        // Crea un nuovo movimento
        $movimento = new MovimentiRicarica();
        $movimento->IDOpzioneRicarica = $opzioneRicaricaId;
        $movimento->IDLogin = $userId;
        $movimento->data = now();
        $movimento->ore = $ore;
        $movimento->paypal_orderid = $paypalOrderId;
        $movimento->save();

        // Converti l'oggetto in un array per il log
        \Log::info('Movimento salvato:', $movimento->toArray());
        return response()->json(['message' => 'Dati aggiornati con successo.']);
    }
}
