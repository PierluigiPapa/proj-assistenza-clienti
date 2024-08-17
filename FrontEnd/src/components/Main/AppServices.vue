<script>
export default {
    name: 'AppServices',
}

</script>

<template>
    <div class="container">
        <div class="row d-flex justify-content-center mt-5 mb-5">
            <h1 class="text-light text-center text-service">I nostri servizi</h1>
            <div class="col-4 mt-5 me-5 text-center">
                <div class="d-flex flex-column align-items-center">
                    <h3 class="text-light mb-3">Manutenzione correttiva</h3>
                    <font-awesome-icon icon="fa-solid fa-bug" class="icon mt-3"/>
                    <ul class="mt-5 me-5 ms-5 text-light fs-6 list-unstyled">
                        <li class="mb-2">Risoluzione di bug e malfunzionamenti</li>
                        <li>Correzione di errori di sistema e applicativi</li>
                    </ul>
                </div>
            </div>

            <div class="col-4 mt-5 me-5 text-center">
                <div class="d-flex flex-column align-items-center">
                    <h3 class="text-light mb-3">Manutenzione evolutiva</h3>
                    <font-awesome-icon icon="fa-solid fa-rocket" class="icon mt-3"/>
                    <ul class="mt-5 me-5 ms-5 text-light fs-6 list-unstyled">
                        <li class="mb-2">Aggiornamento e implementazione di nuove funzionalità</li>
                        <li>Adattamento del software a nuove esigenze aziendali</li>
                    </ul>
                </div>
            </div>

            <div class="col-4 mt-5 me-5 text-center">
                <div class="d-flex flex-column align-items-center">
                    <h3 class="text-light mb-3">Supporto tecnico</h3>
                    <font-awesome-icon icon="fa-solid fa-headset" class="icon mt-3"/>
                    <ul class="mt-5 me-5 ms-5 text-light fs-6 list-unstyled">
                        <li class="mb-2">Assistenza telefonica o via email per risoluzione di problemi</li>
                        <li>Supporto remoto per diagnosi e risoluzione di problemi</li>
                    </ul>
                </div>
            </div>

            <div class="col-4 mt-5 me-5 text-center">
                <div class="d-flex flex-column align-items-center">
                    <h3 class="text-light mb-3">Help Desk</h3>
                    <font-awesome-icon icon="fa-solid fa-comment" class="icon mt-3"/>
                    <ul class="mt-5 me-5 ms-5 text-light fs-6 list-unstyled">
                        <li class="mb-2">Servizio di primo livello per assistenza immediata</li>
                        <li>Gestione delle richieste di supporto e delle escalation</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col d-flex justify-content-center align-items-center">
                <button class="btn btn-service me-3"> <a href="" class="fw-bold no-color fs-5">Scopri i nostri servizi</a></button>
            </div>
        </div>
    </div>
</template>


<style lang="scss">

.text-service {
    font-size: 60px;
    font-weight: bold;
}

.icon {
    font-size: 90px;
    color:white;
}

.no-color {
    color: inherit;
    text-decoration: none;
}

.btn-service {
    background-color: #1ABC9C;
    border: 2px solid black;
    color: black;
}

.btn-service:hover {
    background-color: #093c32;
    border: 2px solid white;
    transition: background-color 0.3s, color 0.3s, filter 0.3s;
    color: white;
}
</style>