<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DettagliConto;

class DettagliContoController extends Controller
{
    public function index()
    {
        $dettagli = DettagliConto::all();
        $dettagli = DettagliConto::with('login')->get();
        return view('subpages.dettagli_conto.index', compact('dettagli'));
    }

    public function create() {
        $users = DB::table('login')->get();
        return view('subpages.dettagli_conto.create', compact('users'));
    }


    public function store(Request $request) {
        $request->validate([
            'user_id' => 'required',
            'saldo' => 'required',
        ]);

        \Log::info('Dati ricevuti:', $request->all());

        DettagliConto::create([
            'IDLogin' => $request->user_id,
            'saldo' => $request->saldo,
        ]);

        return redirect()->route('dettagli_conto.index')->with('success', 'Dettaglio conto creato con successo.');
    }


    public function show(DettagliConto $dettagliConto)
    {
        return view('subpages.dettagli_conto.show', compact('dettagli'));
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
