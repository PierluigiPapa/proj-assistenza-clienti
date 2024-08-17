import { createRouter, createWebHistory } from 'vue-router';

import AppOurService from './pages/AppOurService.vue';
import AppMain from './components/Main/AppMain.vue';


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
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export { router };