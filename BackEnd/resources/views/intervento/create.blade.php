@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row d-flex justify-content-center align-items-center mt-5">
        <div class="col-6">
            <div class="card" style="height: 100%;">
                <div class="card-body">
                    <h3 class="card-title text-center mb-5">Registra l'intervento</h3>
                    <form action="{{ route('intervento.store') }}" method="POST">
                        @csrf

                        <!-- Selezione utente -->
                        <div class="form-group mb-3">
                            <label for="IDLogin">Seleziona utente:</label>
                            <select class="form-control" id="IDLogin" name="IDLogin" required>
                                <option value="" disabled selected >Seleziona un utente</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->nome }} {{ $user->cognome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tipo di intervento -->
                        <div class="form-group mb-3">
                            <label for="IDIntervento">Tipo di intervento:</label>
                            <select class="form-control" id="IDIntervento" name="IDIntervento" required>
                                <option value=""disabled selected >Seleziona un tipo di intervento</option>
                                @foreach($tipiIntervento as $tipo)
                                    <option value="{{ $tipo->tipologia }}">{{ $tipo->dettagli }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Data e ora di inizio -->
                        <div class="form-group mb-3">
                            <label for="data_inizio_intervento">Data inizio:</label>
                            <input type="date" class="form-control" id="data_inizio_intervento" name="data_inizio_intervento" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="ora_inizio_intervento">Ora inizio:</label>
                            <input type="time" class="form-control" id="ora_inizio_intervento" name="ora_inizio_intervento" required>
                        </div>

                         <!-- Data e ora di fine -->
                        <div class="form-group mb-3">
                            <label for="data_fine_intervento">Data fine:</label>
                            <input type="date" class="form-control" id="data_fine_intervento" name="data_fine_intervento" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="ora_fine_intervento">Ora fine:</label>
                            <input type="time" class="form-control" id="ora_fine_intervento" name="ora_fine_intervento" required>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-login mt-3">Registra</button>
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
</div>

@endsection
