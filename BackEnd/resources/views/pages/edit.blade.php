@extends('layouts.app')

@section('content')

<main>
    <div class="container mt-5 mb-5 margin">
        <div class="row d-flex justify-content-center align-items-center">
            <!-- Card con il form di modifica utente-->
            <div class="card" style="width: 50%">
                <div class="card-body">
                    <h3 class="card-title text-center">Modifica l'utente</h3>

                    <!-- Form di modifica utente -->
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" value="{{ $user->nome }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="cognome" class="form-label">Cognome</label>
                            <input type="text" class="form-control" id="cognome" name="cognome" value="{{ $user->cognome }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label for="admin" class="form-label">Admin</label>
                            <select class="form-control" id="admin" name="admin" required>
                                <option value="1" {{ $user->admin == 1 ? 'selected' : '' }}>Sì</option>
                                <option value="0" {{ $user->admin == 0 ? 'selected' : '' }}>No</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-center mb-3">
                            <button type="submit" class="btn btn-login">Modifica</button>
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

    <!-- Modal -->
    <div class="modal fade" id="modificaModal" tabindex="-1" aria-labelledby="modificaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modificaModalLabel">Seleziona i dati da modificare</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="modifica-form">
                        @foreach($user->movimentiRicarica as $movimento)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $movimento->id }}" id="modifica{{ $movimento->id }}">
                            <label class="form-check-label" for="modifica{{ $movimento->id }}">
                                {{ $movimento->tipologia }} - {{ $movimento->ore }} ore
                            </label>
                        </div>
                        @endforeach
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                    <button type="button" class="btn btn-login" onclick="confermaModifiche()">Conferma</button>
                </div>
            </div>
        </div>
    </div>

</main>



@endsection
