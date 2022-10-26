import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler.js';
import AppHome from "./Components/AppHome.vue";
import router from './Routes/router';
import Notifications from '@kyvg/vue3-notification'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
const options = {
    confirmButtonColor: '#41b882',
    cancelButtonColor: '#ff7674',
};
createApp({
    components: {
        AppHome: AppHome
    }
}).use(router).use(Notifications).use(VueSweetalert2,options).mount('#app')

