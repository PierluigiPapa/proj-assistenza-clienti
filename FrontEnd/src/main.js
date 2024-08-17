import './styles/general.scss'


import 'bootstrap/dist/js/bootstrap.bundle.js';

import { createApp } from 'vue'
import App from './App.vue'

import { library } from "@fortawesome/fontawesome-svg-core";

import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faBug, faRocket,faHeadset, faComment } from '@fortawesome/free-solid-svg-icons';
import { faFacebookSquare, faInstagramSquare, faLinkedin, faSquareXTwitter,  } from '@fortawesome/free-brands-svg-icons';

library.add(faBug, faRocket, faHeadset, faComment, faFacebookSquare, faSquareXTwitter, faInstagramSquare, faLinkedin)

createApp(App).component("font-awesome-icon", FontAwesomeIcon).mount("#app");
