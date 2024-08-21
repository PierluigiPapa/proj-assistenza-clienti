import { createRouter, createWebHistory } from 'vue-router';

import AppOurService from './pages/AppOurService.vue';
import AppMain from './components/Main/AppMain.vue';
import AppUser from './pages/AppUser.vue';


const routes = [
    {
        path: '/',
        name: 'home',
        component: AppMain
    },
    {
        path: '/servizi',
        name: 'servizi',
        component: AppOurService
    },
    {
        path: '/user',
        name: 'utente',
        component: AppUser
    },
    
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export { router };