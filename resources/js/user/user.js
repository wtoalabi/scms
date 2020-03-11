import Vue from 'vue';
window.Vue = Vue;
import store from './store';
const router = require('./router/').default;
require('../bootstrap');
import 'vuetify/dist/vuetify.min.css';
import vuetify from '../plugins/vuetify.js' // path to vuetify export1
const files = require.context('./pages', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
Vue.component('default', require('../Default').default);

new Vue({
    store,
    router,
    vuetify,
}).$mount('#user');
