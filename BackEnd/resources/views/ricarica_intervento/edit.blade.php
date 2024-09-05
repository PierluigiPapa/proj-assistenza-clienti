@extends('layouts.app')

@section('content')

<main>
    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="card" style="width: 50%">
                <div class="card-body">
                    <h3 class="card-title text-center">Effettua una modifica alla ricarica</h3>
                    <form id="payment-form" method="POST" action="{{ route('handlePayment') }}">
                        @csrf
                        <input type="hidden" name="IDLogin" value="{{$user->id}}">
                        <input type="hidden" id="ore" name="ore" value="">
                        <input type="hidden" name="payment_method_nonce">

                        <!-- Aggiungi il menu a tendina per le opzioni di ricarica -->
                        <div class="form-group">
                            <label for="IDOpzioneRicarica"></label>
                            <select class="form-control" id="IDOpzioneRicarica" name="IDOpzioneRicarica" onchange="aggiornaOre()">
                                <option value="" disabled selected>Seleziona un'opzione di ricarica</option>
                                <option value="1" ore="6" costo="5.00">Ricarica Base - 5.00€ per 6 ore</option>
                                <option value="2" ore="12" costo="10.00">Ricarica Standard - 10.00€ per 12 ore</option>
                                <option value="3" ore="24" costo="20.00">Ricarica Avanzata - 20.00€ per 24 ore</option>
                                <option value="4" ore="48" costo="50.00">Ricarica Elite - 50.00€ per 48 ore</option>
                            </select>
                        </div>

                        <div id="payment-section" style="display: none;">
                            <div id="bt-dropin"></div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-login mt-3">Paga</button>
                            </div>
                        </div>

                        @if (session('success'))
                        <div class="alert alert-successo mt-4">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if (session('error'))
                        <div class="alert alert-errore mt-4">
                            {{ session('error') }}
                        </div>
                        @endif
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="modificaModal" tabindex="-1" aria-labelledby="modificaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modificaModalLabel">Seleziona i dati da modificare</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="modifica-form">
                    @foreach($user->movimentiRicarica as $movimento)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $movimento->id }}" id="modifica{{ $movimento->id }}">
                        <label class="form-check-label" for="modifica{{ $movimento->id }}">
                            {{ $movimento->opzione_ricarica_label }} - {{ $movimento->ore }} ore
                        </label>
                    </div>
                    @endforeach
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                <button type="button" class="btn btn-login" onclick="confermaModifiche()">Conferma</button>
            </div>
        </div>
    </div>
</div>

<script>
function aggiornaOre() {
    let select = document.getElementById('IDOpzioneRicarica');
    var ore = select.options[select.selectedIndex].getAttribute('ore');
    document.getElementById('ore').value = ore;

    // Mostra il form di pagamento quando viene selezionata un'opzione
    let paymentSection = document.getElementById('payment-section');
    if (select.value) {
        paymentSection.style.display = 'block';
        $('#modificaModal').modal('show'); // Mostra il modal
    } else {
        paymentSection.style.display = 'none';
    }
}

function confermaModifiche() {
    // Nascondi il modal
    $('#modificaModal').modal('hide');
    // Mostra il form di pagamento
    document.getElementById('payment-section').style.display = 'block';
}

let form = document.querySelector('#payment-form');
braintree.dropin.create({
    authorization: 'sandbox_v2smmr6x_6xqmd4knh2cjrrz9',
    container: '#bt-dropin',
    locale: 'it' // Imposta la lingua italiana
}, function (createErr, instance) {
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        instance.requestPaymentMethod(function (err, payload) {
            document.querySelector('input[name="payment_method_nonce"]').value = payload.nonce;
            form.submit();
        });
    });
});
</script>

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

    .alert-successo {
        background-color: rgb(40, 184, 40);
        color: black
    }

    .alert-errore {
        background-color: rgb(255, 65, 65);
        color: black
    }


</style>


@endsection
