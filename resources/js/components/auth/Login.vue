<template lang="">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="undraw_remotely_2j6y.svg" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h3 class="text-center">Se Connecter</h3>
                            </div>
                            <form @submit.prevent="submit">
                                <div class="form-group first">
                                    <label for="email">Email</label>
                                    <input v-model="user.email" type="text" class="form-control" id="email">

                                </div>
                                <div class="form-group last mb-4">
                                    <label for="password">Password</label>
                                    <input v-model="user.password" type="password" class="form-control" id="password">
                                    
                                </div>
                                <div class="d-flex mb-5 align-items-center">
                                    <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                                    <input type="checkbox" checked="checked"/>
                                    <div class="control__indicator"></div>
                                    </label>
                                    <span class="ml-auto"><a href="#" class="forgot-pass">Mot de passe oublier ?</a></span> 
                                </div>
                                <input type="submit" value="Connecter" class="btn btn-block btn-primary">
                                <span class="d-block my-4 text-center text-muted">&mdash; <router-link :to="{name: 'auth.register'}">Si vous n'avez pas un compte cliquez ici</router-link> &mdash;</span>
                                <div class="social-login">
                                    <a href="#" class="facebook">
                                        <span class="icon-facebook mr-3"></span> 
                                    </a>
                                    <a href="#" class="google">
                                        <span class="icon-google mr-3"></span> 
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
//import { reactive } from 'vue';
//import axios from 'axios';
import { mapActions } from 'vuex';
//import useAuth from '../../components/authentification/auth.js';
export default {
    data() {
        return {
            user: {
                email: '',
                password: ''
            }
        }
    },
    methods: {
        ...mapActions({
            'SignIn': 'auth/SignIn'
        }),
        submit(){
            this.SignIn(this.user).then(() => this.$router.replace({name: 'dashboard'}));
            //this.$store.dispatch('SignIn', { ...this.user });
            //.then(() => this.$router.replace({name: 'Dashboard'}));
        },
    }
}
</script>
<style lang="">
    
</style>