require('./bootstrap');
import 'swiper/dist/css/swiper.css'

import Vue from 'vue';
import VueResource from 'vue-resource';
import SelectPatientForCallDoctor from './AdminComponents/selectPatientForCallDoctor'

Vue.use(VueResource);

Vue.http.options.emulateJSON = true;


export const Events = new Vue({});


Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

const app = new Vue({
    el: '#app',

    components: {
        VueResource,
        SelectPatientForCallDoctor
    }
});