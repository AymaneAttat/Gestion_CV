//import { createRouter, createWebHistory } from 'vue-router'
import VueRouter from 'vue-router'

//import Login from '../components/auth/Login.vue';
import Login from '../components/auth/Signin.vue';
//import Register from '../components/auth/Register.vue';
import Register from '../components/auth/Signup.vue';
//import Dashboard from '../components/auth/Dashboard.vue';
import Dashboard from '../components/auth/Dashb.vue';
import main from '../components/skills/main.vue';
import store from '../store/index.js';
import SkillIndex from '../components/skills/index.vue'
//import SkillIndex from '../components/skills/tmp1.vue'ProfilesIndex
import ProfilesIndex from '../components/Profile/index.vue'
//import ProfileShow from '../components/Profile/show.vue'
import ProfileEdit from '../components/Profile/edit.vue'
import ProfileTest from '../components/Profile/test.vue'

const routes = [
    {
        path: '/',
        name: 'main',
        component: main
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
    },
    {
        path: '/profiles',
        name: 'profiles.index',
        component: ProfilesIndex,
        beforeEnter: (to, from, next) => {
            if(!store.getters['auth/authenticated']){
              return next({ name: 'auth.login'})
            }
            next()
        }
    },
    {
        path: '/edit-profile',
        name: 'profile.edit',
        component: ProfileEdit,
        props: true,
        beforeEnter: (to, from, next) => {
            if(!store.getters['auth/authenticated']){
              return next({ name: 'auth.login'})
            }
            next()
        }
    },
    {
        path: '/test',
        name: 'profiles.test',
        component: ProfileTest,
        //props: true,
        beforeEnter: (to, from, next) => {
            if(!store.getters['auth/authenticated']){
              return next({ name: 'auth.login'})
            }
            next()
        }
    },
];
/**/
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