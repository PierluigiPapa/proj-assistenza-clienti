@extends('layouts.app')

@section('content')

<main>
    <div class="container">
        <div class="row mt-5">
            <div class="d-flex justify-content-center align-items-center">
                <a href="{{ route('dettagli_conto.create') }}" class="btn btn-login">Crea</a>
            </div>
        </div>

        <div class="d-flex justify-content-center align-items-center mt-3">
            <table class="table mt-3" style="width: 50%;">
                <thead>
                    <tr class="text-center fs-5">
                        <th scope="col">ID</th>
                        <th scope="col">Utente</th>
                        <th scope="col">Saldo</th>
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($dettagli as $dettaglio)
                    <tr class="text-center">
                        <th scope="row">{{ $dettaglio->id }}</th>
                        <td>{{ $dettaglio->login->nome }} {{ $dettaglio->login->cognome }}</td>
                        <td>{{ $dettaglio->saldo }}</td>
                        <td>
                            <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#dettaglioModal{{ $dettaglio->id }}"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('dettagli_conto.edit', $dettaglio->id) }}" class="btn btn-success"><i class="fa-solid fa-pen"></i></a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $dettaglio->id }}"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>

                    <!-- Modal Dettagli -->
                    <div class="modal fade" id="dettaglioModal{{ $dettaglio->id }}" tabindex="-1" aria-labelledby="dettaglioModalLabel{{ $dettaglio->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="card" style="width: 100%;">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
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
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Delete -->
                    <div class="modal fade" id="deleteModal{{ $dettaglio->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $dettaglio->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $dettaglio->id }}">Conferma Eliminazione</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Sei sicuro di voler eliminare il saldo di <span class="fw-bold">{{$dettaglio->login->nome}} {{$dettaglio->login->cognome}}</span>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                    <form action="{{ route('dettagli_conto.destroy', $dettaglio->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Elimina</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
