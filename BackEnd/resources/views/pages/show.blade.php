@extends('layouts.app')

@section('content')

<main>
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="d-flex justify-content-center align-items-center mt-5">
            <div class="card" style="width: 30rem;">
                <div class="card-body">
                  <h3 class="card-title text-center">Dettagli utente</h3>
                  <h4 class="card-subtitle mb-2 text-center mt-3">{{$user->username}}</h4>
                  <p class="card-text">Nome: {{$user->nome}}</p>
                  <p class="card-text">Cognome: {{$user->cognome}}</p>
                  <p class="card-text">Creato il: {{$user->created_at->setTimezone('Europe/Rome')->format('d-m-Y H:i:s')}}</p>
                  <p class="card-text">Aggiornato il: {{$user->updated_at->setTimezone('Europe/Rome')->format('d-m-Y H:i:s')}}</p>
                  <p class="card-text" id="data_scadenza_display">Data di scadenza: </p>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center mt-5">
            <div class="card" style="width: 30rem;">
                <div class="card-body">
                    <h3 class="card-title text-center">Pagamento</h3>
                    <form id="payment-form" method="POST" action="{{ route('processPayment') }}">
                        @csrf
                        <input type="hidden" name="IDLogin" value="{{$user->id}}">
                        <input type="hidden" name="payment_method_nonce">
                        <input type="hidden" name="data_scadenza" id="data_scadenza">

                        <!-- Aggiungi il menu a tendina per le opzioni di ricarica -->
                        <div class="form-group">
                            <label for="IDOpzioneRicarica">Seleziona un'opzione di ricarica:</label>
                            <select class="form-control" id="IDOpzioneRicarica" name="IDOpzioneRicarica" onchange="calcolaDataScadenza()">
                                <option value="1" data-ore="6" data-costo="5.00">Ricarica Base - 5.00€ per 6 ore</option>
                                <option value="2" data-ore="12" data-costo="10.00">Ricarica Standard - 10.00€ per 12 ore</option>
                                <option value="3" data-ore="24" data-costo="20.00">Ricarica Avanzata - 20.00€ per 24 ore</option>
                                <option value="4" data-ore="48" data-costo="50.00">Ricarica Elite - 50.00€ per 48 ore</option>
                            </select>
                        </div>

                        <div id="bt-dropin"></div>
                        <button type="submit" class="btn btn-primary mt-3">Paga</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function calcolaDataScadenza() {
        let select = document.getElementById('IDOpzioneRicarica');
        let ore = select.options[select.selectedIndex].getAttribute('data-ore');
        let costo = select.options[select.selectedIndex].getAttribute('data-costo');
        let dataScadenza = new Date();
        dataScadenza.setHours(dataScadenza.getHours() + parseInt(ore));

        let dataScadenzaInput = document.getElementById('data_scadenza');
        dataScadenzaInput.value = dataScadenza.toISOString().slice(0, 19).replace('T', ' ');

        // Visualizza la data di scadenza e il costo nella card dei dettagli utente
        let dataScadenzaDisplay = document.getElementById('data_scadenza_display');
        dataScadenzaDisplay.textContent = 'Data di scadenza: ' + dataScadenza.toLocaleString() + ' - Costo: ' + costo + '€';
    }

    let form = document.querySelector('#payment-form');
    braintree.dropin.create({
        authorization: 'sandbox_v2smmr6x_6xqmd4knh2cjrrz9',
        container: '#bt-dropin'
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

@endsection
