<template lang="">
    <div>
        <Nav />
        <br><br><br>
        <!-- main -->
        <div class="card card-body shadow-xl mx-3 mx-md-4 mt-n6">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal11">+ Insérer une Compétence</button>
                    </div>
                    <div class="col d-flex justify-content-end">
                        <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal12">+ Insérer des Compétences</button>
                    </div>
                </div>
                <!-- Modal une competence -->
                <div class="modal fade" id="exampleModal11" tabindex="-1" aria-labelledby="exampleModal11Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Insérer une Compétence</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <b-form @submit.prevent="onSubmit()">
                                    <b-form-group id="input-group-1" label="Compétence:" label-for="input-1" description="We'll never share your email with anyone else.">
                                        <b-form-input id="input-1" v-model="form.skill" placeholder="Entrer une compétence" required></b-form-input>
                                    </b-form-group>
                                    <button type="submit" class="btn bg-gradient-primary w-auto me-1 mb-0" data-bs-dismiss="modal">Ajouter</button> 
                                </b-form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal des competences-->
                <div class="modal fade" id="exampleModal12" tabindex="-1" aria-labelledby="exampleModal12Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Insérer des Compétences</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <b-form @submit.prevent="onSubmit1()">
                                    <b-form-group id="input-group-1" label="" label-for="input-1" description="assurez-vous d’insérer le fichier correct."></b-form-group>
                                        <b-form-file :state="Boolean(uploaded_file)" placeholder="Insérer un fichier de type csv ou xlsx" drop-placeholder="Déposer le fichier ici..." name="uploaded_file" ref="uploaded_file"  @change="onFileChange"></b-form-file>
                                    </b-form-group>
                                    <button type="submit" class="btn bg-gradient-primary w-auto me-1 mb-0" data-bs-dismiss="modal">Ajouter</button>
                                </b-form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section text-center">
                    <div class="row text-center py-2 mt-3">
                        <div class="col-4 mx-auto">
                            <div class="input-group input-group-dynamic mb-4">
                                <input class="form-control" v-model="keyword" placeholder="Chercher Compétence..." type="text" >
                            </div>
                        </div>
                    </div>
                    <div v-if="data.length == 0">
                        <div class="section text-center">
                            <div class="position-relative">
                                <img class=" position-relative z-index-2" width="36%" height="26%" src="/img/77703-no-data-found.gif" alt="image">
                            </div>
                        </div>
                    </div>
                    <div class="row row-cols-xl-6 row-cols-lg-4 row-cols-md-3 row-cols-2 g-6 py-3 mx-auto" v-if="Books.length == 0">
                        <div v-for="dat in data" class="col d-flex justify-content-start">
                            <div>
                                <div class="form-checkbox form-check-inline"><!--  selectedMembers.select_members -->
                                    <input class="form-check-input" type="checkbox" :value="dat.skill" v-model="select_members">
                                    <label class="form-check-label"><small>{{ dat.skill }}</small></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="profiles.length > 0">
                    <hr><br>
                    <div class="table-responsive table-responsive-sm text-nowrap">
                        <!-- Modal CV -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" style="max-width: 80%;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">CV</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style=" min-height:400px; overflow-y: auto;">
                                        <embed v-bind:src="test.path" frameborder="0" width="100%" height="495">
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn bg-gradient-dark mb-0" data-bs-dismiss="modal">Fermer</button>
                                        <button type="button" class="btn bg-gradient-primary mb-0" data-bs-dismiss="modal"  @click="DownloadCV(test.id)">Télecharger</button>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end Modal CV -->
                        <!-- Modal Email -->
                        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModal1Label" aria-hidden="true">
                            <div class="modal-dialog" style="max-width: 50%;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Envoyer Email</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form @submit.prevent="sendEmail">
                                        <div class="modal-body" style=" min-height:400px; overflow-y: auto;">
                                            <div class="input-group input-group-static mb-4">
                                                <label>Titre</label>
                                                <input v-model="email.title" class="form-control" placeholder="Objet" type="text" >
                                            </div>
                                            <div class="input-group mb-4 input-group-static">
                                                <label>Contenu</label>
                                                <textarea v-model="email.body" name="message" class="form-control" id="message" rows="4"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label style="margin-bottom: 10px;">When to Send:</label>
                                                <div class="form-control">
                                                    <span style="margin-right: 20px;">
                                                        <input type="radio" name="sending"  value="now"  v-model="email.item" checked>
                                                        <label>Send Now</label>
                                                    </span>
                                                    <span>
                                                        <input type="radio" name="sending"  value="later"  v-model="email.item" >
                                                        <label>Send Later</label>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-control" v-if="email.item === 'later'">
                                                <input v-model="email.send_date" class="form-control" type="datetime-local" format="YYYY-MM-DD">
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn bg-gradient-dark mb-0" data-bs-dismiss="modal">Fermer</button>
                                            <button type="submit" class="btn bg-gradient-primary mb-0" data-bs-dismiss="modal">Envoyer</button><!--w-auto table-striped  @change="sendEmail"-->
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--end Modal Email -->
            <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1">Envoyer Emai</button>
                    <table class="table table-hover table-sm "> <!--w-auto table-striped-->
                        <thead>
                            <tr>
                                <th scope="col">
                                    <input type="checkbox" @click="select_all_via_check_box" v-model="all_select"> 
                                    <span><small>{{ all_select == true ? 'Uncheck All' : "Select All" }}</small></span>
                                </th>
                                <th scope="col"><small>Email</small></th>
                                <th scope="col"><small>Prenom</small></th>
                                <th scope="col"><small>Nom</small></th>
                                <th scope="col"><small>Expérience</small></th>
                                <th scope="col"><small>Compétence</small></th>
                                <th scope="col"><small>Action</small></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="profile in profiles">
                                <th scope="row"><input type="checkbox" v-model="deleteItems" :value="profile.id"></th>
                                <th scope="row"><small>{{ profile.email }}</small></th>
                                <td><small>{{ profile.prenom }}</small></td>
                                <td><small>{{ profile.nom }}</small></td>
                                <th scope="row"><small>{{moment(profile.date_debut_experience , "YYYY-MM-DD").fromNow()}}</small></th>
                                <td><small style="font-size: 12px;"><b>{{ profile.skill1 ? profile.skill1 : '' }} {{ profile.skill2 ? '| '+profile.skill2 : '' }} {{ profile.skill3 ? '| '+profile.skill3 : '' }} {{ profile.skill4 ? '| '+profile.skill4 : '' }} {{ profile.skill5 ? '| '+profile.skill5 : '' }}</b></small></td>
                                <td>
                                    <router-link :to="{name: 'profiles.show', query: {id: profile.id}}">
                                         <a data-bs-toggle="tooltip" data-bs-placement="top" title="Voir le profile">
                                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" style="vertical-align: -0.125em;" width="1.3em" height="1.3em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16"><path fill="#ec407a" d="M13.5 0h-12C.675 0 0 .675 0 1.5v13c0 .825.675 1.5 1.5 1.5h12c.825 0 1.5-.675 1.5-1.5v-13c0-.825-.675-1.5-1.5-1.5zM13 14H2V2h11v12zM4 9h7v1H4zm0 2h7v1H4zm1-6.5a1.5 1.5 0 1 1 3.001.001A1.5 1.5 0 0 1 5 4.5zM7.5 6h-2C4.675 6 4 6.45 4 7v1h5V7c0-.55-.675-1-1.5-1z"/></svg>
                                        </a> 
                                    </router-link>
                                    <a v-if="profile.pdf" @click="test = profile.pdf" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" data-bs-toggle="tooltip" data-bs-placement="top" title="Voir CV" aria-hidden="true" role="img" style="vertical-align: -0.125em;" width="1.3em" height="1.3em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 448 512"><path fill="#ec407a" d="M48 32C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48H48zm98.88 133.234c19.636 0 37.082 6.789 49.929 16.971c11.88 9.452 17.444 18.907 22.298 27.393l-33.923 16.949c-2.427-5.565-5.347-11.387-12.846-17.682c-8.248-6.552-16.478-8.484-23.524-8.484c-27.626 0-42.17 25.693-42.17 54.287c0 37.573 19.161 56.22 42.17 56.22c22.3 0 31.278-15.51 37.08-25.435L219.6 302.66c-6.315 9.926-12.374 19.635-25.95 29.069c-7.262 5.09-23.977 15.037-47.736 15.037C100.586 346.766 64 313.81 64 255.87c0-50.636 34.415-90.637 82.88-90.637zm75.483 5.328h45.565L303.31 292.24l35.125-121.678H384l-59.379 171.112H281.01l-58.647-171.111z"/></svg>
                                    </a>
                                </td>
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
    import axios from 'axios';
    import { mapActions } from 'vuex';
    import Nav from '.././Nav/Nav.vue';
    var moment = require('moment');
export default {
    components: { Nav },
    data() {
        return {
            moment: moment,
            data : [],
            form: {
                skill: ''
            },
            keyword: null,
            Books: [],
            uploaded_file: '',
            errors: {},
            //selectedMembers: { select_members: [] },
            select_members: [],
            select_members1: [],
            skill: '',
            profiles: [],
            error: [],
            test: {},
            deleteItems: [],
            select: '',
            email: {
                title: '',
                body: '',
                item: 'now',
                send_date: ''
            },
            all_select: false
        }
    },
    watch: {
        keyword(after, before) {
            this.getResults();
        },
        select_members(after, before){
            if (this.select_members.length > 0) {
                this.memberStore();
            } else {
                return this.select_members.length = 0
            }
        },
        select_members1(){
            this.select_members = this.select_members1;
            this.memberStore();
        }
    },
    methods: {
        ...mapActions({
            'getSkillsAll': 'skill/getAllSkills',
            'getSearchResults': 'skill/searchSkill',
            'saveSkill': 'skill/storeSkill',
            'saveSkills': 'skill/storeSkills',
            'searchProfilesBySkills': 'skill/findProfilesBySkills',
            'emailSendToProfiles': 'skill/sendEmailsToProfiles',
            'DownloadCv': 'profile/CVDownload',
        }),
        getAllSkills(){
            this.getSkillsAll().then((res) => this.data = res, console.log(this.data));
        },
        getResults() {
            this.getSearchResults(this.keyword).then((res) => this.data = res.data);//this.Books
        },
        onSubmit() {
            this.saveSkill(this.form)//$('#exampleModal11').modal('hide'),
                .then(() => { this.getAllSkills(), this.flashMessage.success({ message: 'Compétence crée avec succès!', time: 5000 })})
                .catch(e => this.flashMessage.error({ message: e.message, time: 5000 }));
        },
        onFileChange(e) {
            this.uploaded_file = e.target.files[0];
        },
        async onSubmit1() {
            let formData = new FormData();
            formData.append('uploaded_file', this.uploaded_file);
            this.saveSkills(formData).then((res) => {this.getAllSkills(), this.flashMessage.success({ message: res.data.message, time: 5000 })})
                .catch(() => this.flashMessage.error({ message: 'Fichier non téléchargé', time: 5000 }));
        },
        memberStore() {
            console.log(this.select_members);
            this.searchProfilesBySkills(this.select_members)
                .then((res) => this.profiles = res.data, console.log(this.profiles))
                .catch(error => { this.error = error.response.data, console.log('check error: ', this.error)});
        },
        sendEmail() {
            const data = new FormData();
            data.append('profiles_ids', this.deleteItems);
            data.append('title', this.email.title);
            data.append('body', this.email.body);
            data.append('item', this.email.item);
            data.append('send_date', this.email.send_date);
            this.emailSendToProfiles(data)
                .then((res) => {
                    this.deleteItems = [];
                    this.all_select == true ? this.all_select = false : this.all_select = true;
                    this.flashMessage.success({ message: res.data.message, time: 5000 });
                })
                .catch(() => this.flashMessage.error({ message: 'Email non envoyé', time: 5000 }));
        },
        select_all_via_check_box(){
            if(this.all_select == false){
                this.all_select = true
                this.profiles.forEach(profile => {
                    this.deleteItems.push(profile.id)
                });
            }else{
                this.all_select = false
                this.deleteItems = []
            }
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
        }
    },
    mounted() {
        this.getAllSkills()
    },
}
</script>
<style lang="">
    
</style>