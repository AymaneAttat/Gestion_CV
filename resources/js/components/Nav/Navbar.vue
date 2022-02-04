<template lang="">
    <nav class="navbar navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto mr-2 mr-lg-0">
                <div class="container">
                    <a class="navbar-brand" href="#">
                      <img src="logo.svg" alt="" width="110" height="30">
                    </a>
                </div>
                <li v-if="!authenticated" >
                    <router-link class="mr-2" :to="{name: 'auth.login'}">Login</router-link> 
                
                    <router-link :to="{name: 'auth.register'}">Register</router-link>
                </li>
            </ul>
          
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                        <h5 v-if="authenticated" class="offcanvas-title" id="offcanvasNavbarLabel">{{user.name}}</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Insérer des nouveaux profiles</a>
                        </li>
                        <li class="nav-item" v-if="authenticated">
                            <a @click="logOut" class="nav-link" href="#">LogOut </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'
export default {
    computed: {
        ...mapGetters({
            'authenticated': 'auth/authenticated',
            'user': 'auth/getUser'
        })
    },
    methods: {
        ...mapActions({
            'signOut': 'auth/signOut'
        }),
        logOut(){
            this.signOut().then(() => this.$router.replace({ name: 'index'}))
        }
    },
}
</script>
<style lang="">
    
</style>