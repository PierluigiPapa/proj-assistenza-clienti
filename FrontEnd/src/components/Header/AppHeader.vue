<script>
import { RouterLink } from 'vue-router';

export default {
    name: 'AppHeader',
}
</script>

<template>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand ms-5">TechGuard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item active">
                    <router-link :to="{ name: 'home' }" class="nav-link">Home</router-link>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Chi siamo</a>
                </li>

                <li class="nav-item">
                    <router-link :to="{name: 'servizi'}" class="nav-link">I nostri servizi</router-link>
                </li>
            </ul>
        </div>

        <div class="ms-auto me-5 button">
            <a href="http://127.0.0.1:8000/login" class="btn btn-login me-3">Accedi</a>
            <a href="http://127.0.0.1:8000/register" class="btn btn-login">Registrati</a>
        </div>
    </nav>
</template>

<style lang="scss">
@use "../../styles/partials/variables.scss" as *;

nav {
    background-color: #95A5A6;
}

.nav-link, 
.navbar-brand {
    color: black;
}


a {
    text-decoration: none;
    color: white;
}

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
