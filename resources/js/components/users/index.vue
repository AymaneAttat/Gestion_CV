<template lang="">
    <div>
        <Nav />
        <br><br><br>
        <div class="card card-body shadow-xl mx-3 mx-md-4 mt-n6">
            <div class="container">
                <router-link v-if="isEmpty.length !== 0" class="btn bg-gradient-primary rounded-pill" :to="{name: 'auth.register'}"  data-bs-toggle="tooltip" data-bs-placement="top" title="Ajouter un nouveau utilisateur"><b-icon icon="person-plus-fill" scale="1"></b-icon> Utilisateur</router-link>
                <div class="section text-center"><!--  style="color: #ec407a;" -->
                    <div v-if="isEmpty.length === 0">
                        <div class="section text-center">
                            <div class="position-relative">
                                <img class="position-relative z-index-2" width="49%" height="37%" src="/img/77703-no-data-found.gif" alt="image">
                            </div>
                        </div>
                    </div>
                    <div v-else class="table-responsive-sm">
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Email</th>
                                    <th scope="col">NOM</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users.data"><!--v-for="profile in profiles.data"-->
                                    <th scope="row"><small>{{user.email}}</small></th>
                                    <th scope="row"><small>{{user.name}}</small></td>
                                    <th scope="row"><span class="badge bg-gradient-primary"><small>{{user.role.name}}</small></span></td>
                                    <th scope="row"><small>vide</small></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios'
    import Nav from '.././Nav/Nav.vue'
export default {
    components: { Nav },
    data() {
        return {
            users: [],
            errors: '',
            isEmpty: ''
        }
    },
    methods: {
        async getUsers(){
            /*const test = await axios.get('api/users')
            return this.users = test.data.data,
            console.log(this.users)*/
            await axios.get('api/users-index')
                .then((response) => {
                    this.users = response.data,
                    this.isEmpty = response.data.data,
                    console.log(this.users)
                })
                .catch(error => {
                    this.errors = error.response.data
                    console.log('check error: ', this.errors)
                    this.flashMessage.error({ message: this.errors.message, time: 5000 });
                });
        }
    },
    mounted() {
        this.getUsers()
    },
}
</script>
<style lang="">
    
</style>