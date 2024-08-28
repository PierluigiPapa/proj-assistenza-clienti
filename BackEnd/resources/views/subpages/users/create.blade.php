@extends('layouts.app')

@section('content')

<main>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Crea un nuovo utente</h3>
                        <form action="{{ route('logins.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>
                            <div class="mb-3">
                                <label for="cognome" class="form-label">Cognome</label>
                                <input type="text" class="form-control" id="cognome" name="cognome" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="admin" class="form-label">Admin</label>
                                <select class="form-control" id="admin" name="admin" required>
                                    <option value="1">Sì</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-login">Aggiungi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <button class="btn btn-back mt-5">
                    <a href="/logins">Torna Indietro</a>
                </button>
            </div>
        </div>
    </div>
</main>


<style>
    a {
        text-decoration: none;
        color: inherit;
    }

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

    .btn-back {
        background-color: white;
        border: 2px solid #091c2e;
        color: #091c2e;
    }

    .btn-back:hover {
        background-color: #091c2e;
        border: 2px solid white;
        transition: background-color 0.3s, color 0.3s, filter 0.3s;
        color: white;
    }
</style>

@endsection
