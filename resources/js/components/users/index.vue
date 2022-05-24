<template lang="">
    <div>
        <Nav />
        <br><br><br>
        <!-- Modal Permissions -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 70%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Les permissions</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div> <!---->
                    <div class="modal-body">
                        <div class="nav-wrapper position-relative end-0">
                            <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                <li class="nav-item">
                                    <span class="nav-link mb-0 px-0 py-1 cursor-pointer" :class="{'active': step == true}" @click="step = !step" aria-controls="profile" aria-selected="true">Voir les permissions</span>
                                </li>
                                <li class="nav-item">
                                    <span class="nav-link mb-0 px-0 py-1 cursor-pointer" :class="{'active': step == false}" @click="step = !step" aria-controls="dashboard" aria-selected="false">Modifier les permissions</span>
                                </li>
                            </ul>
                        </div>
                        <section v-if="step == true">
                            <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-1 row-cols-1 g-6 py-3 mx-auto">
                                <div v-for="permission in user_permissions.permissions" ::key="permission.id" class="col d-flex justify-content-start">
                                    <div>
                                        <div class="form-checkbox form-check-inline">
                                            <span class="badge bg-gradient-primary me-1"><small>{{permission.name}}</small></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section v-if="step == false">
                            <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-1 row-cols-1 g-6 py-3 mx-auto">
                                <div v-for="permis in allPermissions" ::key="permis.id" class="col d-flex justify-content-start">
                                    <div>
                                        <div class="form-checkbox form-check-inline"><!--  selectedMembers.select_members v-model="select_members" persons.some(person => person.name === "Peter") v-model="select_permissions"-->
                                            <!-- <input class="form-check-input" type="checkbox" :value="permis.name" :id="permis.id" :checked="permissions.some(permission => permission.name == permis.name) ? true: false"  @click="checkedInput"> -->
                                            <input class="form-check-input" type="checkbox" :value="permis.name" :id="permis.id" v-model="select_permissions">
                                            <label class="form-check-label" :for="permis.id"><small>{{ permis.name }}</small></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" v-if="step == false" class="btn bg-gradient-primary mb-0" @click="permissionsStore(user_permissions.id)" data-bs-dismiss="modal">Modifier</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal Permissions -->
        <div class="card card-body shadow-xl mx-3 mx-md-4 mt-n6 animate__animated animate__backInLeft">
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
                                    <th scope="col">Nom</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users" ::key="user.id"><!--v-for="profile in profiles.data"-->
                                    <th scope="row"><small>{{user.email}}</small></th>
                                    <th scope="row"><small>{{user.name}}</small></td>
                                    <th scope="row" v-for="role in user.roles"><span class="badge bg-gradient-primary"><small>{{ role.name }}</small></span></td>
                                    <th scope="row">
                                        <span class="cursor-pointer" @click="user_permissions = user" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" style="vertical-align: -0.125em;" width="1.2em" height="1.2em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 26 26" data-bs-toggle="tooltip" data-bs-placement="top" title="Voir les permissions"><path fill="#ec407a" d="M23.633 5.028a1.074 1.074 0 0 0-.777-.366c-2.295-.06-5.199-2.514-7.119-3.477C14.551.592 13.768.201 13.18.098a1.225 1.225 0 0 0-.36.001c-.588.103-1.371.494-2.556 1.087c-1.92.962-4.824 3.417-7.119 3.476a1.08 1.08 0 0 0-.778.366a1.167 1.167 0 0 0-.291.834c.493 10.023 4.088 16.226 10.396 19.831c.164.093.346.141.527.141s.363-.048.528-.141c6.308-3.605 9.902-9.808 10.396-19.831a1.161 1.161 0 0 0-.29-.834zm-5.57 10.249c0 1.36-2.604 1.67-5.048 1.67c-2.44 0-5.077-.31-5.077-1.67v-.374c0-.999 1.8-2.011 3.333-2.564c.111-.041.641-.329.345-1.106c-.76-.775-1.334-2.034-1.334-3.271c0-1.896 1.254-2.889 2.719-2.889s2.726.993 2.726 2.889c0 1.232-.577 2.485-1.332 3.264h.003c-.289.881.174 1.09.248 1.114c1.61.532 3.418 1.536 3.418 2.564l-.001.373z"/></svg>
                                        </span>
                                    </th>
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
            user_permissions: [],
            allPermissions: [],
            select_permissions: [],
            isEmpty: '',
            step: true
        }
    },
    watch: {
        /*select_permissions(after, before){
            this.permissionsStore();
        },*/
    },
    methods: {
        async getUsers(){
            await axios.get('api/users-index')
                .then((response) => { this.users = response.data, this.isEmpty = response.data, console.log(this.users)})
                .catch(error => {
                    this.errors = error.response.data
                    console.log('check error: ', this.errors)
                    this.flashMessage.error({ message: this.errors.message, time: 5000 });
                });
        },
        async getPermissions(){
            await axios.get('api/all-permissions').then((response) => { this.allPermissions = response.data }).catch((error) => { this.errors = error.response.data, console.log('check error: ', this.errors)});
        },
        async permissionsStore(id){
            console.log(this.select_permissions, id);
            const data = new FormData();
            data.append('select_permissions', this.select_permissions); //data { params: { select_permissions: this.select_permissions } }  this.select_permissions
            data.append('user_id', id);
            await axios.post('api/save-Permissions', data).then((response) => { this.getUsers(), this.getPermissions(), this.flashMessage.success({ message: 'Autorisation modifier avec succès!', time: 5000 }) })
            .catch((e) => { this.flashMessage.error({ message: 'Erreur !', time: 5000 }) })
        },
        /*checkedInput(event) {
            if (this.select_permissions.includes(event.target.value)) {
                this.uncheck(event.target.value)
            } else {
                this.select_permissions.push(event.target.value)
                console.log(this.select_permissions)
            }
        }*/
    },
    mounted() {
        this.getUsers(), this.getPermissions()
    },
}
</script>
<style lang="">
    
</style>