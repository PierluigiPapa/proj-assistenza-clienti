@extends('layouts.app')

@section('content')

<div class="container d-flex justify-content-center align-items-center">
    <div class="card-login p-4 shadow-lg rounded">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="username" class="form-label">{{ __('Username') }}</label>
                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">{{ __('Ricordami') }}</label>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-login">Accedi</button>
            </div>

            @if (Route::has('password.request'))
            <div class="text-center mt-3">
                <a class="btn btn-link text-dark" href="{{ route('password.request') }}">
                    {{ __('Hai dimenticato la password?') }}
                </a>
            </div>
            @endif
        </form>
    </div>
</div>

<style>
.card-login {
    background: rgba(255, 255, 255, 0.8);
    margin-top: 150px;
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
