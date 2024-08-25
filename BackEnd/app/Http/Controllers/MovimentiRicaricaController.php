<?php

namespace App\Http\Controllers;

use App\Models\MovimentiRicarica;
use Illuminate\Http\Request;

class MovimentiRicaricaController extends Controller
{
    public function destroy($id)
    {
        $movimento = MovimentiRicarica::find($id);
        if ($movimento) {
            $movimento->delete();
            return redirect()->back()->with('success', 'Movimento di ricarica cancellato con successo.');
        } else {
            return redirect()->back()->with('error', 'Movimento di ricarica non trovato.');
        }
    }

}


