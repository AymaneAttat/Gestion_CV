import Vue from 'vue'
import App from './components/App.vue'
import VueRouter from 'vue-router';
import router from './router'
import store from './store/index'

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
