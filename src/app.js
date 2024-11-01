import Vue from 'vue';
import Setup from './components/Setup.vue';
window.axios = require("axios");
window.Qs = require('qs');
import VueToast from 'vue-toast-notification';
//import 'vue-toast-notification/dist/theme-default.css';
import 'vue-toast-notification/dist/theme-sugar.css';

Vue.use(VueToast);
new Vue({
    el: '#sdevs_sms_setup',
    components: { Setup }
});