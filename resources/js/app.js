import Vue from 'vue'
import App from './components/App.vue'
import VueRouter from 'vue-router';
import router from './router'
import store from './store/index'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import LottieAnimation from 'lottie-vuejs/src/LottieAnimation.vue' // import lottie-vuejs 
import FlashMessage from '@smartweb/vue-flash-message';
import 'animate.css';
//import VueCtkDateTimePicker from 'vue-ctk-date-time-picker';
//import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css';
import NProgress from 'nprogress';
import 'nprogress/nprogress.css';


Vue.use(LottieAnimation); // add lottie-animation to your global scope
Vue.use(FlashMessage);

//import Argon from './plugins/argon-kit'Vue.use(Argon);

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)// Optionally install the BootstrapVue icon components plugin

require('./bootstrap');

window.Vue = require('vue').default;

//Vue.component('example-component', require('./components/App.vue').default);
Vue.component('App', App);
//Vue.component('VueCtkDateTimePicker', require('vue-ctk-date-time-picker'));
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.use(VueRouter);
//require('vue-loader');
require('./store/subscriber')
axios.defaults.baseURL = 'http://localhost:8000/'
// before a request is made start the nprogress
axios.interceptors.request.use(config => {
    NProgress.start()
    return config
})
// before a response is returned stop nprogress
axios.interceptors.response.use(response => {
    NProgress.done()
    return response
})

store.dispatch('auth/attempt', localStorage.getItem('token')).then(() => {
    const app = new Vue({
        el: '#app',
        router: router,
        store,
        render: h => h(App),
    });
})
