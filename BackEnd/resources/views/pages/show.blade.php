@extends('layouts.app')

@section('content')

 <main>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-center align-items-center mt-5 mb-5">
                    <div class="card" style="width: 60rem;">
                        <div class="card-body">
                            <div class="r">
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
                            <div class="col-12 d-flex justify-content-center align-items-center mt-5">
                                <div class="card" style="width: 50%">
                                    <div class="card-body">
                                        <h3 class="card-title text-center">Inserisci una ricarica</h3>

                                        <form id="payment-form" method="POST" action="{{ route('processPayment') }}">
                                            @csrf

                                            <input type="hidden" name="IDLogin" value="{{$user->id}}">
                                            <input type="hidden" id="ore" name="ore" value="">
                                            <input type="hidden" name="payment_method_nonce">

                                            <!-- Menu a tendina per le opzioni di ricarica -->
                                                <div class="form-group">
                                                    <label for="IDOpzioneRicarica"></label>
                                                    <select class="form-control" id="IDOpzioneRicarica" name="IDOpzioneRicarica" onchange="updateOre()">
                                                        <option value="" disabled selected>Seleziona un'opzione di ricarica</option>
                                                        <option value="1" ore="6" costo="5.00">Ricarica Base - 5.00€ per 6 ore</option>
                                                        <option value="2" ore="12" costo="10.00">Ricarica Standard - 10.00€ per 12 ore</option>
                                                        <option value="3" ore="24" costo="20.00">Ricarica Avanzata - 20.00€ per 24 ore</option>
                                                        <option value="4" ore="48" costo="50.00">Ricarica Elite - 50.00€ per 48 ore</option>
                                                    </select>
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

                                                <div id="payment-section" style="display: none;">
                                                    <div id="bt-dropin"></div>
                                                    <div class="d-flex justify-content-center">
                                                        <button type="submit" class="btn btn-login mt-3">Paga</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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
