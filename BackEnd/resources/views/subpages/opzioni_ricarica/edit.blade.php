@extends('layouts.app')

@section('content')

<main>
    <div class="container mt-5 mb-5 margin">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="card mt-5" style="width: 50%;">
                <div class="card-body">
                    <h3 class="card-title text-center mb-5">Modifica l'opzione di ricarica</h3>

                    <form action="{{ route('opzioni_ricarica.update', $opzione->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="" class="form-label">Seleziona l'opzione da modificare</label>
                            <select class="form-select" name="opzione_id" aria-label="Default select example">
                                @foreach($opzioni as $opzione)
                                <option value="{{ $opzione->id }}" {{ $opzione->id == $opzione->id ? 'selected' : '' }}>{{ $opzione->descrizione }}</option>
                                @endforeach
                            </select>

                            <div class="mb-3 mt-3">
                                <label for="exampleInputPassword1" class="form-label">Cambia il nome della tipologia di ricarica</label>
                                <input type="text" class="form-control" id="" name="descrizione" value="">
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Cambia la quantità di ore</label>
                                <input type="number" class="form-control" id="" name="ore" min="0" max="48" value="{{$opzione->ore}}">
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Cambia l'importo della ricarica</label>
                                <input type="number" class="form-control" id="exampleInputPassword1" step="0.01" placeholder="0.00 €" min="0" name="costo" value="{{ $opzione->costo }}">
                            </div>

                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-login">Modifica</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <button class="btn btn-back mt-5">
                    <a href="/opzioni_ricarica">Torna Indietro</a>
                </button>
            </div>
        </div>
    </div>
</main>



@endsection
