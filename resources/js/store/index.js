//import { createStore } from 'vuex'
import Vue from "vue"
import Vuex from 'vuex'
//import createPersistedState from 'vuex-persistedstate'
import auth from './auth/index'
import skill from './skill/index'
import profile from './profile/index'

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
  },
  mutations: {
  },
  actions: {
  },
  modules: {
    auth,
    skill,
    profile
  }
})
//const store = createStore export default store;