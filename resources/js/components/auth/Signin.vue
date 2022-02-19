<template lang="">
    <div>
        <div class="sign-in-basic">
            <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');" loading="lazy">
                <span class="mask bg-gradient-dark opacity-6"></span>
                <div class="container my-auto">
                    <div class="row">
                        <div class="col-lg-4 col-md-8 col-12 mx-auto">
                            <div class="card z-index-0 fadeIn3 fadeInBottom">
                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                    <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                        <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Se Connecter</h4>
                                        <div class="row mt-3">
                                            
                                            <div class="col-2 text-center me-auto">
                                                <a class="btn btn-link px-3" href="javascript:;">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    
                                    <div v-if="errors" class="alert alert-primary text-white font-weight-bold" role="alert">
                                        Wrong Email Or Password Please Try Again
                                    </div>
                                    
                                    <form @submit.prevent="submit" role="form" class="text-start">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Email</label>
                                            <input v-model="user.email" type="email" class="form-control">
                                        </div>
                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Mot de passe</label>
                                            <input v-model="user.password" type="password" class="form-control">
                                        </div>
                                        <div class="form-check form-switch d-flex align-items-center mb-3">
                                            <input class="form-check-input" type="checkbox" id="rememberMe">
                                            <label class="form-check-label mb-0 ms-2" for="rememberMe">Remember me</label>
                                        </div>
                                            <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Connecter</button>
                                        </div>
                                        <p class="mt-4 text-sm text-center">
                                            Vous n'avez pas un compte?
                                            <router-link :to="{name: 'auth.register'}" class="text-primary text-gradient font-weight-bold">Inscrivez-vous</router-link>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</template>
<script>
    import Nav from '.././Nav/Nav.vue'
    import { mapActions } from 'vuex';
export default {
    components: { Nav },
    data() {
        return {
            user: {
                email: '',
                password: ''
            },
            errors: false
        }
    },
    methods: {
        ...mapActions({
            'SignIn': 'auth/SignIn'
        }),
        submit(){
            
                this.SignIn(this.user)
                .then(() => this.$router.replace({name: 'dashboard'}))
                .catch(error => {
                    this.errors = true
                });
            
            
            /*.catch(error => {
                /*this.errors = error.response.data
                console.log('check error: ', this.errors.data)
                for (const key in error.response.data.errors) {
                    this.errors += error.response.data.errors[key][0] + ' ';
                }
            });*/
        },
    }
}
</script>
<style lang="">
    
</style>