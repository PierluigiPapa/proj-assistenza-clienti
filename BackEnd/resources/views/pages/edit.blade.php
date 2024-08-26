@extends('layouts.app')

@section('content')

<main>
    <div class="container mt-5 mb-5">
        <div class="row">
            <!-- Card con il form di registrazione -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Modifica l'utente</h3>
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
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
                                <button type="submit" class="btn btn-login">Modifica</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <!-- Card vuota in basso a sinistra -->
            <div class="col-md-6">
                <div class="card" style="height: 100%;">
                    <div class="card-body">
                        <h3 class="card-title text-center">Form Intervento</h3>
                    </div>
                </div>
            </div>

            <!-- Form di modifica a destra -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Modifica una ricarica</h3>
                        <form id="modifica-form" method="POST" action="{{ route('handlePayment') }}">
                            @csrf
                            <input type="hidden" name="IDLogin" value="{{$user->id}}">
                            <input type="hidden" id="ore" name="ore" value="">
                            <input type="hidden" id="movimentoId" name="movimentoId" value="">

                            <!-- Aggiungi il menu a tendina per le opzioni di ricarica -->
                            <div class="form-group">
                                <label for="IDOpzioneRicarica"></label>
                                <select class="form-control" id="IDOpzioneRicarica" name="IDOpzioneRicarica" onchange="aggiornaOre()">
                                    <option value="" disabled selected>Seleziona un'opzione di ricarica</option>
                                    <option value="1" ore="6" costo="5.00">Ricarica Base - 5.00€ per 6 ore</option>
                                    <option value="2" ore="12" costo="10.00">Ricarica Standard - 10.00€ per 12 ore</option>
                                    <option value="3" ore="24" costo="20.00">Ricarica Avanzata - 20.00€ per 24 ore</option>
                                    <option value="4" ore="48" costo="50.00">Ricarica Elite - 50.00€ per 48 ore</option>
                                </select>
                            </div>

                            @if (session('success'))
                            <div class="alert alert-successo mt-4">
                                {{ session('success') }}
                             </div>
                            @endif

                            @if (session('error'))
                            <div class="alert alert-errore mt-4">
                                {{ session('error') }}
                            </div>
                            @endif

                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-login mt-3">Aggiorna</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

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
                        <input class="form-check-input" type="checkbox" value="{{ $movimento->id }}" id="modifica{{ $movimento->id }}" name="movimentoId">
                        <label class="form-check-label" for="modifica{{ $movimento->id }}">
                            {{ $movimento->opzione_ricarica_label }} - {{ $movimento->ore }} ore
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

<script>
function aggiornaOre() {
    let select = document.getElementById('IDOpzioneRicarica');
    var ore = select.options[select.selectedIndex].getAttribute('ore');
    document.getElementById('ore').value = ore;

    // Mostra il modal dopo aver selezionato un'opzione
    if (select.value) {
        $('#modificaModal').modal('show');
    }
}

function confermaModifiche() {
    let selectedMovimento = document.querySelector('input[name="movimentoId"]:checked');
    if (selectedMovimento) {
        document.getElementById('movimentoId').value = selectedMovimento.value;
    }
    // Nascondi il modal
    $('#modificaModal').modal('hide');
}
</script>

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

    .alert-successo {
        background-color: rgb(40, 184, 40);
        color: black
    }

    .alert-errore {
        background-color: rgb(255, 65, 65);
        color: black
    }


</style>


@endsection
