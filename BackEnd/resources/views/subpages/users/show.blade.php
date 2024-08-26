@extends('layouts.app')

@section('content')

<main>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-center align-items-center mt-5">
                    <div class="card" style="width: 60rem;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h1 class="card-title text-center">Dettagli utente</h1>
                                    <h3 class="card-subtitle mb-2 text-center mt-3">{{$logins->username}}</h3>
                                    <p class="card-text">Nome: {{$logins->nome}}</p>
                                    <p class="card-text">Cognome: {{$logins->cognome}}</p>
                                    <p class="card-text">Creato il: {{$logins->created_at->setTimezone('Europe/Rome')->format('d-m-Y H:i:s')}}</p>
                                    <p class="card-text">Aggiornato il: {{$logins->updated_at->setTimezone('Europe/Rome')->format('d-m-Y H:i:s')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


@endsection
