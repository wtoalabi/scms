import Vue from 'vue';
require('../bootstrap');
import 'vuetify/dist/vuetify.min.css';
import vuetify from '../plugins/vuetify.js' // path to vuetify export
import store from './store'
const router = require('./router/').default;
const adminFiles = require.context('./pages', true, /\.vue$/i);
adminFiles.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], adminFiles(key).default));
Vue.component('default', require('../Default').default);
window.vuetify  = vuetify;
new Vue({
    store,
    router,
    vuetify,
}).$mount('#admin');
