import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {path: '/', component: require('../Dashboard.vue')},
    {path: '/currencies', component: require('../Currencies.vue')},
    {path: '/transactions', component: require('../Dashboard.vue')},
    {path: '*', redirect: '/'} // 404
  ],
  scrollBehavior (to, from, savedPosition) {
    return !savedPosition ? { x: 0, y: 0 } : savedPosition
  }
});
