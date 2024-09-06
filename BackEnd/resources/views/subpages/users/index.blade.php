@extends('layouts.app')

@section('content')

<main>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h3 class="text-light mx-auto">Lista utenti: {{$totalLogins}}</h3>
                <a href="{{ route('logins.create') }}" class="btn btn-login me-5">Crea</a>
            </div>
        </div>


        <div class="d-flex justify-content-center mt-3">
            <table class="table mt-3">
                <thead>
                    <tr class="text-center fs-5">
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Cognome</th>
                        <th scope="col">Username</th>
                        <th scope="col">Tipo di utente</th>
                        <th scope="col">Data creazione</th>
                        <th scope="col">Data aggiornamento</th>
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($logins as $login)
                    <tr class="text-center">
                        <th scope="row">{{ $login->id }}</th>
                        <td>{{ $login->nome }}</td>
                        <td>{{ $login->cognome }}</td>
                        <td>{{ $login->username }}</td>
                        <td>{{ $login->admin ? 'Amministratore' : 'Utente' }}</td>
                        <td>{{ ucfirst($login->created_at->setTimezone('Europe/Rome')->locale('it')->isoFormat('ddd DD-MM-YYYY')) }}
                            ore {{ $login->created_at->setTimezone('Europe/Rome')->format('H:i:s') }}
                        </td>
                        <td>{{ ucfirst($login->updated_at->setTimezone('Europe/Rome')->locale('it')->isoFormat('ddd DD-MM-YYYY')) }}
                            ore {{ $login->updated_at->setTimezone('Europe/Rome')->format('H:i:s') }}
                        </td>
                        <td>
                            <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#loginModal{{ $login->id }}"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('logins.edit', $login->id) }}" class="btn btn-success"><i class="fa-solid fa-pen"></i></a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $login->id }}"><i class="fa-solid fa-trash"></i></button>
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Dettagli -->
                    <div class="modal fade" id="loginModal{{ $login->id }}" tabindex="-1" aria-labelledby="loginModalLabel{{ $login->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="card" style="width: 100%;">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h1 class="card-title text-center">Dettagli utente</h1>
                                                    <h3 class="card-subtitle mb-2 text-center mt-3">{{$login->username}}</h3>
                                                    <p class="card-text">Nome: {{$login->nome}}</p>
                                                    <p class="card-text">Cognome: {{$login->cognome}}</p>
                                                    <p class="card-text">Data creazione dell'utente: {{ ucfirst($login->created_at->setTimezone('Europe/Rome')->locale('it')->isoFormat('ddd DD-MM-YYYY')) }}
                                                        ore {{ $login->created_at->setTimezone('Europe/Rome')->format('H:i:s') }}
                                                    </p>
                                                    <p class="card-text">Data aggiornamento dell'utente: {{ ucfirst($login->created_at->setTimezone('Europe/Rome')->locale('it')->isoFormat('ddd DD-MM-YYYY')) }}
                                                        ore {{ $login->created_at->setTimezone('Europe/Rome')->format('H:i:s') }}
                                                    </p>
                                                    <p class="card-text">Saldo disponibile: {{$login->dettagliConto->saldo}}</p>
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
                    <div class="modal fade" id="deleteModal{{ $login->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $login->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $login->id }}">Conferma Eliminazione</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Sei sicuro di voler eliminare <span class="fw-bold">{{$login->username}}</span>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                    <form action="{{ route('logins.destroy', $login->id) }}" method="POST" style="display:inline;">
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
