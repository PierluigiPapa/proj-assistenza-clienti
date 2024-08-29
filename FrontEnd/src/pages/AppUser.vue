<script>
import axios from 'axios';
import { initializeDropin, requestPaymentMethod } from '../payment.js';
import { store } from '../store.js';

export default {
  name: 'AppUser',
  data() {
    return {
      dropinInstance: null,
      selectedOption: null,
      selectedHours: null,
      movimentoId: 1,
    };
  },
  mounted() {
  initializeDropin('#dropin-container', 'sandbox_jy6vfhf7_6xqmd4knh2cjrrz9')
    .then(instance => {
      this.dropinInstance = instance;
    })
    .catch(err => {
      console.error('Errore nell\'inizializzazione di Drop-in:', err);
    });
  },
  methods: {
    handlePayment() {
  if (!this.selectedOption || !this.selectedHours) {
    console.error('Opzione e ore non selezionate.');
    return;
  }

  if (!this.dropinInstance) {
    console.error('Drop-in non inizializzato.');
    return;
  }

  requestPaymentMethod(this.dropinInstance).then(nonce => {
    console.log('Nonce generato:', nonce);
    console.log('Dati inviati:', {
      paymentMethodNonce: nonce,
      IDLogin: 1,
      IDOpzioneRicarica: this.selectedOption,
      ore: this.selectedHours,
    });

    axios.post(`${store.apiUrlBackEnd}/api/process-payment`, {
      paymentMethodNonce: nonce,
      IDLogin: 1,
      IDOpzioneRicarica: this.selectedOption,
      ore: this.selectedHours,
    })
    .then(response => {
      console.log('Risposta dal server:', response.data);
    })
    .catch(error => {
      if (error.response) {
        console.error('Errore nella richiesta POST:', error.response.data);
      } else {
        console.error('Errore nella richiesta POST:', error.message);
      }
    });
  })
  .catch(err => {
    console.error('Errore nella generazione del nonce:', err);
  });
},

  handleOptionChange(event) {
    const selectedOption = event.target.value;
    const selectedHours = event.target.options[event.target.selectedIndex].getAttribute('ore');
    this.selectedOption = selectedOption;
    this.selectedHours = selectedHours;
    console.log('Opzione selezionata:', selectedOption);
    console.log('Ore selezionate:', selectedHours);
  }
}
}
</script>


<template>
  <div class="container mb-5">
    <div class="row">
      <div class="col">
        <div class="d-flex justify-content-center align-items-center mt-5">
          <div class="card" style="width: 60rem;">
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <h1 class="card-title text-center">Dettagli utente</h1>
                  <h3 class="card-subtitle mb-2 text-center mt-3"></h3>
                  <p class="card-text">Nome:</p>
                  <p class="card-text">Cognome:</p>
                  <p class="card-text">Creato il:</p>
                  <p class="card-text">Aggiornato il:</p>
                </div>
              </div>
              
              <div class="row mt-5">
                <div class="col-6">
                  <div class="card" style="height: 100%;">
                    <div class="card-body">
                      <h3 class="card-title text-center">Form intervento</h3>
                    </div>
                  </div>
                </div>
                
                <div class="col-6">
                  <div class="card" style="height: 100%;">
                    <div class="card-body">
                      <h3 class="card-title text-center">Inserisci una ricarica</h3>

                      <form id="ricarica-form">
                        <input type="hidden" name="IDLogin" value=""> 
                        <input type="hidden" id="ore" name="ore" value=""> 
                        
                        <div class="form-group">
                          <label for="IDOpzioneRicarica"></label>
                          <select class="form-control me-2" id="IDOpzioneRicarica" name="IDOpzioneRicarica" @change="handleOptionChange">
                            <option value="" disabled selected>Seleziona un'opzione di ricarica</option>
                            <option value="1" ore="06:00:00" costo="5.00">Ricarica Base - 5.00€ per 6 ore</option>
                            <option value="2" ore="12:00:00" costo="10.00">Ricarica Standard - 10.00€ per 12 ore</option>
                            <option value="3" ore="24:00:00" costo="20.00">Ricarica Avanzata - 20.00€ per 24 ore</option>
                            <option value="4" ore="48:00:00" costo="50.00">Ricarica Elite - 50.00€ per 48 ore</option>
                          </select>
                        </div>
                        
                        <div id="dropin-container"></div>
                        <div class="d-flex justify-content-center align-items-center">
                          <button type="button" class="btn btn-login" @click="handlePayment">Paga</button>
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
</template>

<style lang="scss">
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
