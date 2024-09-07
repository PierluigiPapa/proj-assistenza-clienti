@extends('layouts.app')

@section('content')

<main>
    <div class="container margin mt-5 mb-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="card mt-5" style="width: 50%;">
                <div class="card-body">
                    <h3 class="card-title text-dark text-center mb-5">Crea una nuova opzione di ricarica</h3>
                    <form action="{{ route('opzioni_ricarica.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Inserisci la tipologia di ricarica</label>
                            <input type="text" class="form-control" id="" name="descrizione" value="">

                            <div class="mb-3 mt-3">
                                <label for="ore" class="form-label">Inserisci la quantità di ore per la ricarica</label>
                                <input type="number" class="form-control" id="" name="ore" min="0" max="48" value="">
                            </div>

                            <div class="mb-3 mt-3">
                                <label for="costo" class="form-label">Inserisci l'importo della ricarica</label>
                                <input type="number" class="form-control" id="costo" step="0.01" placeholder="0.00 €" min="0" name="costo" value="">
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
                    <a href="/opzioni_ricarica">Torna Indietro</a>
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
