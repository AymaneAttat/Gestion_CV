<template lang="">
    <div>
        <Nav />
        <br><br><br>
        <!-- main -->
        <div class="card card-body shadow-xl mx-3 mx-md-4 mt-n6">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                            + Insérer des CV
                        </button>
                    </div>
                    <div class="col d-flex justify-content-end">
                        <button type="button" class="btn bg-gradient-primary w-auto me-2 d-flex justify-content-end" v-b-modal.modal-multi-2>+ Insérer des Profiles</button>
                    </div>
                </div>
                <div class="section text-center">
                    <!--<div class="col-lg-4 ms-lg-auto col-md-6 col-sm-3">
                        <div class=" d-flex justify-content-end">
                            <button type="button" class="btn bg-gradient-primary w-auto me-2 d-flex justify-content-end" v-b-modal.modal-multi-2>+ Insérer des Profiles</button>
                        </div>
                    </div>-->
                    
                    <b-modal id="modal-multi-2" title="Insérer des profiles" hide-footer>
                        <div class="mt-2 mb-6 text-sm text-red-600" v-if="errors !== ''">
                            {{ errors }}
                        </div>
                        <b-form @submit.prevent="onSubmit1()">
                            <b-form-group id="input-group-1" label="" label-for="input-1" description="assurez-vous d’insérer le fichier correct."></b-form-group>
                                <b-form-file :state="Boolean(uploaded_file)" placeholder="Insérer un fichier de type csv ou xlsx" drop-placeholder="Déposer le fichier ici..." name="uploaded_file" ref="uploaded_file"  @change="onFileChange"></b-form-file>
                            </b-form-group>
                            <button type="submit" class="btn bg-gradient-primary w-auto me-1 mb-0">Ajouter</button>
                        </b-form>
                    </b-modal>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModal1Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Insérer des CV</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form @submit.prevent='uploadFile()' enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <input type="file" id="upload-file" multiple @change="fieldChange"/> <!--submitFiles() id="files" ref="files" v-on:change="handleFilesUpload()"-->
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn bg-gradient-dark mb-0" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn bg-gradient-primary mb-0">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row text-center py-2 mt-3">
                        <div class="col-4 mx-auto">
                            <div class="input-group input-group-dynamic mb-4">
                                <input class="form-control" v-model="keyword" placeholder="Chercher des profiles..." type="text" >
                            </div>
                        </div>
                    </div>
                    <div v-if="profiles.length == 0">
                        <div class="section text-center">
                            <div class="position-relative">
                                <img class=" position-relative z-index-2" src="/img/77703-no-data-found.gif" alt="image">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-sm text-nowrap">
                        <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 80%;">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">CV</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style=" min-height:400px; overflow-y: auto;">
                <embed v-bind:src="test" frameborder="0" width="100%" height="495">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn bg-gradient-dark mb-0" data-bs-dismiss="modal">Fermer</button>
              <button type="button" class="btn bg-gradient-primary mb-0">Télecharger</button>
            </div>
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
                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Voir le profile">
                                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" style="vertical-align: -0.125em;" width="1.3em" height="1.8em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16"><path fill="#ec407a" d="M13.5 0h-12C.675 0 0 .675 0 1.5v13c0 .825.675 1.5 1.5 1.5h12c.825 0 1.5-.675 1.5-1.5v-13c0-.825-.675-1.5-1.5-1.5zM13 14H2V2h11v12zM4 9h7v1H4zm0 2h7v1H4zm1-6.5a1.5 1.5 0 1 1 3.001.001A1.5 1.5 0 0 1 5 4.5zM7.5 6h-2C4.675 6 4 6.45 4 7v1h5V7c0-.55-.675-1-1.5-1z"/></svg>
                                                <!--<span data-bs-toggle="tooltip" data-bs-placement="top" title="Voir le profile">
                                                    <b-icon icon="eye" style="color: #ec407a;" animation="throb" font-scale="2" />
                                                </span>-->
                                            </a> 
                                        </router-link>
                                        <a v-if="profile.pdf" @click="test = profile.pdf.path" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <svg xmlns="http://www.w3.org/2000/svg" data-bs-toggle="tooltip" data-bs-placement="top" title="Voir CV" aria-hidden="true" role="img" style="vertical-align: -0.125em;" width="1.3em" height="1.8em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 448 512"><path fill="#ec407a" d="M48 32C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48H48zm98.88 133.234c19.636 0 37.082 6.789 49.929 16.971c11.88 9.452 17.444 18.907 22.298 27.393l-33.923 16.949c-2.427-5.565-5.347-11.387-12.846-17.682c-8.248-6.552-16.478-8.484-23.524-8.484c-27.626 0-42.17 25.693-42.17 54.287c0 37.573 19.161 56.22 42.17 56.22c22.3 0 31.278-15.51 37.08-25.435L219.6 302.66c-6.315 9.926-12.374 19.635-25.95 29.069c-7.262 5.09-23.977 15.037-47.736 15.037C100.586 346.766 64 313.81 64 255.87c0-50.636 34.415-90.637 82.88-90.637zm75.483 5.328h45.565L303.31 292.24l35.125-121.678H384l-59.379 171.112H281.01l-58.647-171.111z"/></svg>
                                        </a>
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
                    </div>
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
//import Modal from '.././Modal/modal.vue'Modal
var moment = require('moment');
export default {
    components: { Nav, Carose,  },
    data() {
        return {
            moment: moment,
            form: {
                skill: ''
            },
            uploaded_file: '',
            profiles: {},
            errors: '',
            keyword: null,
            showModal: false,
            test: '',
            attachments:[],
            files: ''
        }
    },
    watch:{
        keyword(after, before) {
            this.getResult();
        }
    },
    methods: {
        fieldChange(e){
            let selectedFiles=e.target.files;
            if(!selectedFiles.length){
                return false;
            }
            for(let i=0;i<selectedFiles.length;i++){
                this.attachments.push(selectedFiles[i]);
            }
            console.log(this.attachments);
        },
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
                    this.$router.replace({name: 'profiles.index'}),
                    this.flashMessage.success({
                        message: 'fichier télécharger avec succès!',
                        time: 5000
                    })
                )
                .catch(error => {
                    this.errors = error.response.data
                    console.log('check error: ', this.errors)
                    this.flashMessage.error({
                        message: this.errors.message,
                        time: 5000
                    });
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
            }).catch(error => {
                    this.error = error.response.data
                    console.log('check error: ', this.error)
                    this.flashMessage.error({
                        message: this.error.message,
                        time: 5000
                    });
                });
        },
        submitFiles(){
            /*
            Initialize the form data
            */
            let formData = new FormData();

            /*
            Iteate over any file sent over appending the files
            to the form data.
            */
           console.log(this.files)
            for( var i = 0; i < this.files.length; i++ ){
                let file = this.files[i];
                console.log(file);
                formData.append('files['+ i +']', file);
            }

            /*
            Make the request to the POST /multiple-files URL
            */
           console.log(formData)
            axios.post('api/store-all-cv', formData).then(() => 
                this.$router.replace({name: 'profiles.index'}),
                this.flashMessage.success({
                    message: 'les fichiers télécharger avec succès!',
                    time: 5000
                })
            )
            .catch(error => {
                this.error = error.response.data
                console.log('check error: ', this.error)
                this.flashMessage.error({
                    message: this.error.message,
                    time: 5000
                });
            });
        },
        uploadFile(){
            let form = new FormData();
            for(let i=0; i<this.attachments.length;i++){
                form.append('pics[]',this.attachments[i]);
            }
            console.log(form);
            const config = { headers: { 'Content-Type': 'multipart/form-data' } };
            document.getElementById('upload-file').value=[];
            axios.post('api/store-all-cv', form, config).then(response=>{
                //success 
                console.log(response);
                this.flashMessage.success({
                    message: 'les fichiers télécharger avec succès!',
                    time: 5000
                });
            })
            .catch(error => {
                this.error = error.response.data
                console.log('check error: ', this.error)
                this.flashMessage.error({
                    message: this.error.message,
                    time: 5000
                });
            });
        },

        /*
            Handles a change on the file upload
        */
        handleFilesUpload(){
            this.files = this.$refs.files.files;
        }
    },
    mounted() {
        //this.getAllProfiles()
        this.getResults()
    },
}
</script>
<style  scoped src="../../../css/style1.css">
    
</style>