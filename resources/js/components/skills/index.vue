<template lang="">
    <div>
        <Nav />
        <br><br><br>
        <!-- main -->
        <div class="card card-body shadow-xl mx-3 mx-md-4 mt-n6">
            <div class="container">
                <div class="section text-center">
                        <div class="col-lg-4 ms-lg-auto col-md-6 col-sm-3 d-flex justify-content-end">
                            <b-dropdown id="dropdown-offset" offset="25" text="+ Insérer" variant="primary" class="m-2">
                                <b-dropdown-item href="#" v-b-modal.modal-multi-1>une Compétence</b-dropdown-item>
                                <b-dropdown-item href="#" v-b-modal.modal-multi-2>des Compétence</b-dropdown-item>
                            </b-dropdown>
                        </div>
                        <b-modal id="modal-multi-1" title="Ajouter une Compétence" hide-footer>
                            <div class="mt-2 mb-6 text-sm text-red-600" v-if="errors !== ''">
                                {{ errors }}
                            </div>
                            <b-form @submit.prevent="onSubmit()">
                                <b-form-group id="input-group-1" label="Compétence:" label-for="input-1" description="We'll never share your email with anyone else.">
                                    <b-form-input id="input-1" v-model="form.skill" placeholder="Entrer une compétence" required></b-form-input>
                                </b-form-group>
                                <button type="submit" class="btn bg-gradient-primary w-auto me-1 mb-0">Ajouter</button>
                                
                            </b-form>
                        </b-modal>
            
                        <b-modal id="modal-multi-2" title="Insérer des compétences" hide-footer>
                            <b-form @submit.prevent="onSubmit1()">
                                <b-form-group id="input-group-1" label="" label-for="input-1" description="assurez-vous d’insérer le fichier correct."></b-form-group>
                                    <b-form-file :state="Boolean(uploaded_file)" placeholder="Insérer un fichier de type csv ou xlsx" drop-placeholder="Déposer le fichier ici..." name="uploaded_file" ref="uploaded_file"  @change="onFileChange"></b-form-file>
                                </b-form-group>
                                <button type="submit" class="btn bg-gradient-primary w-auto me-1 mb-0">Ajouter</button>
                            </b-form>
                        </b-modal>

                    <div class="row text-center py-2 mt-3">
                        <div class="col-4 mx-auto">
                            <div class="input-group input-group-dynamic mb-4">
                                <input class="form-control" v-model="keyword" placeholder="Chercher Compétence..." type="text" >
                            </div>
                        </div>
                        
                    </div>
                    
                        <div class="row row-cols-sm-6 row-cols-2 g-6 py-3 mx-auto" v-if="Books.length == 0">
                            
                                <div v-for="dat in data" class="col d-flex justify-content-start">
                                    <div>
                                        <div class="form-checkbox form-check-inline"><!--  selectedMembers.select_members -->
                                            <input class="form-check-input" type="checkbox" :value="dat.skill" v-model="select_members">
                                            <label class="form-check-label"><small>{{ dat.skill }}</small></label>
                                        </div>
                                    </div>
                                </div>
                                
                            <div v-if="data.length == 0">
                                <div class="section text-center">
                                    <h2 class="title">Vide</h2>
                                </div>
                            </div>
                        </div>
                    <!--    <div class="text-center">
                            <button class="float-center btn btn-secondary" style="background-color: #ac2bac; ">Chercher</button>
                        </div>
                     <form @submit.prevent="memberStore()"></form> -->
                    <div v-if="Books.length > 0" class="row row-cols-sm-6 row-cols-2 g-6 py-3 mx-auto">
                        <div v-for="book in Books" class="col d-flex justify-content-start">
                            <div>
                                <div class="form-checkbox form-check-inline">
                                    <input class="form-check-input" type="checkbox" :value="book.skill" v-model="select_members1">
                                    <label class="form-check-label"><small>{{ book.skill }}</small></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="profiles.length > 0">
                    <hr><br>
                    <table class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <input type="checkbox" @click="select_all_via_check_box" v-model="all_select"> 
                                    <span><small> {{ all_select == true ? 'Uncheck All' : "Select All" }} </small></span>
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
                                <td><small><b>{{ profile.skill1 ? profile.skill1 : '' }}</b></small> <small><b>{{ profile.skill2 ? '| '+profile.skill2 : '' }}</b></small> <small><b>{{ profile.skill3 ? '| '+profile.skill3 : '' }}</b></small> <small><b>{{ profile.skill4 ? '| '+profile.skill4 : '' }}</b></small> <small><b>{{ profile.skill5 ? '| '+profile.skill5 : '' }}</b></small></td>
                                <td>
                                    <router-link :to="{name: 'profiles.test', query: {id: profile.id}}">
                                         <a>
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Voir le profile">
                                                <b-icon icon="eye" style="color: #ec407a;" animation="throb" font-scale="2" />
                                            </span>
                                        </a> 
                                    </router-link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';
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
        async getAllSkills(){
            const test = await axios.get('api/skills-index')
            return this.data = test.data.data,
            console.log(this.data)
        },
        getResults() {
            axios.get('api/livesearch', { params: { keyword: this.keyword } })
                .then(res => this.Books = res.data)
                .catch(error => {});
        },
        onSubmit() {
            try {
                axios.post('api/upload-skill', this.form).then(() => 
                    this.$router.replace({name: 'skills.index'}),
                    this.flashMessage.success({
                        message: 'Compétence crée avec succès!',
                        time: 5000
                    })
                );
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
        onFileChange(e) {
            this.uploaded_file = e.target.files[0];
        },
        async onSubmit1() {
            let formData = new FormData();
            formData.append('uploaded_file', this.uploaded_file);
            await axios.post('api/upload-content', formData).then(() => {
                this.getAllSkills();
                //this.$router.replace({name: 'skills.index'}) 
            }) 
            .catch(error => {
                // code here when an upload is not valid
                //this.uploading = false
                this.error = error.response.data
                console.log('check error: ', this.error)
            });/**/
            //await axios.post('api/upload-content', formData).then(() => this.$router.replace({name: 'skills.index'})) this.getAllSkills();
        },
        memberStore() {
            //console.log(this.selectedMembers.select_members);
            //let obj = {select_members: this.selectedMembers.select_members}
            //console.log(obj.select_members)
            console.log(this.select_members)
            //this.test = this.selectedMembers
            /*var rar = new Array();
            for (let i = 0; i < this.selectedMembers..length; i++) {
                //const element = array[i];
                rar.push(this.selectedMembers.select_members[i]);
            }*/
            //rar.push(1)
            //rar.push(2)
            //console.log(rar)
            //this.test = obj
            //console.log(this.test)
            //axios.get('api/searchProfiles/'+ rar ){ rar:this.rar }  _.omit(this.selectedMembers, 'select_members')
            if (this.select_members.length > 0) {
                axios.get('api/searchProfiles', {params:{select_members:this.select_members}})
                .then(res => 
                    this.profiles = res.data,
                    console.log(this.profiles)
                )
                .catch(error => {
                    this.error = error.response.data
                    console.log('check error: ', this.error)
                });
            }else{
                return this.select_members.length = 0
            }
            /**/
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
        }
    },
    mounted() {
        this.getAllSkills()
    },
}
</script>
<style lang="">
    
</style>