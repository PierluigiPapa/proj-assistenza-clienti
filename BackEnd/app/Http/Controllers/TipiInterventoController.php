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
}
