<?php

namespace App\Http\Controllers;

use App\Models\OpzioniRicarica;
use Illuminate\Http\Request;

class OpzioniRicaricaController extends Controller
{
    public function index()
    {
        $opzioni = OpzioniRicarica::all();
        return view('subpages.opzioni_ricarica.index', compact('opzioni'));
    }

    public function create()
    {
        $opzioni = OpzioniRicarica::all();
        return view('subpages.opzioni_ricarica.create', compact('opzioni'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'descrizione' => 'required|max:50',
            'costo' => 'required|numeric',
            'ore' => 'required',
        ]);

        OpzioniRicarica::create($request->all());
        return redirect()->route('opzioni_ricarica.index');
    }

    public function show($id) {
        $opzione = OpzioniRicarica::findOrFail($id);
        return view('subpages.opzioni_ricarica.show', compact('opzione'));
    }

    public function edit($id) {
        $opzione = OpzioniRicarica::find($id);
        $opzioni = OpzioniRicarica::all();
        return view('subpages.opzioni_ricarica.edit', compact('opzione', 'opzioni'));
    }


    public function update(Request $request, OpzioniRicarica $opzioniRicarica) {
        $request->validate([
            'descrizione' => 'required|max:50',
            'costo' => 'required|numeric',
            'ore' => 'required',
        ]);

        // Formattare l'ora nel formato HH:SS:00
        $ore = date('H:i:00', strtotime($request->input('ore')));

        $opzioniRicarica->descrizione = $request->input('descrizione');
        $opzioniRicarica->costo = $request->input('costo');
        $opzioniRicarica->ore = $ore;

        if ($opzioniRicarica->save()) {
            return redirect()->route('opzioni_ricarica.index')->with('success', 'Opzione aggiornata con successo');
        } else {
            return redirect()->back()->with('error', 'Errore durante l\'aggiornamento dell\'opzione');
        }
    }

    public function destroy(OpzioniRicarica $opzioniRicarica)
    {
        $opzioniRicarica->delete();
        return redirect()->route('opzioni_ricarica.index');
    }
}
