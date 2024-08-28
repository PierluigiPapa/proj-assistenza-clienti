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
                                    <h1 class="card-title text-center">Dettagli del tipo di intervento</h1>
                                    <h3 class="card-title text-center mt-4 mb-4">{{$intervento->dettagli}}</h3>
                                    <p class="card-text">Livello: {{ $intervento->tipologia }}</p>
                                    <p class="card-text">Costo: {{ $intervento->intervento_gratuito == 0 ? 'Gratuito' : 'A pagamento' }}</p>
                                    <p class="card-text">Tipo di intervento inserito {{ ucfirst($intervento->created_at->setTimezone('Europe/Rome')->locale('it')->isoFormat('dddd DD-MM-YYYY')) }}
                                        ore {{ $intervento->created_at->setTimezone('Europe/Rome')->format('H:i:s') }}</p>
                                    <p class="card-text">Tipologia di ricarica modificata {{ ucfirst($intervento->updated_at->setTimezone('Europe/Rome')->locale('it')->isoFormat('dddd DD-MM-YYYY')) }}
                                        ore {{ $intervento->updated_at->setTimezone('Europe/Rome')->format('H:i:s') }}</p>
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
