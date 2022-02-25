import store from "./index";
import axios from "axios";

///store.subscribe((mutation) => console.log(mutation))//n'import quel mutation a été modifier la methode subscriber va executer
store.subscribe((mutation) => {
    if(mutation.type === 'auth/setToken'){
        if(mutation.payload){
            axios.defaults.headers.common['Authorization'] = `Bearer ${mutation.payload}`
            localStorage.setItem('token', mutation.payload);
        }else{
            axios.defaults.headers.common['Authorization'] = null
            localStorage.removeItem('token');
            localStorage.removeItem('role');
        }
    }
    if(mutation.type === 'auth/setRole'){
        if(mutation.payload){
            localStorage.setItem('role', mutation.payload);
        }else{
            localStorage.removeItem('role');
        }
    }
})