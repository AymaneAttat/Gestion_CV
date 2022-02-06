import Vue from 'vue'
import App from './components/App.vue'
import VueRouter from 'vue-router';
import router from './router'
import store from './store/index'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)


require('./bootstrap');

window.Vue = require('vue').default;

//Vue.component('example-component', require('./components/App.vue').default);
Vue.component('App', App)
Vue.use(VueRouter);

require('./store/subscriber')
axios.defaults.baseURL = 'http://localhost:8000/'

store.dispatch('auth/attempt', localStorage.getItem('token')).then(() => {
    const app = new Vue({
        el: '#app',
        router: router,
        store,
        render: h => h(App),
    });
})
