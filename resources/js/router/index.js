//import { createRouter, createWebHistory } from 'vue-router'
import VueRouter from 'vue-router'
import Login from '../components/auth/Signin.vue';
import Register from '../components/auth/Signup.vue';
import Dashboard from '../components/auth/Dashb.vue';
import main from '../components/skills/main.vue';
import store from '../store/index.js';
import SkillIndex from '../components/skills/index.vue'
import ProfilesIndex from '../components/Profile/index.vue'
import ProfileEdit from '../components/Profile/edit.vue'
//import ProfileTest from '../components/Profile/show.vue'
import NotAuthorized from '../components/authorization/NotAuthorized.vue'
import UsersIndex from '../components/users/index.vue'
import ForgotPassword from '../components/ForgotPass/ForgotPassword.vue'
import ResetPasswordForm from '../components/ForgotPass/ResetPasswordForm.vue'
import Historique from '../components/Historique/index.vue'
import showPdf from '../components/Profile/showPdf.vue'

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
        component: Register,
        beforeEnter: (to, from, next) => {
            if(!store.getters['auth/authenticated']){
              return next({ name: 'auth.login'})
            }else if(store.getters['auth/getRole'] != 'Administrator'){
                return next({ name: 'not-authorized'})
            }
            next()
        }/**/
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        beforeEnter: (to, from, next) => {
            if(!store.getters['auth/authenticated']){
              return next({ name: 'auth.login'})
            }else if(store.getters['auth/getRole'] != 'Administrator'){
                return next({ name: 'skills.index'})
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
            else if(store.getters['auth/getRole'] != 'Administrator'){
                return next({ name: 'not-authorized'})
            }
            next()
        }
    },
    {
        path: '/edit-profile-:id',
        name: 'profile.edit',
        component: ProfileEdit,
        props: true,
        beforeEnter: (to, from, next) => {
            if(!store.getters['auth/authenticated']){
              return next({ name: 'auth.login'})
            }else if(store.getters['auth/getRole'] != 'Administrator'){
                return next({ name: 'not-authorized'})
            }
            next()
        }
    },
    {
        path: '/users-index',
        name: 'users.index',
        //props: true,
        component: UsersIndex,
        beforeEnter: (to, from, next) => {
            if(!store.getters['auth/authenticated']){
              return next({ name: 'auth.login'})
            }else if(store.getters['auth/getRole'] != 'Administrator'){
                return next({ name: 'not-authorized'})
            }
            next()
        }
    },
    {
        path: '/not-authorized',
        name: 'not-authorized',
        props: true,
        component: NotAuthorized,
        /*beforeEnter: (to, from, next) => {
            if(!store.getters['auth/authenticated']){
              return next({ name: 'auth.login'})
            }
            next()
        }*/
    },
    { 
        path: '/reset-password', 
        name: 'reset-password', 
        component: ForgotPassword, 
    },
    { 
        path: '/reset-password-:token', 
        name: 'reset-password-form', 
        component: ResetPasswordForm,
    },
    {
        path: '/historique',
        name: 'historique.index',
        component: Historique,
        //props: true,
        beforeEnter: (to, from, next) => {
            if(!store.getters['auth/authenticated']){
              return next({ name: 'auth.login'})
            }
            next()
        }
    },
    {
        path: '/showPdf',
        name: 'profile.showPdf',
        component: showPdf,
        //props: true,
        beforeEnter: (to, from, next) => {
            if(!store.getters['auth/authenticated']){
              return next({ name: 'auth.login'})
            }/* else if(!store.getters['auth/getRole']){
                return next({ name: 'not-authorized'})
            }*/
            next()
        }
    },
];

const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
  })
export default router