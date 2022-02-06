//import { createRouter, createWebHistory } from 'vue-router'
import VueRouter from 'vue-router'

import Login from '../components/auth/Login.vue';
import Register from '../components/auth/Register.vue';
import Dashboard from '../components/auth/Dashboard.vue';
import App from '../components/App.vue';
import store from '../store/index.js';
import SkillIndex from '../components/skills/index.vue'

const routes = [
    {
        path: '/',
        name: 'App',
        component: App
    },
    {
        path: '/login',
        name: 'auth.login',
        component: Login
    },
    {
        path: '/register',
        name: 'auth.register',
        component: Register
    },
    
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        beforeEnter: (to, from, next) => {
            if(!store.getters['auth/authenticated']){
              return next({ name: 'auth.login'})
            }
            next()
        }
    },
    {
        path: '/skills',
        name: 'skills.index',
        component: SkillIndex,
        beforeEnter: (to, from, next) => {
            if(!store.getters['auth/authenticated']){
              return next({ name: 'auth.login'})
            }
            next()
        }
    },/**/
];

/*export default createRouter({
    history: createWebHistory(),
    routes
})*/
const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
  })
export default router