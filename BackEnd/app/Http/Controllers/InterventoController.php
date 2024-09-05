<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interventi;
use App\Models\Login;
use App\Models\TipiIntervento;

class InterventoController extends Controller
{
    public function store(Request $request)
    {
        // Log per debugging
        \Log::info('Richiesta ricevuta:', $request->all());

        // Validazione dei dati
        $validated = $request->validate([
            'IDLogin' => 'required|exists:login,id',
            'IDIntervento' => 'required|exists:tipi_intervento,id',
            'data_inizio_intervento' => 'required|date',
            'ora_inizio_intervento' => 'required|date_format:H:i',
            'data_fine_intervento' => 'required|date|after_or_equal:data_inizio_intervento',
            'ora_fine_intervento' => 'required|date_format:H:i',
        ]);

        // Ottieni i dati dal form
        $userId = $request->input('IDLogin');
        $interventoId = $request->input('IDIntervento');
        $dataInizio = $request->input('data_inizio_intervento');
        $oraInizio = $request->input('ora_inizio_intervento');
        $dataFine = $request->input('data_fine_intervento');
        $oraFine = $request->input('ora_fine_intervento');

        // Crea un nuovo intervento
        $intervento = new Interventi();
        $intervento->IDLogin = $userId;
        $intervento->IDIntervento = $interventoId;
        $intervento->data_inizio_intervento = $dataInizio;
        $intervento->ora_inizio_intervento = $oraInizio;
        $intervento->data_fine_intervento = $dataFine;
        $intervento->ora_fine_intervento = $oraFine;
        $intervento->save();

        // Converti l'oggetto in un array per il log
        \Log::info('Intervento salvato:', $intervento->toArray());
        return response()->json(['message' => 'Intervento salvato con successo.']);
    }

    public function create()
    {
        // Recupera tutti gli utenti e tipi di intervento dal database
        $users = Login::all();
        $tipiIntervento = TipiIntervento::all();

        // Ritorna la vista con la lista degli utenti e tipi di intervento
        return view('intervento.create', compact('users', 'tipiIntervento'));
    }
}

