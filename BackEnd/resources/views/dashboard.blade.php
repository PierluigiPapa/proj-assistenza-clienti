@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center align-items-center mt-5">
        <div class="col d-flex justify-content-center align-items-center mt-5">

            <button class="btn btn-users me-5">
                <a href="/logins">{{ __('Tabella Utenti') }}</a>
            </button>

            <button class="btn btn-primary me-5">Tabella Ricariche</button>

            <button class="btn btn-primary me-5">Tabella Interventi</button>
        </div>
    </div>
</div>

<style>
    a {
        text-decoration: none;
        color: black;
    }

    .btn-users {
        background-color: #fbcb54;
        border: 2px solid black;
        color: black;
    }

    .btn-users:hover {
        background-color: #be8800;
        border: 2px solid black;
        color: black;
    }

</style>

@endsection
