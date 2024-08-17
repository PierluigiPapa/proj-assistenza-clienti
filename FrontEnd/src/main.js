import './styles/general.scss'


import 'bootstrap/dist/js/bootstrap.bundle.js';

import { createApp } from 'vue'
import App from './App.vue'

import { library } from "@fortawesome/fontawesome-svg-core";

import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faFacebook } from '@fortawesome/free-brands-svg-icons';
import { faBug, faRocket,faHeadset, faComment } from '@fortawesome/free-solid-svg-icons';

library.add(faFacebook, faBug, faRocket, faHeadset, faComment)

createApp(App).component("font-awesome-icon", FontAwesomeIcon).mount("#app");
