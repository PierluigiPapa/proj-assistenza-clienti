@extends('layouts.app')

@section('content')

<main>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-center align-items-center mt-5">
                    <div class="card" style="width: 60rem;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h1 class="card-title text-center">Dettagli del saldo</h1>
                                    <p class="card-text">Utente del saldo: {{$dettaglio->login->nome}}
                                        {{$dettaglio->login->cognome}}
                                    </p>
                                    <p class="card-text">Saldo disponibile: {{$dettaglio->saldo}}</p>
                                    <p class="card-text">Saldo attivato {{ ucfirst($dettaglio->created_at->setTimezone('Europe/Rome')->locale('it')->isoFormat('dddd DD-MM-YYYY')) }}
                                        ore {{ $dettaglio->created_at->setTimezone('Europe/Rome')->format('H:i:s') }}
                                    </p>
                                    <p class="card-text">Saldo aggiornato {{ ucfirst($dettaglio->updated_at->setTimezone('Europe/Rome')->locale('it')->isoFormat('dddd DD-MM-YYYY')) }}
                                        ore {{ $dettaglio->updated_at->setTimezone('Europe/Rome')->format('H:i:s') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


@endsection
