<template lang="">
    <div>
        <Nav />
        <br><br><br>
        <!-- main -->
        <div class="card card-body shadow-xl mx-3 mx-md-4 mt-n6">
            <div class="container">
                <div class="section text-center">
                    <div class="col-lg-4 ms-lg-auto col-md-6 col-sm-3 d-flex justify-content-end">
                        <button type="button" class="btn bg-gradient-primary w-auto me-2 d-flex justify-content-end" v-b-modal.modal-multi-2>+ Insérer des Profiles</button>
                    </div>
                    
                    <b-modal id="modal-multi-2" title="Insérer des profiles" hide-footer>
                        <div class="mt-2 mb-6 text-sm text-red-600" v-if="errors !== ''">
                            {{ errors }}
                        </div>
                        <b-form @submit="onSubmit1()">
                            <b-form-group id="input-group-1" label="" label-for="input-1" description="assurez-vous d’insérer le fichier correct."></b-form-group>
                                <b-form-file :state="Boolean(uploaded_file)" placeholder="Insérer un fichier de type csv ou xlsx" drop-placeholder="Déposer le fichier ici..." name="uploaded_file" ref="uploaded_file"  @change="onFileChange"></b-form-file>
                            </b-form-group>
                            <button type="submit" class="btn bg-gradient-primary w-auto me-1 mb-0">Ajouter</button>
                        </b-form>
                    </b-modal>

                    <div class="row text-center py-2 mt-3">
                        <div class="col-4 mx-auto">
                            <div class="input-group input-group-dynamic mb-4">
                                <input class="form-control" v-model="keyword" placeholder="Chercher des profiles..." type="text" >
                            </div>
                        </div>
                    </div>

                    <table class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Email</th>
                                <th scope="col">PRENOM</th>
                                <th scope="col">NOM</th>
                                <th scope="col">Expérience</th>
                                <th scope="col">Compétence</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="profile in profiles.data">
                                <th scope="row"><small>{{ profile.email }}</small></th>
                                <td><small>{{ profile.prenom }}</small></td>
                                <td><small>{{ profile.nom }}</small></td>
                                <th scope="row"><small>{{moment(profile.date_debut_experience , "YYYY-MM-DD").fromNow()}}</small></th>
                                <td><small><b>{{ profile.skill1 ? profile.skill1 : '' }}</b></small> <small><b>{{ profile.skill2 ? '| '+profile.skill2 : '' }}</b></small> <small><b>{{ profile.skill3 ? '| '+profile.skill3 : '' }}</b></small> <small><b>{{ profile.skill4 ? '| '+profile.skill4 : '' }}</b></small> <small><b>{{ profile.skill5 ? '| '+profile.skill5 : '' }}</b></small></td>
                                <td>
                                    <router-link :to="{name: 'profiles.test', query: {id: profile.id}}">
                                         <a>
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Voir le profile">
                                                <b-icon icon="eye" style="color: #ec407a;" animation="throb" font-scale="2" />
                                            </span>
                                        </a> 
                                    </router-link>
                                    <!--<router-link :to="{name: 'profiles.test', query: {id: profile.id}}"></router-link>
                                        <a>
                                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="Voir le profile">
                                            <b-icon icon="eye" style="color: #ec407a;" animation="throb" font-scale="2" />
                                        </span></a>
                                    </router-link>-->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination :data="profiles" :limit="2" @pagination-change-page="getResults">
                    </pagination>
                </div>
            </div>
        </div>
        <!-- end main moment(profile.date_debut_experience , "MM-DD-YYYY").fromNow().split(" ")[0]}} startOf('hour')-->
    </div>
</template>
<script>
import Nav from '.././Nav/Nav.vue'
import Carose from '.././Nav/carose.vue'
var moment = require('moment');
export default {
    components: { Nav, Carose },
    data() {
        return {
            moment: moment,
            form: {
                skill: ''
            },
            uploaded_file: '',
            profiles: {},
            errors: '',
            keyword: null
        }
    },
    watch:{
        keyword(after, before) {
            this.getResult();
        }
    },
    methods: {
        getResult(){
            axios.get('api/liveSearchProfiles', { params: { keyword: this.keyword } })
                .then(res => this.profiles = res.data)
                .catch(error => {
                    this.error = error.response.data
                    console.log('check error: ', this.error)
                });
        },
        onFileChange(e) {
            this.uploaded_file = e.target.files[0];
        },
        async onSubmit1() {
            try {
                let formData = new FormData();
                formData.append('uploaded_file', this.uploaded_file);
                await axios.post('api/upload-profiles', formData).then(() => 
                    this.$router.replace({name: 'profiles.index'},
                    this.flashMessage.success({
                        message: 'fichier télécharger avec succès!',
                        time: 5000
                    })
                ))
                .catch(error => {
                    this.error = error.response.data
                    console.log('check error: ', this.error)
                });
            } catch (e) {
                if (e.response.status === 422) {
                    for (const key in e.response.data.errors) {
                        errors.value += e.response.data.errors[key][0] + ' ';
                    }
                }else{
                    this.flashMessage.error({
                        message: 'Some error occurred, Please try again!',
                        time: 5000
                    });
                }
            }
        },
        /*async getAllProfiles(){
            const test = await axios.get('api/profiles-index')
            return this.profiles = test.data.data
            //console.log(this.profiles)
        },*/
        getResults(page) {
            if (typeof page === 'undefined') {
                page = 1;
            }
            axios.get('api/profiles-index?page=' + page)
                .then(response => {
                this.profiles = response.data;
            });
        },
    },
    mounted() {
        //this.getAllProfiles()
        this.getResults()
    },
}
</script>
<style lang="">
    
</style>