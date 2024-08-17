<script>
export default {
    name: 'AppFooter',
}
</script>

<template>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand ms-5 fs-6">&copy TechGuard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item active">
                    <a class="nav-link ms-5" href="#">Torna su</a>
                </li>
            </ul>
        </div>

        <div class="ml-auto me-5">
            <font-awesome-icon icon="fa-brands fa-square-facebook" class="social me-3"/>
            <font-awesome-icon icon="fa-brands fa-square-x-twitter" class="social me-3"/>
            <font-awesome-icon icon="fa-brands fa-square-instagram" class="social me-3"/>
            <font-awesome-icon icon="fa-brands fa-linkedin" class="social me-3"/>
        </div>
    </nav>
</template>

<style lang="scss">

.social {
    font-size: 30px;
    color: #194665;
}

.social:hover {
    color: #2B7DB3;
    transition: background-color 0.3s, color 0.3s, filter 0.3s;
}
    
</style>