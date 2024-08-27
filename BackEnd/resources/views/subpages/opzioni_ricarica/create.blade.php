@extends('layouts.app')

@section('content')

<main>
    <div class="container">
        <div class="d-flex justify-content-center align-items-center">
            <h3 class="text-light mt-5">Crea una nuova opzione di ricarica</h3>
        </div>

        <div class="card mt-5" style="width: 100%;">
            <div class="card-body">
                <form action="{{ route('opzioni_ricarica.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Inserisci la tipologia di ricarica</label>
                        <input type="text" class="form-control" id="" name="descrizione" value="">

                        <div class="mb-3 mt-3">
                            <label for="exampleInputPassword1" class="form-label">Inserisci la quantità di ore per la ricarica</label>
                            <input type="time" class="form-control" id="exampleInputPassword1" name="ore" value="">
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="exampleInputPassword1" class="form-label">Inserisci l'importo della ricarica</label>
                            <input type="number" class="form-control" id="exampleInputPassword1" step="0.01" placeholder="0.00 €" min="0" name="costo" value="">
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-login">Aggiungi</button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
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
