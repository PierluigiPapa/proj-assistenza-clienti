@extends('layouts.app')

@section('content')


<div class="container d-flex justify-content-center align-items-center">
    <div class="card-login p-4 shadow-lg rounded">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label for="nome" class="form-label">{{ __('Nome') }}</label>
                <input id="nome" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ old('nome') }}" required autocomplete="nome" autofocus>

                @error('nome')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="cognome" class="form-label">{{ __('Cognome') }}</label>
                <input id="cognome" type="text" class="form-control @error('cognome') is-invalid @enderror" name="cognome" value="{{ old('cognome') }}" required autocomplete="cognome">

                @error('cognome')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">{{ __('Username') }}</label>
                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">

                @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password-confirm" class="form-label">{{ __('Conferma Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>

            <div class="mb-3">
                <label for="admin" class="form-label">Registrati come {{ __('amministratore') }}</label>
                <input id="admin" type="checkbox" class="form-check-input @error('admin') is-invalid @enderror" name="is_admin" value="1">

                @error('admin')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-login">Registrati</button>
            </div>
        </form>
    </div>
</div>


<style>
.card-login {
    background: rgba(255, 255, 255, 0.8);
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 40%;
    margin-top: 70px;
    margin-right: 200px;
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
</style>
@endsection
