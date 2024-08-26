<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovimentiRicarica;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        // Simula una transazione di successo
        $transaction = (object) [
            'id' => $this->generateCustomOrderId()
        ];

        // Converti il valore delle ore in formato HH:MM:SS
        $ore = (int) $request->ore;
        \Log::info('Valore di ore: ' . $ore);
        $formattedOre = sprintf('%02d:00:00', $ore);

        // Crea un nuovo record nel database
        MovimentiRicarica::create([
            'IDOpzioneRicarica' => $request->IDOpzioneRicarica,
            'IDLogin' => $request->IDLogin,
            'data' => now(),
            'ore' => $formattedOre,
            'paypal_orderid' => $transaction->id
        ]);

        return redirect()->back()->with('success', 'Nuova ricarica registrata con successo!');
    }

    private function generateCustomOrderId()
    {
        return Str::lower(Str::random(10));
    }
}
