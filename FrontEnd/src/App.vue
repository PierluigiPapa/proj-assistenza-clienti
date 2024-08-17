<script>
import AppHeader from './components/Header/AppHeader.vue';
import AppJumbo from './components/Main/AppJumbo.vue';
import AppServices from './components/Main/AppServices.vue';
import AppFooter from './components/Footer/AppFooter.vue';



export default {
    components: {
        AppHeader,
        AppJumbo,
        AppServices,
        AppFooter,

    }
}
</script>

<template>

    <AppHeader/>
    <AppJumbo/>
    <AppServices/>
    <AppFooter/>

</template>

<style lang="scss" scoped>
@use "./styles/general.scss" as *;

</style>