@extends('layouts.app')

@section('content')

<div class="background-login d-flex justify-content-center align-items-center">
    <div class="card-login">
        <div class="container">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Nome') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Indirizzo email') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
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

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-login">Registrati</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.background-login {
    background-image: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), url('/images/Immagine_3.jpg');
    background-size: cover;
    background-position: center;
    height: 100vh;
}

.card-login {
    background: rgba(255, 255, 255, 0.8);
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 40%;
    margin: auto;
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
