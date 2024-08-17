<script>
import AppHeader from './components/Header/AppHeader.vue';
import AppJumbo from './components/Main/AppJumbo.vue';
import AppServices from './components/Main/AppServices.vue';



export default {
    components: {
        AppHeader,
        AppJumbo,
        AppServices,

    }
}
</script>

<template>

    <AppHeader/>
    <AppJumbo/>
    <AppServices/>

</template>

<style lang="scss" scoped>
@use "./styles/general.scss" as *;

</style>