@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center align-items-center mt-5">
        <div class="col d-flex justify-content-center align-items-center mt-5">

            <button class="btn btn-users fw-bold me-5">
                <a href="/logins">{{ __('Tabella Utenti') }}</a>
            </button>

            <button class="btn btn-ricariche fw-bold me-5">
                <a href="/opzioni_ricarica">{{ __('Tabella Ricariche') }}</a>
            </button>

            <button class="btn btn-interventi me-5 fw-bold">
                <a href="/tipi_intervento">{{ __('Tabella Interventi') }}</a>
            </button>
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
        transition: background-color 0.3s, color 0.3s, filter 0.3s;
        border: 2px solid black;
        color: black;
    }

    .btn-ricariche {
        background-color: #f77772;
        border: 2px solid black;
        color: black;
    }

    .btn-ricariche:hover {
        background-color: #fa3535;
        transition: background-color 0.3s, color 0.3s, filter 0.3s;
        border: 2px solid black;
        color: black;
    }

    .btn-interventi {
        background-color: #46cd2f;
        border: 2px solid black;
        color: black;
    }

    .btn-interventi:hover {
        background-color: #3b9d0e;
        transition: background-color 0.3s, color 0.3s, filter 0.3s;
        border: 2px solid black;
        color: black;
    }
</style>

@endsection
