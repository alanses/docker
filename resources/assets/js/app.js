require('./bootstrap');
import 'swiper/dist/css/swiper.css'

import Vue from 'vue';
import VueResource from 'vue-resource';
import { swiper, swiperSlide } from 'vue-awesome-swiper'
import SliderVue from './FrontendComponents/SliderComponent.vue'
import VueAwesomeSwiper from 'vue-awesome-swiper/dist/ssr'
import MapsVue from './FrontendComponents/MapsComponent.vue'
import CallDoctorToHomeVue from './FrontendComponents/CallDoctorToHomeComponent.vue'
import UserCabinet from './FrontendComponents/UserCabinetComponent.vue'
import SelectDataAboutRegistrationToDoctor from './FrontendComponents/SelectDataAboutRegistrationToDoctor.vue'

import DoctorCabinet from './FrontendComponents/DoctorCabinetComponent.vue'
import ReceptionToDoctor from './FrontendComponents/ReceptionToDoctorComponent.vue'
import ResultSearchComponent from './FrontendComponents/ResultSearchComponent.vue'
import SearchComponent from './FrontendComponents/SearchComponent.vue'
import Datepicker from 'vuejs-datepicker';
import {en, es} from 'vuejs-datepicker/dist/locale'
import * as uiv from 'uiv'

Vue.use(VueAwesomeSwiper)
Vue.use(VueResource);
Vue.use(uiv)

Vue.http.options.emulateJSON = true;


export const Events = new Vue({});


Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

const app = new Vue({
    el: '#app',

    components: {
        swiper,
        swiperSlide,
        SliderVue,
        MapsVue,
        CallDoctorToHomeVue,
        VueResource,
        UserCabinet,
        DoctorCabinet,
        SelectDataAboutRegistrationToDoctor,
        ReceptionToDoctor,
        Datepicker,
        en,
        es,
        SearchComponent,
        ResultSearchComponent
    }
});