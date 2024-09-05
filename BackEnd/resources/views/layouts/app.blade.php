<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    {{-- Fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
    <script src="https://js.braintreegateway.com/web/dropin/1.30.1/js/dropin.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <div class="logo_laravel">
                        </svg>
                    </div>
                    {{-- config('app.name', 'Laravel') --}}
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="http://localhost:5174/">{{ __('Home') }}</a>
                        </li>
                        <li class="nav-item">
                            @auth
                            @if (!Auth::user()->isAdmin())
                            <a class="nav-link" href="{{ route('account.show') }}">{{ __('Area Utente') }}</a>
                            @endif
                            @endauth
                        </li>

                        <li class="nav-item">
                            @auth
                            @if (Auth::user()->isAdmin())
                            <a class="nav-link" href="{{ route('account.show') }}">{{ __('Area Admin') }}</a>
                            @endif
                            @endauth
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Accedi') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->nome }} {{ Auth::user()->cognome }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('dashboard') }}">{{__('Dashboard')}}</a>
                                <a class="dropdown-item" href="{{ url('profile') }}">{{__('Profilo')}}</a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                @auth
                <!-- Sidebar per l'amministratore -->
                @if (Auth::user()->isAdmin())
                <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar">
                    <div class="position-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active nav-sidebar" aria-current="page" href="/index">
                                    <i class="fas fa-home"></i>
                                    Indice
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-sidebar" href="/logins">
                                    <i class="fas fa-user"></i>
                                    Tabella Utenti
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-sidebar" href="/opzioni_ricarica">
                                    <i class="fas fa-battery-full"></i>
                                    Tabella Ricariche
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-sidebar" href="/tipi_intervento">
                                    <i class="fas fa-tools"></i>
                                    Tabella Interventi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-sidebar" href="/dettagli_conto">
                                    <i class="fas fa-wallet"></i>
                                    Tabella Saldo
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                @endif

                <!-- Sidebar per l'utente normale -->
                @if (!Auth::user()->isAdmin())
                <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar">
                    <div class="position-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active nav-sidebar" aria-current="page" href="/area_utente">
                                    <i class="fas fa-user-circle"></i>
                                    Area Utente
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-sidebar" href="/profilo">
                                    <i class="fas fa-id-badge"></i>
                                    Il Mio Profilo
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-sidebar" href="/ordini">
                                    <i class="fas fa-shopping-cart"></i>
                                    I Miei Ordini
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-sidebar" href="/supporto">
                                    <i class="fas fa-headset"></i>
                                    Supporto
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                @endif
                @endauth

                <!-- Spazio per il contenuto principale -->
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
</body>

<style>
    nav {
        background-color: #95A5A6;
    }

    .nav-link {
        color: black;
    }


    #sidebar {
        background-color: #091c2e;
        height: 100vh;
        position: fixed;
        left: 0;
    }

    .nav-sidebar {
        color: white;
    }

    .nav-sidebar:hover {
        color: gray;
    }

    main {
        margin-left: 220px;
    }
</style>


</html>
