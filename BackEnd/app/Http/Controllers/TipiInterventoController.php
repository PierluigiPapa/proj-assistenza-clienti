<?php

namespace App\Http\Controllers;

use App\Models\TipiIntervento;
use Illuminate\Http\Request;

class TipiInterventoController extends Controller
{
    public function index() {
        $interventi = TipiIntervento::all();
        return view('subpages.tipi_intervento.index', compact('interventi'));
    }

    public function create() {
        return view('subpages.tipi_intervento.create');
    }

    public function store(Request $request) {
        $request->validate([
            'tipologia' => 'required|max:255',
            'dettagli' => 'required|max:255',
            'intervento_gratuito' => 'required|boolean',
        ]);

        TipiIntervento::create([
            'tipologia' => $request->input('tipologia'),
            'intervento_gratuito' => $request->boolean('intervento_gratuito'),
            'dettagli' => $request->input('dettagli'),
        ]);

        return redirect()->route('tipi_intervento.index');
    }

    public function update(Request $request, $id) {
        $request->validate([
            'tipologia' => 'required|max:255',
            'dettagli' => 'required|max:255',
            'intervento_gratuito' => 'required|boolean',
        ]);

        $intervento = TipiIntervento::findOrFail($id);

        $intervento->update([
            'tipologia' => $request->input('tipologia'),
            'intervento_gratuito' => $request->boolean('intervento_gratuito'),
            'dettagli' => $request->input('dettagli'),
        ]);

        return redirect()->route('tipi_intervento.index');
    }



    public function show($id) {
        $intervento = TipiIntervento::findOrFail($id);
        return view('subpages.tipi_intervento.show', compact('intervento'));
    }

    public function edit($id) {
        $intervento = TipiIntervento::findOrFail($id);
        return view('subpages.tipi_intervento.edit', compact('intervento'));
    }


    public function destroy($id) {
        $intervento = TipiIntervento::findOrFail($id);
        $intervento->delete();

        return redirect()->route('tipi_intervento.index');
    }
}
