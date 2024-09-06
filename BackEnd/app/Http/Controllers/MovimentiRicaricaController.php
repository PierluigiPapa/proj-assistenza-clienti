<?php

namespace App\Http\Controllers;

use App\Models\MovimentiRicarica;
use App\Models\Login;
use Illuminate\Http\Request;

class MovimentiRicaricaController extends Controller
{

    public function index() {
        $movimenti = MovimentiRicarica::with('opzioniRicarica', 'login')->get();
        return view('subpages.movimenti_ricarica.index', compact('movimenti'));
    }

    public function destroy($id)
    {
        $movimento = MovimentiRicarica::find($id);
        $movimento->delete();

        return redirect()->back()->with('success', 'Movimento di ricarica cancellato con successo.');
    }

    public function showUserMovimenti($userId) {
        // Recupera l'utente e i movimenti di ricarica associati
        $user = Login::findOrFail($userId);
        $movimenti = MovimentiRicarica::where('IDLogin', $userId)->with('opzioniRicarica')->get();

        // Passa i dati alla vista
        return view('subpages.movimenti_ricarica.index', compact('movimenti', 'user'));
    }
}

