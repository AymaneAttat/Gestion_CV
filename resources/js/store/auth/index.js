import axios from 'axios';

export default {
    namespaced: true,
    state: {
        token: null,
        role: null,
        user: null
    },
    mutations: {
        setToken(state, token){
            state.token = token
        },
        setRole(state, role){
            state.role = role
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
        },
        getRole(state){
            /*if(state.role == 3 || state.role == 2){
                return false;
            }else if(state.role == 1){
                return true;
            }*/
            return state.role == 1 ? state.role : false;
        }
    },
    actions: {
        async SignIn({commit, state, dispatch}, credentials){
            try {
                const response = await axios.post('api/auth/login', credentials)
                console.log(response);
                //localStorage.setItem("userPermissions", response.data.permissions);
                /*if(response.data.role){
                    commit('setRole', response.data.role)
                }
                if(!state.role){
                    return;
                }*/
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
                console.log(response.data);
                commit('setRole', response.data.role_id);
                console.log('Success')
            } catch (error) {
                commit('setUser', null)
                commit('setToken', null)
                commit('setRole', null)
                //console.log(error)
            }
        },
        signOut({ commit }){
            return axios.post('api/auth/logout').then(() => {
                commit('setUser', null)
                commit('setToken', null)
                commit('setRole', null)
            })
        }
    }
}