@extends('layouts.app')

@section('content')

<main>
    <div class="container">
        <div class="d-flex justify-content-center mt-3">
            <table class="table mt-5" style="width: 70%">
                <thead>
                    <tr class="text-center fs-5">
                        <th scope="col">Utente</th>
                        <th scope="col">Tipologia</th>
                        <th scope="col">Data ricarica</th>
                        <th scope="col">Codice ricarica</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($movimenti as $movimento)
                    <tr class="text-center">
                        <td>{{ $movimento->login->nome }} {{ $movimento->login->cognome }}</td>
                        <td>{{ $movimento->opzioniRicarica->descrizione }}</td>
                        <td>{{ ucfirst($movimento->updated_at->setTimezone('Europe/Rome')->locale('it')->isoFormat('ddd DD-MM-YYYY')) }}
                            ore {{ $movimento->updated_at->setTimezone('Europe/Rome')->format('H:i:s') }}
                        </td>
                        <td>{{ $movimento->paypal_orderid }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>

<style>
    .btn-login {
        background-color: #3498DB;
        border: 2px solid white;
        color: white;
    }

    .btn-login:hover {
        background-color: #194665;
        color: white;
        transition: background-color 0.3s, color 0.3s, filter 0.3s;
        border: 2px solid white;
    }
</style>

@endsection
