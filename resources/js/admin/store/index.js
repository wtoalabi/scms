import Vue from 'vue';
import Vuex from 'vuex';
import actions from '../store/actions';
import mutations from '../store/mutators/index';
import state from "./state";
Vue.use(Vuex);

export  default new Vuex.Store({
    actions,
    mutations,
    state
});
