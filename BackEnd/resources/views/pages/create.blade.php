@extends('layouts.app')

@section('content')

<main>
    <div class="container margin">
        <div class="row d-flex justify-content-center align-items-center mt-5">
            <div class="card" style="width: 50%">
                <div class="card-body">
                    <h3 class="card-title text-center">Crea un nuovo utente</h3>
                    <form action="{{ route('users.store') }}" method="POST">
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

                        <div class="d-flex justify-content-center align-items-center">
                            <button type="submit" class="btn btn-login">Crea</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <button class="btn btn-back mt-5">
                    <a href="/index">Torna Indietro</a>
                </button>
            </div>
        </div>
    </div>
</main>

@endsection
