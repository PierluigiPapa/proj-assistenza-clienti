<script>
export default {
    name: 'AppHeader',
}
</script>

<template>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand ms-5">TechGuard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Chi siamo</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">I nostri servizi</a>
                </li>
            </ul>
        </div>

       
        <div class="ml-auto me-5 button">
            <button class="btn me-3"> <a href="http://127.0.0.1:8000/login">Accedi</a></button>
            <button class="btn"><a href="http://127.0.0.1:8000/register">Registrati</a></button>
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

.btn {
    background-color: #3498DB;
    border: 2px solid white;
}

.btn:hover {
    background-color: #194665;
    transition: background-color 0.3s, color 0.3s, filter 0.3s;
    border: 2px solid white;
}


</style>