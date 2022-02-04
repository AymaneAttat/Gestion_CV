import axios from 'axios';

export default {
    namespaced: true,
    state: {
        token: null,
        user: null
    },
    mutations: {
        setToken(state, token){
            state.token = token
        },
        setUser(state, data){
            state.user = data
        }
    },
    getters: {
        authenticated(state){
            return state.token && state.user;
        },
        getUser(state){
            return state.user
        }
    },
    actions: {
        async SignIn({dispatch}, credentials){
            try {
                const response = await axios.post('api/auth/login', credentials)
                console.log(response); 
                return dispatch('attempt', response.data.access_token);
                
            } catch (error) {
                console.log(error)
            } 
        },
        async attempt({commit, state}, token){
            try {
                /*const response = await axios.get('auth/user-profile', {
                    headers: {'Authorization': `Bearer ${token}`}
                })*/
                //commit('setToken', token);
                if(token){
                    commit('setToken', token)
                }
                if(!state.token){
                    return;
                }
                const response = await axios.get('api/auth/user-profile')
                
                commit('setUser', response.data);
                console.log('Success')
            } catch (error) {
                commit('setUser', null)
                commit('setToken', null)
                //console.log(error)
            }
        },
        signOut({ commit }){
            return axios.post('api/auth/logout').then(() => {
                commit('setUser', null)
                commit('setToken', null)
            })
        }
    }
}