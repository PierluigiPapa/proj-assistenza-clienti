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
                                    <h1 class="card-title text-center">Dettagli della ricarica</h1>
                                    <p class="card-text">Tipologia: {{$opzione->descrizione}}</p>
                                    <p class="card-text">Costo: {{ number_format($opzione->costo, 2, ',', '.') }} €</p>
                                    <p class="card-text">Ore: {{ sprintf('%01d', $opzione->ore) }}</p>
                                    <p class="card-text">Tipologia di ricarica inserita {{ ucfirst($opzione->created_at->setTimezone('Europe/Rome')->locale('it')->isoFormat('dddd DD-MM-YYYY')) }}
                                        ore {{ $opzione->created_at->setTimezone('Europe/Rome')->format('H:i:s') }}</p>
                                    <p class="card-text">Tipologia di ricarica modificata {{ ucfirst($opzione->updated_at->setTimezone('Europe/Rome')->locale('it')->isoFormat('dddd DD-MM-YYYY')) }}
                                        ore {{ $opzione->updated_at->setTimezone('Europe/Rome')->format('H:i:s') }}</p>
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
