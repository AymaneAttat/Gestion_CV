<template lang="">
    <div>
        <Nav />
        <br><br><br>
        <!-- main -->
        <!-- Modal Insérer des profiles -->
        <div class="modal fade" id="exampleModalProfile" tabindex="-1" aria-labelledby="exampleModalProfileLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" style="vertical-align: -0.125em;" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32"><path fill="#20744a" fill-rule="evenodd" d="M28.781 4.405h-10.13V2.018L2 4.588v22.527l16.651 2.868v-3.538h10.13A1.162 1.162 0 0 0 30 25.349V5.5a1.162 1.162 0 0 0-1.219-1.095Zm.16 21.126H18.617l-.017-1.889h2.487v-2.2h-2.506l-.012-1.3h2.518v-2.2H18.55l-.012-1.3h2.549v-2.2H18.53v-1.3h2.557v-2.2H18.53v-1.3h2.557v-2.2H18.53v-2h10.411Z"/><path fill="#20744a" d="M22.487 7.439h4.323v2.2h-4.323zm0 3.501h4.323v2.2h-4.323zm0 3.501h4.323v2.2h-4.323zm0 3.501h4.323v2.2h-4.323zm0 3.501h4.323v2.2h-4.323z"/><path fill="#fff" fill-rule="evenodd" d="m6.347 10.673l2.146-.123l1.349 3.709l1.594-3.862l2.146-.123l-2.606 5.266l2.606 5.279l-2.269-.153l-1.532-4.024l-1.533 3.871l-2.085-.184l2.422-4.663l-2.238-4.993z"/></svg>
                            Insérer des profiles</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <b-form @submit.prevent="insererProfiles()">
                        <div class="modal-body">
                            <b-form-group id="input-group-1" label="" label-for="input-1" description="assurez-vous d’insérer le fichier correct."></b-form-group>
                                <b-form-file :state="Boolean(uploaded_file)" placeholder="Insérer un fichier de type csv ou xlsx" drop-placeholder="Déposer le fichier ici..." name="uploaded_file" ref="uploaded_file"  @change="onFileChange" required></b-form-file>
                            </b-form-group>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn bg-gradient-primary mb-0" data-bs-dismiss="modal">Ajouter</button>
                        </div>
                    </b-form>
                </div>
            </div>
        </div><!-- end Modal Insérer des profiles -->
        <!-- Modal Insérer des CV -->
        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModal1Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" style="vertical-align: -0.125em;" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 1024 1024"><path fill="currentColor" d="m531.3 574.4l.3-1.4c5.8-23.9 13.1-53.7 7.4-80.7c-3.8-21.3-19.5-29.6-32.9-30.2c-15.8-.7-29.9 8.3-33.4 21.4c-6.6 24-.7 56.8 10.1 98.6c-13.6 32.4-35.3 79.5-51.2 107.5c-29.6 15.3-69.3 38.9-75.2 68.7c-1.2 5.5.2 12.5 3.5 18.8c3.7 7 9.6 12.4 16.5 15c3 1.1 6.6 2 10.8 2c17.6 0 46.1-14.2 84.1-79.4c5.8-1.9 11.8-3.9 17.6-5.9c27.2-9.2 55.4-18.8 80.9-23.1c28.2 15.1 60.3 24.8 82.1 24.8c21.6 0 30.1-12.8 33.3-20.5c5.6-13.5 2.9-30.5-6.2-39.6c-13.2-13-45.3-16.4-95.3-10.2c-24.6-15-40.7-35.4-52.4-65.8zM421.6 726.3c-13.9 20.2-24.4 30.3-30.1 34.7c6.7-12.3 19.8-25.3 30.1-34.7zm87.6-235.5c5.2 8.9 4.5 35.8.5 49.4c-4.9-19.9-5.6-48.1-2.7-51.4c.8.1 1.5.7 2.2 2zm-1.6 120.5c10.7 18.5 24.2 34.4 39.1 46.2c-21.6 4.9-41.3 13-58.9 20.2c-4.2 1.7-8.3 3.4-12.3 5c13.3-24.1 24.4-51.4 32.1-71.4zm155.6 65.5c.1.2.2.5-.4.9h-.2l-.2.3c-.8.5-9 5.3-44.3-8.6c40.6-1.9 45 7.3 45.1 7.4zm191.4-388.2L639.4 73.4c-6-6-14.1-9.4-22.6-9.4H192c-17.7 0-32 14.3-32 32v832c0 17.7 14.3 32 32 32h640c17.7 0 32-14.3 32-32V311.3c0-8.5-3.4-16.7-9.4-22.7zM790.2 326H602V137.8L790.2 326zm1.8 562H232V136h302v216a42 42 0 0 0 42 42h216v494z"/></svg>
                            Insérer des CV
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form @submit.prevent='uploadCVFiles()' enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="file" id="upload-file" multiple @change="fieldChange" required/> <!--submitFiles() id="files" ref="files" v-on:change="handleFilesUpload()"-->
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn bg-gradient-primary mb-0" data-bs-dismiss="modal">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- end Modal Insérer des CV -->

        <div class="card card-body shadow-xl mx-3 mx-md-4 mt-n6 animate__animated animate__backInLeft">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn bg-gradient-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal1"><b-icon icon="cloud-upload" aria-hidden="true"></b-icon> Insérer des CV</button>
                    </div>
                    <div class="col d-flex justify-content-end">
                        <button type="button" class="btn bg-gradient-primary rounded-pill w-auto me-2" data-bs-toggle="modal" data-bs-target="#exampleModalProfile"><b-icon icon="cloud-upload" aria-hidden="true"></b-icon> Des Profiles</button>
                    </div>
                </div>
                <div class="section text-center">
                    <div class="row text-center py-2 mt-3">
                        <div class="col-4 mx-auto">
                            <div class="input-group input-group-dynamic mb-4">
                                <input class="form-control" v-model.lazy="keyword" placeholder="Chercher des profiles..." type="text" >
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

                        <div v-if="isEmpty.length === 0">
                            <div class="section text-center">
                                <div class="position-relative">
                                    <img class="position-relative z-index-2" width="37%" height="28%" src="/img/77703-no-data-found.gif" alt="image">
                                </div>
                            </div>
                        </div>
                        <table v-else class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th scope="col"><span class="text-dark cursor-pointer" href="#" @click.prevent="change_sort('email')">Email</span></th>
                                    <th scope="col"><span class="text-dark cursor-pointer" @click.prevent="change_sort('prenom')">Prénom</span></th>
                                    <th scope="col"><span class="text-dark cursor-pointer" @click.prevent="change_sort('nom')">Nom</span></th>
                                    <th scope="col"><span class="text-dark cursor-pointer" @click.prevent="change_sort('date_debut_experience')">Expérience<span v-if="sort_direction=='asc'">&uarr;</span><span v-else>&darr;</span></span></th>
                                    <th scope="col">Compétence</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="profile in profiles.data" ::key="profile.id">
                                    <th scope="row"><small>{{ profile.email }}</small></th>
                                    <td><small>{{ profile.prenom }}</small></td>
                                    <td><small>{{ profile.nom }}</small></td>
                                    <th scope="row"><small>{{moment(profile.date_debut_experience , "YYYY-MM-DD").fromNow()}}</small></th>
                                    <td><small style="font-size: 12px;"><b>{{ profile.skill1 ? profile.skill1 : '' }} {{ profile.skill2 ? '| '+profile.skill2 : '' }} {{ profile.skill3 ? '| '+profile.skill3 : '' }} {{ profile.skill4 ? '| '+profile.skill4 : '' }} {{ profile.skill5 ? '| '+profile.skill5 : '' }}</b></small></td>
                                    <td>
                                        <router-link :to="{name: 'profile.edit', params: {id: profile.id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Modifier le profile">
                                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" style="vertical-align: -0.125em; color: #ec407a;" width="1.5em" height="1.6em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 36 36"><path d="M28 30H6V8h13.22l2-2H6a2 2 0 0 0-2 2v22a2 2 0 0 0 2 2h22a2 2 0 0 0 2-2V15l-2 2z" class="clr-i-outline clr-i-outline-path-1" fill="currentColor"/><path d="M33.53 5.84l-3.37-3.37a1.61 1.61 0 0 0-2.28 0L14.17 16.26l-1.11 4.81A1.61 1.61 0 0 0 14.63 23a1.69 1.69 0 0 0 .37 0l4.85-1.07L33.53 8.12a1.61 1.61 0 0 0 0-2.28zM18.81 20.08l-3.66.81l.85-3.63L26.32 6.87l2.82 2.82zM30.27 8.56l-2.82-2.82L29 4.16L31.84 7z" class="clr-i-outline clr-i-outline-path-2" fill="currentColor"/></svg>
                                        </router-link>
                                        <router-link v-if="profile.pdf" :to="{name: 'profile.showPdf', query: {id: profile.id, pdfID: profile.pdf.id, url: profile.pdf.path}}" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Voir PDF">
                                            <svg xmlns="http://www.w3.org/2000/svg" data-bs-toggle="tooltip" data-bs-placement="top" title="Voir CV" aria-hidden="true" role="img" style="vertical-align: -0.125em;" width="1.1em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 448 512"><path fill="#ec407a" d="M48 32C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48H48zm98.88 133.234c19.636 0 37.082 6.789 49.929 16.971c11.88 9.452 17.444 18.907 22.298 27.393l-33.923 16.949c-2.427-5.565-5.347-11.387-12.846-17.682c-8.248-6.552-16.478-8.484-23.524-8.484c-27.626 0-42.17 25.693-42.17 54.287c0 37.573 19.161 56.22 42.17 56.22c22.3 0 31.278-15.51 37.08-25.435L219.6 302.66c-6.315 9.926-12.374 19.635-25.95 29.069c-7.262 5.09-23.977 15.037-47.736 15.037C100.586 346.766 64 313.81 64 255.87c0-50.636 34.415-90.637 82.88-90.637zm75.483 5.328h45.565L303.31 292.24l35.125-121.678H384l-59.379 171.112H281.01l-58.647-171.111z"/></svg>
                                        </router-link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <pagination :data="profiles" :limit="2" @pagination-change-page="getResults">
                    </pagination>
                </div>
            </div>
        </div> <!-- end main moment(profile.date_debut_experience , "MM-DD-YYYY").fromNow().split(" ")[0]}} startOf('hour')-->
    </div>
</template>
<script>
    import { mapActions } from 'vuex';
    import Nav from '.././Nav/Nav.vue';
    var moment = require('moment');
export default {
    components: { Nav },
    data() {
        return {
            moment: moment,
            form: {
                skill: ''
            },
            uploaded_file: '',
            profiles: {},
            isEmpty: {},
            errors: '',
            keyword: null,
            showModal: false,
            test: '',
            attachments:[],
            files: '',
            sort_direction: 'desc',
            sort_field: 'created_at',
        }
    },
    watch:{
        keyword(after, before) {
            this.getResult();
        }
    },
    methods: {
        ...mapActions({
            'searchForProfile': 'profile/searchProfile',
            'uploadProfiles': 'profile/uploadProfilesExcel',
            'getAllProfiles': 'profile/paginateProfiles',
            'storeAllCV': 'profile/uploadAllCV',
            'DownloadCv': 'profile/CVDownload',
        }),
        fieldChange(e){
            let selectedFiles=e.target.files;
            if(!selectedFiles.length){  return false; }
            for(let i=0;i<selectedFiles.length;i++){
                this.attachments.push(selectedFiles[i]);
            }
            console.log(this.attachments);
        },
        getResult(){
            var payload = { 'keyword': this.keyword, 'sort_direction' : this.sort_direction, 'sort_field': this.sort_field };
            this.searchForProfile(payload).then((res) => {this.profiles = res.data, this.isEmpty = res.data.data});
        },
        onFileChange(e) {
            this.uploaded_file = e.target.files[0];
        },
        insererProfiles() {
            this.uploadProfiles(this.uploaded_file)
                .then((res) => {this.getResults(), this.flashMessage.success({ message: res.data.message, time: 5000 })})
                .catch(() => this.flashMessage.error({ message: 'Fichier Excel non téléchargé ', time: 5000 }));
        },/*async getAllProfiles(){const test = await axios.get('api/profiles-index') return this.profiles = test.data.data //console.log(this.profiles)},*/
        getResults(page) {
            if (typeof page === 'undefined') { page = 1; }
            var payload = { 'page': page, 'sort_direction' : this.sort_direction, 'sort_field': this.sort_field };//async await axios.get('api/profiles-index?page=' + page + '&sort_direction=' +this.sort_direction+ '&sort_field=' + this.sort_field).then((res) => {this.profiles = res.data, this.isEmpty = res.data.data}).catch(() => this.flashMessage.error({ message: 'Not working !', time: 5000 }))
            //this.getAllProfiles(page).then((res) => {this.profiles = res.data, this.isEmpty = res.data.data}).catch(() => this.flashMessage.error({ message: 'Not working !', time: 5000 }))
            this.getAllProfiles(payload).then((res) => {this.profiles = res.data, this.isEmpty = res.data.data}).catch(() => this.flashMessage.error({ message: 'Not working !', time: 5000 }))
        },
        uploadCVFiles(){
            this.storeAllCV(this.attachments)
                .then((res) => { this.getResults(), this.attachments = [], this.flashMessage.success({ message: res.data.message, time: 5000 }) })
                .catch(() => this.flashMessage.error({ message: 'Fichier pdf non téléchargé !', time: 5000 }));
        },
        /* Handles a change on the file upload */
        handleFilesUpload(){
            this.files = this.$refs.files.files;
        },
        DownloadCV(id){
            this.DownloadCv(id)
                .then((res) => {
                    console.log(res)
                    let blob = new Blob([res.data], { type: 'application/pdf' })
                    let link = document.createElement('a')
                    link.href = window.URL.createObjectURL(blob)
                    link.download = 'bitdyne.pdf'
                    link.click()
                    this.flashMessage.success({ message: 'CV télechargé avec succes', time: 5000 })
                })/**/
                .catch((e) => {//console.log(e.response.data)
                    this.flashMessage.error({ message: 'CV non téléchargé !', time: 5000 })
                })
        },
        change_sort(field){
            if(this.sort_field == field){
                this.sort_direction = this.sort_direction == "asc" ? "desc" : "asc";
            }else{
                this.sort_field = field;
            }
            if(!this.keyword || this.keyword.length === 0){
                this.getResults();
            }else{
                this.getResult();
            }
            
        },
    },
    mounted() {
        this.getResults();//this.getAllProfiles()
    },
}
</script>
<style  scoped src="../../../css/style1.css">
    
</style>