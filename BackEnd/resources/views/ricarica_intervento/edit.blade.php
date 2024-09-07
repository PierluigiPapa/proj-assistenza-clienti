@extends('layouts.app')

@section('content')

<main>
    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="card" style="width: 50%;">
                <div class="card-body">
                    <h3 class="card-title text-center">Ricarica il tuo intervento</h3>

                    <form id="payment-form" method="POST" action="{{ route('braintree.process') }}">
                        @csrf
                        <input type="hidden" name="IDLogin" value="{{ $user->id }}">
                        <input type="hidden" id="ore" name="ore" value="">
                        <input type="hidden" name="payment_method_nonce">

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
                            <div class="alert alert-success mt-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger mt-4">
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
</main>

<script>
    function updateOre() {
        let select = document.getElementById('IDOpzioneRicarica');
        var ore = select.options[select.selectedIndex].getAttribute('ore');
        document.getElementById('ore').value = ore;

        let paymentSection = document.getElementById('payment-section');
        if (select.value) {
            paymentSection.style.display = 'block';
        } else {
            paymentSection.style.display = 'none';
        }

        console.log("Ore selezionate: " + ore);  // Debug
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

    .alert-success {
        background-color: rgb(40, 184, 40);
        color: black;
    }

    .alert-danger {
        background-color: rgb(255, 65, 65);
        color: black;
    }
</style>

@endsection
