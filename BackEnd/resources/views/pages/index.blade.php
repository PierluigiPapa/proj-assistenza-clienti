@extends('layouts.app')

@section('content')

<main>
    <div class="container">
        <div class="d-flex justify-content-center align-items-center mt-5">
            <h3 class="text-light">Lista utenti: {{$totalUsers}}</h3>
        </div>

        <div class="d-flex justify-content-center align-items-center">
            <a href="{{ route('users.create') }}" class="btn btn-login">Crea</a>
        </div>

        <div class="d-flex justify-content-center">
            <table class="table mt-3">
                <thead>
                    <tr class="text-center fs-4">
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Cognome</th>
                        <th scope="col">Username</th>
                        <th scope="col">Tipo di utente</th>
                        <th scope="col">Movimenti Ricarica</th>
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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#oreModal-{{ $user->id }}">
                                Visualizza le ricariche
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="oreModal-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="oreModalLabel-{{ $user->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="oreModalLabel-{{ $user->id }}">Ricariche di {{ $user->username }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
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
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-secondary"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success"><i class="fa-solid fa-pen"></i></a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
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
