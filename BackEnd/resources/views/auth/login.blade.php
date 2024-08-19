@extends('layouts.app')

@section('content')
    <div class="background-login d-flex justify-content-center align-items-center">
        <div class="card-login">
            <div class="container">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Username') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')

                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
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
                        <button type="submit" class="btn btn-primary">Accedi</button>
                    </div>

                    @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Hai dimenticato la password?') }}
                    </a>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <style>
    .background-login {
        background-image: url('/images/Immagine_3.jpg');
        background-size: cover;
        background-position: center;
        height: 100vh;
    }

    .card-login {
        background: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 8px;
         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    </style>
@endsection
