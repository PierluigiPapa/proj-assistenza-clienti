<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DettagliConto;

class DettagliContoController extends Controller
{
    public function index()
    {
        $dettagli = DettagliConto::all();
        return view('subpages.dettagli_conto.index', compact('dettagli'));
    }

    public function create()
    {
        return view('subpages.dettagli_conto.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'IDLogin' => 'required',
            'saldo' => 'required',
        ]);

        DettagliConto::create($request->all());

        return redirect()->route('subpages.dettagli_conto.index')->with('success', 'Dettaglio conto creato con successo.');
    }

    public function show(DettagliConto $dettagliConto)
    {
        return view('subpages.dettagli_conto.show', compact('dettagliConto'));
    }

    public function edit(DettagliConto $dettagliConto)
    {
        return view('subpages.dettagli_conto.edit', compact('dettagliConto'));
    }

    public function update(Request $request, DettagliConto $dettagliConto)
    {
        $request->validate([
            'IDLogin' => 'required',
            'saldo' => 'required',
        ]);

        $dettagliConto->update($request->all());

        return redirect()->route('dettagli_conto.index')->with('success', 'Dettaglio conto aggiornato con successo.');
    }

    public function destroy(DettagliConto $dettagliConto)
    {
        $dettagliConto->delete();

        return redirect()->route('dettagli_conto.index') ->with('success', 'Dettaglio conto eliminato con successo.');
    }
}
