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
                                <h3 class="text-center">S’inscrire</h3>
                            </div>
                            <form @submit.prevent="signup()">
                                <div class="form-group first">
                                    <label for="name">Name</label>
                                    <input v-model="user.name" type="text" class="form-control" id="name">

                                </div>
                                <div class="form-group first">
                                    <label for="email">Email</label>
                                    <input v-model="user.email" type="text" class="form-control" id="email">

                                </div>
                                <div class="form-group first">
                                    <label for="password">Password</label>
                                    <input v-model="user.password" type="password" class="form-control" id="password">
                                    
                                </div>
                                <div class="form-group last mb-4">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input v-model="user.password_confirmation" type="password" class="form-control" id="password_confirmation">
                                    
                                </div>
                                
                                <input type="submit" value="S'inscrire" class="btn btn-block btn-primary">
                                <span class="d-block text-center my-4 text-muted">&mdash; <router-link :to="{name: 'auth.login'}">Si vous avez déja un compte cliquez ici</router-link> &mdash;</span>
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
export default {
    data() {
        return {
            user: {
                name: '',
                email: '',
                password: '',
                password__confirmation: ''
            }
        }
    },
    methods: {
        async signup(){
            console.log(this.user);
            await axios.post('api/auth/register', this.user).then(() => this.$router.replace({name: 'auth.login'})).catch(err => console.log(err));

        }
    }
}
</script>
<style lang="">
    
</style>