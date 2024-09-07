@extends('layouts.app')

@section('content')

<main>
    <div class="container margin">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="card mt-3" style="width:50%;">
                <div class="card-body">
                    <h3 class="card-title text-dark text-center mb-5">Effettua una ricarica</h3>

                    <form id="payment-form" method="POST" action="{{ route('braintree.process') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="opzione_ricarica_id" class="form-label"></label>
                            <option value="" disabled selected>Seleziona una modalità di pagamento</option>
                            <select name="IDOpzioneRicarica" class="form-select" required>
                                @foreach($opzioni as $opzione)
                                    <option value="{{ $opzione->id }}">{{ $opzione->descrizione }} - {{ $opzione->costo }}€</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="dropin-container"></div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-login">Ricarica</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <button class="btn btn-back mt-5">
                <a href="/account">Torna Indietro</a>
            </button>
        </div>
    </div>
</main>

<script src="https://js.braintreegateway.com/web/dropin/1.32.0/js/dropin.min.js"></script>
<script>
    let form = document.querySelector('#payment-form');

    braintree.dropin.create({
        authorization: 'sandbox_v2smmr6x_6xqmd4knh2cjrrz9',
        selector: '#dropin-container'
    }, function (err, dropinInstance) {
        if (err) {
            console.error(err);
            return;
        }

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            dropinInstance.requestPaymentMethod(function (err, payload) {
                if (err) {
                    console.error(err);
                    return;
                }

                // Add the nonce to the form and submit
                var nonceInput = document.createElement('input');
                nonceInput.setAttribute('type', 'hidden');
                nonceInput.setAttribute('name', 'payment_method_nonce');
                nonceInput.setAttribute('value', payload.nonce);
                form.appendChild(nonceInput);

                form.submit();
            });
        });
    });
</script>
@endsection
