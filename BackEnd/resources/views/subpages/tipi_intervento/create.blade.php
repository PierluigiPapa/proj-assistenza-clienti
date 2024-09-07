@extends('layouts.app')

@section('content')

<main>
    <div class="container margin">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="card mt-5" style="width: 50%;">
                <div class="card-body">
                    <h3 class="text-dark text-center">Crea un nuovo tipo di intervento</h3>
                    <form action="{{ route('tipi_intervento.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="dettagli" class="form-label">Descrizione intervento</label>
                            <input type="text" class="form-control" id="dettagli" name="dettagli" value="{{ old('dettagli') }}">

                            <div class="mb-3 mt-3">
                                <label for="tipologia" class="form-label">Inserisci il livello</label>
                                <input type="text" class="form-control" id="tipologia" name="tipologia" value="{{ old('tipologia') }}">
                            </div>

                            <div class="mb-3 mt-3">
                                <label for="intervento_gratuito" class="form-label">Inserisci il costo</label>
                                <select class="form-control" id="intervento_gratuito" name="intervento_gratuito">
                                    <option value="0" {{ old('intervento_gratuito') == 1 ? 'selected' : '' }}>Gratuito</option>
                                    <option value="1" {{ old('intervento_gratuito') == 0 ? 'selected' : '' }}>A pagamento</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-login">Aggiungi</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <button class="btn btn-back mt-5">
                <a href="/tipi_intervento">Torna Indietro</a>
            </button>
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
