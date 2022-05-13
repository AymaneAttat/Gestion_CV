<template lang="">
    <div class="sign-in-basic">
            <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');" loading="lazy">
                <span class="mask bg-gradient-dark opacity-6"></span>
                <div class="container my-auto">
                    <div class="row">
                        <div class="col-lg-4 col-md-8 col-12 mx-auto">
                            <div class="card z-index-0 fadeIn3 fadeInBottom">
                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                    <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                        <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Réinitialiser le mot de passe</h4>
                                        <div class="row mt-3">
                                            <div class="col-2 text-center me-auto">
                                                <a class="btn btn-link px-3" href="javascript:;">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form @submit.prevent="resetPassword" method="post" role="form" class="text-start">
                                        
                                        <div class="input-group input-group-static my-3">
                                            <label>Email</label>
                                            <input v-model="email" class="form-control" placeholder="email@gmail.com" type="email" required>
                                        </div>
                                        
                                        <div class="input-group input-group-static mb-3">
                                            <label>Mot de passe</label>
                                            <input v-model="password" class="form-control" type="password" required>
                                        </div>
                                        
                                        <div class="input-group input-group-static mb-3">
                                            <label>Confirmer Mot de passe</label>
                                            <input v-model="password_confirmation" class="form-control" type="password" required>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Modifier le mot de passe</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>
<script>
import axios from 'axios';
export default {
    data() {
        return {
            token: null,
            email: null,
            password: null,
            password_confirmation: null,
            has_error: false
        }
    },
    methods: {
        resetPassword() {
            axios.post("api/auth/reset/password/", {
                token: this.$route.params.token,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation
            })
            .then(result => {
                // console.log(result.data);
                this.$router.push({name: 'auth.login'});
                this.flashMessage.success({ message: result.data.message, time: 5000 });
            }, error => {
                console.error(error);
            });
        }
    }
}
</script>
<style lang="">
    
</style>