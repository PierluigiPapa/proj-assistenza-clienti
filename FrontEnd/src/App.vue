<script>
import AppHeader from './components/Header/AppHeader.vue';
import AppJumbo from './components/Main/AppJumbo.vue';


export default {
    components: {
        AppHeader,
        AppJumbo
    }
}
</script>

<template>

    <AppHeader/>
    <AppJumbo/>

</template>

<style lang="scss" scoped>
@use "./styles/general.scss" as *;

</style>