@extends('layouts.app')

@section('content')

<main>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <a href="{{ route('opzioni_ricarica.create') }}" class="btn btn-login me-5">Crea</a>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-3">
            <table class="table mt-3" style="width: 70%;">
                <thead>
                    <tr class="text-center fs-5">
                        <th scope="col">ID</th>
                        <th scope="col">Tipologia</th>
                        <th scope="col">Costo</th>
                        <th scope="col">Ore</th>
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($opzioni as $opzione)
                    <tr class="text-center">
                        <th scope="row">{{ $opzione->id }}</th>
                        <td>{{ $opzione->descrizione }}</td>
                        <td>{{ number_format($opzione->costo, 2, ',', '.') }} €</td>
                        <td>{{ sprintf('%01d', $opzione->ore) }}</td>
                        <td>
                            <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#opzioneModal{{ $opzione->id }}"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('opzioni_ricarica.edit', $opzione->id) }}" class="btn btn-success"><i class="fa-solid fa-pen"></i></a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $opzione->id }}"><i class="fa-solid fa-trash"></i></button>
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Dettagli -->
                    <div class="modal fade" id="opzioneModal{{ $opzione->id }}" tabindex="-1" aria-labelledby="opzioneModalLabel{{ $opzione->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="card" style="width: 100%;">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h1 class="card-title text-center">Dettagli della ricarica</h1>
                                                    <p class="card-text">Tipologia: {{$opzione->descrizione}}</p>
                                                    <p class="card-text">Costo: {{ number_format($opzione->costo, 2, ',', '.') }} €</p>
                                                    <p class="card-text">Ore: {{ sprintf('%01d', $opzione->ore) }}</p>
                                                    <p class="card-text">Tipologia di ricarica inserita {{ ucfirst($opzione->created_at->setTimezone('Europe/Rome')->locale('it')->isoFormat('dddd DD-MM-YYYY')) }}
                                                        ore {{ $opzione->created_at->setTimezone('Europe/Rome')->format('H:i:s') }}
                                                    </p>
                                                    <p class="card-text">Tipologia di ricarica modificata {{ ucfirst($opzione->updated_at->setTimezone('Europe/Rome')->locale('it')->isoFormat('dddd DD-MM-YYYY')) }}
                                                        ore {{ $opzione->updated_at->setTimezone('Europe/Rome')->format('H:i:s') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Delete -->
                    <div class="modal fade" id="deleteModal{{ $opzione->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $opzione->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $opzione->id }}">Conferma Eliminazione</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Sei sicuro di voler eliminare <span class="fw-bold">{{$opzione->descrizione}}</span>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                    <form action="{{ route('opzioni_ricarica.destroy', $opzione->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Elimina</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>

<style>
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
