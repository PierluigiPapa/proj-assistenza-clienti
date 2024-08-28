@extends('layouts.app')

@section('content')

<main>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <a href="{{ route('tipi_intervento.create') }}" class="btn btn-login me-5">Crea</a>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-3">
            <table class="table mt-3" style="width: 70%;">
                <thead>
                    <tr class="text-center fs-5">
                        <th scope="col">ID</th>
                        <th scope="col">Livello</th>
                        <th scope="col">Costo</th>
                        <th scope="col">Intervento</th>
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($interventi as $intervento)
                    <tr class="text-center">
                        <th scope="row">{{ $intervento->id }}</th>
                        <td>{{ $intervento->tipologia }}</td>
                        <td>{{ $intervento->intervento_gratuito == 0 ? 'Gratuito' : 'A pagamento' }}</td>
                        <td>{{ $intervento->dettagli }}</td>
                        <td>
                            <a href="#" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#interventoModal{{ $intervento->id }}"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('tipi_intervento.edit', $intervento->id) }}" class="btn btn-success"><i class="fa-solid fa-pen"></i></a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $intervento->id }}"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>

                    <!-- Modal Dettagli -->
                    <div class="modal fade" id="interventoModal{{ $intervento->id }}" tabindex="-1" aria-labelledby="interventoModalLabel{{ $intervento->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="card" style="width: 100%;">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h1 class="card-title text-center">Dettagli del tipo di intervento</h1>
                                                    <h3 class="card-title text-center mt-4 mb-4">{{ $intervento->dettagli }}</h3>
                                                    <p class="card-text">Livello: {{ $intervento->tipologia }}</p>
                                                    <p class="card-text">Costo: {{ $intervento->intervento_gratuito == 0 ? 'Gratuito' : 'A pagamento' }}</p>
                                                    <p class="card-text">Tipo di intervento inserito {{ ucfirst($intervento->created_at->setTimezone('Europe/Rome')->locale('it')->isoFormat('dddd DD-MM-YYYY')) }}
                                                        ore {{ $intervento->created_at->setTimezone('Europe/Rome')->format('H:i:s') }}</p>
                                                    <p class="card-text">Tipologia di ricarica modificata {{ ucfirst($intervento->updated_at->setTimezone('Europe/Rome')->locale('it')->isoFormat('dddd DD-MM-YYYY')) }}
                                                        ore {{ $intervento->updated_at->setTimezone('Europe/Rome')->format('H:i:s') }}</p>
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
                    <div class="modal fade" id="deleteModal{{ $intervento->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $intervento->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $intervento->id }}">Conferma Eliminazione</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Sei sicuro di voler eliminare il tipo di <span class="fw-bold">{{$intervento->dettagli}}</span>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                    <form action="{{ route('tipi_intervento.destroy', $intervento->id) }}" method="POST" style="display:inline;">
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
