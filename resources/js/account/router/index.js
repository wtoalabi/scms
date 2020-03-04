import Vue from 'vue';
import VueRouter from 'vue-router';
import Store from '../store';
import Overview from '../pages/Overview/Overview';
Vue.use(VueRouter);
const router = new VueRouter({
    mode: 'hash',
    routes: [
        {
            path: '/',
            component: Overview,
            name: 'Overview',
            beforeEnter(to, from, next) {
                //Store.dispatch('getContent');
                next()
            }
        },
    ]
});
router.beforeEach((to, from, next) => {
    /*Store.commit("resetQueryState");
    Store.commit("commitTransitioning",true)
    setTimeout(()=>{
        Store.commit("commitTransitioning", false)
    },300);*/
    Store.commit('setTitle', to.name);
    next()
});
export default router
