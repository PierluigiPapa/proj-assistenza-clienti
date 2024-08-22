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
                        <th scope="col">Amministratore / Utente</th>
                        <th scope="col">Creato il</th>
                        <th scope="col">Aggiornato il</th>
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
                        <td>{{ $user->created_at->setTimezone('Europe/Rome')->format('d-m-Y H:i:s') }}</td>
                        <td>{{ $user->updated_at->setTimezone('Europe/Rome')->format('d-m-Y H:i:s') }}</td>
                        <td>
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-warning"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary"><i class="fa-solid fa-pen"></i></a>
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
