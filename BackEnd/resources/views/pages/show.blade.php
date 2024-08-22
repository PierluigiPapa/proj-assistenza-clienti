@extends('layouts.app')

@section('content')

<main>
    <div class="container">
        <div class="d-flex justify-content-center align-items-center mt-5">
            <div class="card" style="width: 30rem;">
                <div class="card-body">
                  <h3 class="card-title text-center">Dettagli utente</h3>
                  <h4 class="card-subtitle mb-2 text-center mt-3">{{$user->username}}</h4>
                  <p class="card-text">Nome: {{$user->nome}}</p>
                  <p class="card-text">Cognome: {{$user->cognome}}</p>
                  <p class="card-text">Creato il: {{$user->created_at->setTimezone('Europe/Rome')->format('d-m-Y H:i:s')}}</p>
                  <p class="card-text">Aggiornato il: {{$user->updated_at->setTimezone('Europe/Rome')->format('d-m-Y H:i:s')}}</p>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
