@extends('layouts.app')

@section('content')

<main>
    <div class="container">
        <div class="d-flex justify-content-center align-items-center mt-5">
            <h3 class="text-light">Lista utenti: {{$totalUsers}}</h3>
        </div>


        <div class="d-flex justify-content-center align-items-center mt-3">
            <a href="{{ route('users.create') }}" class="btn btn-login">Crea</a>
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
                        <th scope="col">Ricariche</th>
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                    <tr class="text-center">
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->nome }}</td>
                        <td>{{ $user->cognome }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->admin ? 'Amministratore' : 'Utente' }}</td>
                        <td>
                            <button type="button" class="btn btn-ricarica" data-bs-toggle="modal" data-bs-target="#oreModal-{{ $user->id }}">
                                Visualizza le ricariche
                            </button>

                            <!-- Modal per visualizzare i movimenti ricarica -->
                            <div class="modal fade" id="oreModal-{{ $user->id }}" tabindex="-1" aria-labelledby="oreModalLabel-{{ $user->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="oreModalLabel-{{ $user->id }}">Ricariche di {{ $user->username }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Tipologia</th>
                                                        <th>Ore</th>
                                                        <th>Azioni</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($user->movimentiRicarica as $movimento)
                                                    <tr>
                                                        <td>{{ $movimento->opzione_ricarica_label }}</td>
                                                        <td>{{ $movimento->ore }}</td>
                                                        <td>
                                                            <form action="{{ route('movimentiRicarica.destroy', $movimento->id) }}" method="POST" style="display:inline-block;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-secondary"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success"><i class="fa-solid fa-pen"></i></a>

                            <!-- Pulsante per aprire il modale di conferma eliminazione -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $user->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>

                            <!-- Modal di conferma eliminazione -->
                            <div class="modal fade" id="deleteModal-{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $user->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel-{{ $user->id }}">Conferma Eliminazione</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Sei sicuro di voler eliminare l'utente <strong>{{ $user->username }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Elimina</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
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

    .btn-ricarica {
        background-color: #091c2e;
        border: 2px solid white;
        transition: background-color 0.3s, color 0.3s, filter 0.3s;
        color: white;
    }

    .btn-ricarica:hover {
        background-color: white;
        border: 2px solid #091c2e;
        color: #091c2e;
    }
</style>

@endsection
