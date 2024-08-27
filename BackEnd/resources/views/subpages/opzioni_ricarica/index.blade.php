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
                            <a href="{{ route('opzioni_ricarica.show', $opzione->id) }}" class="btn btn-secondary"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('opzioni_ricarica.edit', $opzione->id) }}" class="btn btn-success"><i class="fa-solid fa-pen"></i></a>
                            <form action="{{ route('opzioni_ricarica.destroy', $opzione->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
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
