import Vue from 'vue';
import VueRouter from 'vue-router';
import Store from '../store';
import Overview from '../pages/Overview/Overview';
import contacts from "./contacts";
import emails from "./emails";
import groups from "./groups";
import sms from "./sms";
import settings from "./settings";
Vue.use(VueRouter);
const router = new VueRouter({
    mode: 'hash',
    routes: [
        {
            path: '/',
            component: Overview,
            name: 'Overview',
            /*beforeEnter(to, from, next) {
                //Store.dispatch('getContent');
                next()
            }*/
            meta: {
                id: 'dashboard',
                parents:[]
            },
        },
        ...contacts,
        ...emails,
        ...groups,
        ...sms,
        ...settings
    ]
});
router.beforeEach((to, from, next) => {
    console.log(to)
    Store.commit("resetQueryState");
    Store.commit("commitBreadcrumbs", to.meta);
    Store.commit('setTitle', to.name);
    next()
});
export default router
