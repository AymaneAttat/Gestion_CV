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
import ProfileTest from '../components/Profile/show.vue'
import Permissions from '../components/authorization/Permissions.vue'
//import Roles from '../components/authorization/Roles.vue'
//import Users from '../components/authorization/Users.vue'
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
            }else if(!store.getters['auth/getRole']){
                return next({ name: 'not-authorized'})
            }
            next()
        }
    },
    
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        beforeEnter: (to, from, next) => {
            if(!store.getters['auth/authenticated']){
              return next({ name: 'auth.login'})
            }else if(!store.getters['auth/getRole']){
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
            else if(!store.getters['auth/getRole']){
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
            }else if(!store.getters['auth/getRole']){
                return next({ name: 'not-authorized'})
            }
            next()
        }
    },
    {
        path: '/test',
        name: 'profiles.show',
        component: ProfileTest,
        //props: true,
        beforeEnter: (to, from, next) => {
            if(!store.getters['auth/authenticated']){
              return next({ name: 'auth.login'})
            }
            next()
        }
    },
    {
        path: '/permissions',
        name: 'permissions',
        props: true,
        component: Permissions,
        meta: {
          authRequired: 'true',
        },
    },
    {
        path: '/users-index',
        name: 'users.index',
        //props: true,
        component: UsersIndex,
        beforeEnter: (to, from, next) => {
            if(!store.getters['auth/authenticated']){
              return next({ name: 'auth.login'})
            }else if(!store.getters['auth/getRole']){
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