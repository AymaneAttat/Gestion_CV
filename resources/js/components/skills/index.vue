<template lang="">
    <div>
        <Nav />
        <br><br><br>
        <!-- Modal une competence -->
        <div class="modal fade" id="exampleModal11" tabindex="-1" aria-labelledby="exampleModal11Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Insérer une Compétence</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <b-form @submit.prevent="insererCompetence()">
                            <b-form-group id="input-group-1" label="Compétence:" label-for="input-1" description="">
                                <b-form-input id="input-1" v-model="form.skill" placeholder="Entrer une compétence" required></b-form-input>
                            </b-form-group>
                            <button type="submit" class="btn bg-gradient-primary w-auto me-1 mb-0" data-bs-dismiss="modal">Ajouter</button> 
                        </b-form>
                    </div>
                </div>
            </div>
        </div><!-- end Modal use competence -->
        <!-- Modal des competences-->
        <div class="modal fade" id="exampleModal12" tabindex="-1" aria-labelledby="exampleModal12Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" style="vertical-align: -0.125em;" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32"><path fill="#20744a" fill-rule="evenodd" d="M28.781 4.405h-10.13V2.018L2 4.588v22.527l16.651 2.868v-3.538h10.13A1.162 1.162 0 0 0 30 25.349V5.5a1.162 1.162 0 0 0-1.219-1.095Zm.16 21.126H18.617l-.017-1.889h2.487v-2.2h-2.506l-.012-1.3h2.518v-2.2H18.55l-.012-1.3h2.549v-2.2H18.53v-1.3h2.557v-2.2H18.53v-1.3h2.557v-2.2H18.53v-2h10.411Z"/><path fill="#20744a" d="M22.487 7.439h4.323v2.2h-4.323zm0 3.501h4.323v2.2h-4.323zm0 3.501h4.323v2.2h-4.323zm0 3.501h4.323v2.2h-4.323zm0 3.501h4.323v2.2h-4.323z"/><path fill="#fff" fill-rule="evenodd" d="m6.347 10.673l2.146-.123l1.349 3.709l1.594-3.862l2.146-.123l-2.606 5.266l2.606 5.279l-2.269-.153l-1.532-4.024l-1.533 3.871l-2.085-.184l2.422-4.663l-2.238-4.993z"/></svg>
                            Insérer des Compétences</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <b-form @submit.prevent="insererCompetences()">
                            <b-form-group id="input-group-1" label="" label-for="input-1" description="Assurez-vous d’insérer le fichier correct."></b-form-group>
                                <b-form-file :state="Boolean(uploaded_file)" placeholder="Insérer un fichier Excel." drop-placeholder="Déposer le fichier ici..." name="uploaded_file" ref="uploaded_file"  @change="onFileChange" required></b-form-file>
                            </b-form-group>
                            <button type="submit" class="btn bg-gradient-primary w-auto me-1 mb-0" data-bs-dismiss="modal">Ajouter</button>
                        </b-form>
                    </div>
                </div>
            </div>
        </div><!-- end Modal des competences -->
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
                            <div class="nav-wrapper position-relative end-0">
                                <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                    <li class="nav-item">
                                        <span class="nav-link mb-0 px-0 py-1" :class="{'active': step == 1}" aria-controls="profile" aria-selected="true">Etape 1</span>
                                    </li>
                                    <li class="nav-item">
                                        <span class="nav-link mb-0 px-0 py-1" :class="{'active': step == 2}" aria-controls="dashboard" aria-selected="false">Etape 2</span>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <span class="nav-link mb-0 px-0 py-1" :class="{'active': step == 3}" aria-controls="dashboard" aria-selected="false">Etape 3</span>
                                    </li> -->
                                </ul>
                            </div>
                            <!-- <section v-if="step == 3">
                                <div class="input-group input-group-static mt-8 mb-4">
                                    <label>Mot de passe du Gmail *</label>
                                    <input v-model="email.password" class="form-control" type="password" required>
                                </div>
                            </section> -->
                            <section v-if="step == 2">
                                <div class="input-group input-group-static mt-8 mb-4">
                                    <label>Titre d'enregistrement</label>
                                    <input v-model="email.historiqueTitle" class="form-control" placeholder="Titre d'enregistrement" type="text" required>
                                    <p class="pb-3">Pour enregistrer la recherche du "compétences/profiles/mail".</p>
                                </div>
                                <div v-if="emailMessageError" class="alert alert-warning text-white font-weight-bold" role="alert">
                                    {{emailMessageError}}
                                </div>
                            </section>
                            <section v-if="step == 1">
                                <div v-if="emailMessageError" class="alert alert-warning text-white font-weight-bold" role="alert">
                                    {{emailMessageError}}
                                </div>
                                <div class="input-group input-group-static mb-4">
                                    <label>Titre *</label>
                                    <input v-model="email.title" class="form-control" placeholder="Objet" type="text" required>
                                </div>
                                <div class="input-group mb-4 input-group-static">
                                    <label>Contenu *</label>
                                    <textarea v-model="email.body" name="message" class="form-control" id="message" rows="4" required></textarea>
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
                            </section>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn bg-gradient-info mb-0" v-if="step != totalsteps" @click.prevent="nextStep">Suivant</button>
                            <button type="button" class="btn bg-gradient-dark mb-0" v-if="step != 1" @click.prevent="prevStep">précédent</button>
                            <button type="submit" class="btn bg-gradient-primary mb-0" v-if="step == totalsteps" data-bs-dismiss="modal">Envoyer</button><!--w-auto table-striped  @change="sendEmail"-->
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--end Modal Email -->
        <!-- main -->
        <div class="card card-body shadow-xl mx-3 mx-md-4 mt-n6 animate__animated animate__backInLeft">
            <div class="container">
                <div class="row">
                    <div v-if="has_permission.includes('ajouter_competence')" class="col">
                        <button type="button" class="btn bg-gradient-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal11"><b-icon icon="plus-square" aria-hidden="true"></b-icon> Une Compétence</button>
                    </div>
                    <div v-if="has_permission.includes('ajouter_competences')" class="col d-flex justify-content-end">
                        <button type="button" class="btn bg-gradient-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal12"><b-icon icon="cloud-upload" aria-hidden="true"></b-icon> Des Compétences</button>
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
                    <div class="row row-cols-xl-6 row-cols-lg-4 row-cols-md-3 row-cols-2 g-6 py-3 mx-auto">
                        <div v-for="dat in data" class="col d-flex justify-content-start">
                            <div>
                                <div class="form-checkbox form-check-inline"><!--  selectedMembers.select_members -->
                                    <input class="form-check-input" type="checkbox" :value="dat.skill" :id="dat.id" v-model="select_skills">
                                    <label class="form-check-label" :for="dat.id"><small>{{ dat.skill }}</small></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="profiles.length > 0">
                    <hr><br>
                    <div class="table-responsive table-responsive-sm text-nowrap">
                        <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1">Envoyer Email</button>
                        <table class="table table-hover table-sm "> <!--w-auto table-striped-->
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <input type="checkbox" @click="select_all_via_check_box" v-model="all_select"> 
                                        <span><small>{{ all_select == true ? 'Uncheck All' : "Select All" }}</small></span>
                                    </th>
                                    <th scope="col"><small><span class="text-dark cursor-pointer" @click="sort('email')">Email
                                        <span v-if="currentSortDir=='asc'">&uarr;</span>
                                        <span v-else>&darr;</span>
                                    </span></small></th>
                                    <th scope="col"><small><span class="text-dark cursor-pointer" @click="sort('prenom')">Prenom
                                        <span v-if="currentSortDir=='asc'">&uarr;</span>
                                        <span v-else>&darr;</span></span></small></th>
                                    <th scope="col"><small><span class="text-dark cursor-pointer" @click="sort('nom')">Nom</span></small></th>
                                    <th scope="col"><small><span class="text-dark cursor-pointer" @click="toggleSort()">Expérience
                                        <span v-if="oldestFirst">&uarr;</span>
                                        <span v-else>&darr;</span>
                                    </span></small></th>
                                    <th scope="col"><small>Compétence</small></th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="profile in profiles" ::key="profile.id">
                                    <th scope="row"><input type="checkbox" v-model="deleteItems" :value="profile.id"></th>
                                    <th scope="row"><small>{{ profile.email }}</small></th>
                                    <td><small>{{ profile.prenom }}</small></td>
                                    <td><small>{{ profile.nom }}</small></td>
                                    <th scope="row"><small>{{moment(profile.date_debut_experience , "YYYY-MM-DD").fromNow()}}</small></th>
                                    <td><small style="font-size: 12px;"><b>{{ profile.skill1 ? profile.skill1 : '' }} {{ profile.skill2 ? '| '+profile.skill2 : '' }} {{ profile.skill3 ? '| '+profile.skill3 : '' }} {{ profile.skill4 ? '| '+profile.skill4 : '' }} {{ profile.skill5 ? '| '+profile.skill5 : '' }}</b></small></td>
                                    <td>
                                        <router-link v-if="is_admin == 'Administrator'" :to="{name: 'profile.edit', params: {id: profile.id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Modifier le profile">
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
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';
    import { mapGetters, mapActions } from 'vuex';
    import Nav from '.././Nav/Nav.vue';
    import pdf from 'vue-pdf';
    var moment = require('moment');
export default {
    components: { Nav, pdf },
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
            select_skills: [],
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
                send_date: '',
                historiqueTitle: '',
                password: '',
                competance: [],
            },
            all_select: false,
            currentSort:'email',
            currentSortDir:'asc',
            oldestFirst: false,//order: { title: '', competance: [], profiles_ids: [] }
            step: 1,
            totalsteps: 2,
            emailMessageError: '',
            currentPage: 0,
			pageCount: 0,
            page: ''
        }
    },
    computed: {
        ...mapGetters({
            'is_admin': 'auth/getRole',
            'has_permission': 'auth/getPermissions'
        }),
    },
    watch: {
        keyword(after, before) {
            this.getResults();
        },
        select_skills(after, before){
            if (this.select_skills.length > 0) {
                this.memberStore();
            } else {
                return this.select_skills.length = 0
            }
        },
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
        insererCompetence() {
            this.saveSkill(this.form)//$('#exampleModal11').modal('hide'),
                .then(() => { this.getAllSkills(), this.flashMessage.success({ message: 'Compétence crée avec succès!', time: 5000 })})
                .catch(e => this.flashMessage.error({ message: e.message, time: 5000 }));
        },
        onFileChange(e) {
            this.uploaded_file = e.target.files[0];
        },
        insererCompetences() {
            let formData = new FormData();
            formData.append('uploaded_file', this.uploaded_file);
            this.saveSkills(formData).then((res) => {this.getAllSkills(), this.flashMessage.success({ message: res.data.message, time: 5000 })})
                .catch(() => this.flashMessage.error({ message: 'Fichier non téléchargé', time: 5000 }));
        },
        memberStore() {
            console.log(this.select_skills);
            this.searchProfilesBySkills(this.select_skills)
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
            //data.append('password', this.email.password);
            if (this.email.historiqueTitle.length > 0) {
                data.append('historiqueTitle', this.email.historiqueTitle);
                data.append('competance', this.select_skills);
            }
            this.emailSendToProfiles(data)
                .then((res) => {
                    this.deleteItems = [];
                    this.email = [];//this.email.title = ''; this.email.body = ''; this.email.orderTitle = '';
                    this.all_select == true ? this.all_select = false : this.all_select = true;
                    this.step == 1;
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
        },
        sort(s) {//if s == current sort, reverse
            if(s === this.currentSort) {
                this.currentSortDir = this.currentSortDir==='asc'?'desc':'asc';
                this.sortedProfiles();
            }
            this.currentSort = s;
            this.sortedProfiles();
        },
        sortedProfiles() {
            return this.profiles.sort((a,b) => {
                let modifier = 1;
                if(this.currentSortDir === 'desc') modifier = -1;
                if(a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
                if(a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
                return 0;
            });
        },
        toggleSort() {
            this.oldestFirst = !this.oldestFirst;
            this.newDates()
        },
        newDates() {
            var order = this.oldestFirst ? 1 : -1;
            // `this` points to the vm instance    
            this.profiles.sort(function(a, b) {
                a = new Date(a.date_debut_experience);
                b = new Date(b.date_debut_experience);
                var results = a > b ? -1 : a < b ? 1 : 0;
                return results * order;
            });
        },
        nextStep(){
            if (this.step == 1) {
                if(!this.email.title && !this.email.body){
                    this.emailMessageError = 'Veuillez renseigner le champ Title et Contenu';
                    let timer;
                    clearTimeout(timer)
                    timer = setTimeout(() => {
                        this.emailMessageError = ''
                    }, 3000)
                    return false;
                }
            }
            if (this.step == 2) {
                if(!this.email.historiqueTitle){
                    this.emailMessageError = 'Veuillez renseigner ce champ';
                    let timer;
                    clearTimeout(timer)
                    timer = setTimeout(() => {
                        this.emailMessageError = ''
                    }, 3000)
                    return false;
                }
            }
            /*if (this.step == 3) {
                if(!this.email.password){
                    this.emailMessageError = 'Veuillez renseigner Ce champ.';
                    let timer;
                    clearTimeout(timer)
                    timer = setTimeout(() => {
                        this.emailMessageError = ''
                    }, 3000)
                    return false;
                }
            }*/
            this.emailMessageError = '';
            this.step++; 
        },
        prevStep(){ this.step--; },
        numPage(path){
            var loadingTask = pdf.createLoadingTask(path);
            loadingTask.promise.then(pdf => { this.pageCount = pdf.numPages;});
        }
    },
    mounted() {
        this.getAllSkills()
    },
}
</script>
<style lang="">
    
</style>