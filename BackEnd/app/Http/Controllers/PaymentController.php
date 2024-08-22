<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Models\MovimentiRicarica;
use App\Models\User;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => '6xqmd4knh2cjrrz9',
            'publicKey' => '2r3sq7569k769t65',
            'privateKey' => '067b0554674fc1e7070057855ee584ae'
        ]);

        $result = $gateway->transaction()->sale([
            'amount' => '10.00',
            'paymentMethodNonce' => $request->payment_method_nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            $transaction = $result->transaction;

            MovimentiRicarica::create([
                'IDOpzioneRicarica' => $request->IDOpzioneRicarica,
                'IDLogin' => $request->IDLogin,
                'data' => now(),
                'ore' => now()->format('H:i:s'),
                'paypal_orderid' => $transaction->id
            ]);

            return redirect()->back()->with('success', 'Pagamento effettuato con successo!');
        } else {
            return redirect()->back()->with('error', 'Il pagamento non è andato a buon fine. Riprova.');
        }
    }

    public function showUserDetails($id)
    {
        $user = User::find($id);
        $dataScadenza = $this->calcolaDataScadenza($user->id); // Funzione per calcolare la data di scadenza
        return view('user.details', compact('user', 'dataScadenza'));
    }
}
