@extends('layouts.app')

@section('content')

<main>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-center align-items-center mt-5">
                    <div class="card" style="width: 50rem;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h1 class="card-title text-center">Dettagli utente</h1>
                                    <h3 class="card-subtitle mb-2 text-center mt-3">{{$user->username}}</h3>
                                    <p class="card-text">Nome: {{$user->nome}}</p>
                                    <p class="card-text">Cognome: {{$user->cognome}}</p>
                                    <p class="card-text">Creato il: {{$user->created_at->setTimezone('Europe/Rome')->format('d-m-Y H:i:s')}}</p>
                                    <p class="card-text">Aggiornato il: {{$user->updated_at->setTimezone('Europe/Rome')->format('d-m-Y H:i:s')}}</p>
                                    <p class="card-text">Saldo disponibile: {{$user->dettagliConto->saldo}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
function updateOre() {
    let select = document.getElementById('IDOpzioneRicarica');
    var ore = select.options[select.selectedIndex].getAttribute('ore');
    document.getElementById('ore').value = ore;

    // Mostra il form di pagamento quando viene selezionata un'opzione
    let paymentSection = document.getElementById('payment-section');
    if (select.value) {
        paymentSection.style.display = 'block';
    } else {
        paymentSection.style.display = 'none';
    }
}

let form = document.querySelector('#payment-form');
braintree.dropin.create({
    authorization: 'sandbox_v2smmr6x_6xqmd4knh2cjrrz9',
    container: '#bt-dropin',
    locale: 'it'
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
