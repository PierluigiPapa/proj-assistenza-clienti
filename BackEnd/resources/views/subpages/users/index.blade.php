@extends('layouts.app')

@section('content')

<main>
    <div class="container">
        {{-- <div class="d-flex justify-content-center align-items-center mt-5">
            <h3 class="text-light">Lista utenti: {{$totalUsers}}</h3>
        </div> --}}

        {{-- <div class="d-flex justify-content-center align-items-center mt-3">
            <a href="{{ route('users.create') }}" class="btn btn-login">Crea</a>
        </div> --}}

        <div class="d-flex justify-content-center mt-3">
            <table class="table mt-3">
                <thead>
                    <tr class="text-center fs-5">
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Cognome</th>
                        <th scope="col">Username</th>
                        <th scope="col">Tipo di utente</th>
                        <th scope="col">Creato il:</th>
                        <th scope="col">Aggiornato il:</th>
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
                        <td>{{ $login->created_at }}</td>
                        <td>{{ $login->updated_at }}</td>
                        <td>
                            <a href="{{ route('logins.show', $login->id) }}" class="btn btn-secondary"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('logins.edit', $login->id) }}" class="btn btn-success"><i class="fa-solid fa-pen"></i></a>
                            <form action="{{ route('users.destroy', $login->id) }}" method="POST" style="display:inline;">
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
