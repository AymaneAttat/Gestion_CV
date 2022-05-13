<template lang="">
    <div>
        <div class="sign-in-basic">
            <Nav />
            <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');" loading="lazy">
                <span class="mask bg-gradient-dark opacity-6"></span>
                <div class="container my-auto">
                    <div class="row">
                        <div class="col-lg-4 col-md-8 col-12 mx-auto">
                            <div class="card z-index-0 fadeIn3 fadeInBottom">
                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                    <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                        <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">S’inscrire</h4>
                                        <div class="row mt-3">
                                            <div class="col-2 text-center ms-auto">
                                                <a class="btn btn-link px-3" href="javascript:;">
                                                </a>
                                            </div>
                                            <div class="col-2 text-center px-1">
                                                <a class="btn btn-link px-3" href="javascript:;">
                                                </a>
                                            </div>
                                            <div class="col-2 text-center me-auto">
                                                <a class="btn btn-link px-3" href="javascript:;">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div v-if="error" class="alert alert-primary text-white font-weight-bold" role="alert">
                                        {{error}}
                                    </div>
                                    <form @submit.prevent="signup()" role="form" class="text-start">
                                        <div class="input-group input-group-static my-3">
                                            <label>Nom</label>
                                            <input v-model="user.name" class="form-control" placeholder="Nom Complete" type="text" required>
                                        </div>
                                        <div class="input-group input-group-static my-3">
                                            <label>Email</label>
                                            <input v-model="user.email" class="form-control" placeholder="test@gmail.com" type="email" required>
                                        </div>
                                        <div class="input-group input-group-static my-3">
                                            <label>Mot de passe</label>
                                            <input v-model="user.password" class="form-control" type="password" required>
                                        </div>
                                        <div class="input-group input-group-static my-3">
                                            <label>Confirmer Mot de passe</label>
                                            <input v-model="user.password_confirmation" class="form-control" type="password" required>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">S'inscrire</button>
                                        </div>
                                        <p class="mt-4 text-sm text-center">
                                            <!-- Vous avez déja un compte? -->
                                            <router-link :to="{name: 'dashboard'}" class="text-primary text-gradient font-weight-bold">Retourner à l'accueil</router-link>
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
export default {
    data() {
        return {
            user: {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                role_id: 2
            },
            error: ''
        }
    },
    methods: {
        async signup(){
            console.log(this.user);
            await axios.post('api/auth/register', this.user).then(() => this.$router.replace({name: 'auth.login'})).catch(err => 
                this.error = err.response.data,
                console.log('check error: ', this.error),//console.log(err)
            );

        }
    }
}
</script>
<style lang="">
    
</style>