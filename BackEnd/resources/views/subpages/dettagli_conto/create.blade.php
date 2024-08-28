{{-- @extends('layouts.app')

@section('content')

<main>
    <div class="container">
        <div class="d-flex justify-content-center align-items-center">
            <h3 class="text-light mt-5">Crea un nuovo saldo</h3>
        </div>

        <div class="card mt-5" style="width: 100%;">
            <div class="card-body">
                <form action="{{ route('dettagli_conto.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Seleziona l'utente</label>
                        <select class="form-control" id="user_id" name="user_id">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->username }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="saldo" class="form-label">Inserisci il saldo</label>
                        <input type="text" class="form-control" id="saldo" name="saldo" min="0" max="96" value="">
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
                <a href="/opzioni_ricarica">Torna Indietro</a>
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

@endsection --}}
