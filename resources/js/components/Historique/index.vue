<template lang="">
    <div>
        <Nav />
        <br><br><br>
        <!-- main -->
        <!-- start Modal Email -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 50%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Email</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-light">
                        <div class="card p-5 p-lg-10 space-y-4">
                            <h1 class="h3 fw-700">{{ mail.title }}</h1>
                            <p>{{mail.body}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end Modal Email -->
        <!-- start Modal Profile -->
        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModal1Label" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 50%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Profiles</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive table-responsive-sm text-nowrap">
                            <table class="table table-hover table-sm">
                                <tbody>
                                    <tr v-for="profile in profiles" ::key="profile.id">
                                        <td><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" style="vertical-align: -0.125em;" width="1.2em" height="1.2em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32"><path fill="#ec407a" d="M16 8a5 5 0 1 0 5 5a5 5 0 0 0-5-5Z"/><path fill="#ec407a" d="M16 2a14 14 0 1 0 14 14A14.016 14.016 0 0 0 16 2Zm7.992 22.926A5.002 5.002 0 0 0 19 20h-6a5.002 5.002 0 0 0-4.992 4.926a12 12 0 1 1 15.985 0Z"/></svg></td>
                                        <td><small>{{profile.prenom}}</small></td>
                                        <td><small>{{profile.nom}}</small></td>
                                        <td><small>{{profile.email}}</small></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!--end Modal Profil -->
        <div class="card card-body shadow-xl mx-3 mx-md-4 mt-n6 animate__animated animate__backInLeft">
            <!-- -------- START Card -------- -->
            <div v-if="historiques.length == 0">
                <div class="section text-center">
                    <div class="position-relative">
                        <img class=" position-relative z-index-2" width="44%" height="32%" src="/img/77703-no-data-found.gif" alt="image">
                    </div>
                </div>
            </div>
            <section v-else class="pb-5 position-relative bg-gradient-dark mx-n3">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 text-start mb-3 mt-5">
                            <h3 class="text-white z-index-1 position-relative">Historique</h3>
                        </div>
                    </div>
                    <div class="row text-center py-2">
                        <div class="col-4 mx-auto">
                            <div class="input-group input-group-dynamic mb-2">
                                <input class="form-control" style="background-color: white;" v-model.lazy="keyword" placeholder="Chercher...." type="text" >
                            </div>
                        </div>
                    </div>

                    <div class="row row-cols-xl-2 row-cols-lg-2 row-cols-md-1 row-cols-1 g-2 py-3 mx-auto">  
                        <div v-for="historique in historiques.data" ::key="historique.id">
                            <div class="col d-flex justify-content-start">
                                <div class="card card-profile w-100"><!-- class="col-lg-6 col-12" mt-4 -->
                                    <div class="card-body ps-lg-3">
                                        <div class="row">
                                            <div class="col-8 justify-content-start">
                                                <h5 class="mb-0">{{ historique.title }}</h5>
                                            </div>
                                            <div class="col-4 d-flex justify-content-end">
                                                <p class="mb-0">{{ historique.user.name }}</p>
                                            </div>
                                        </div>
                                        <h6 class="text-info">{{ historique.skills }}</h6>
                                        <div class="row">
                                            <div v-if="historique.mail_profiles.profiles.length == 0" class="col justify-content-start">
                                                <span class="badge rounded-pill bg-gradient-danger mb-2"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1.4em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="white" d="M11.001 10h2v5h-2zM11 16h2v2h-2z"/><path fill="white" d="M13.768 4.2C13.42 3.545 12.742 3.138 12 3.138s-1.42.407-1.768 1.063L2.894 18.064a1.986 1.986 0 0 0 .054 1.968A1.984 1.984 0 0 0 4.661 21h14.678c.708 0 1.349-.362 1.714-.968a1.989 1.989 0 0 0 .054-1.968L13.768 4.2zM4.661 19L12 5.137L19.344 19H4.661z"/></svg> Email n'a pas envoyer</span>
                                            </div>                                            
                                            <div v-else class="col justify-content-start">
                                                <span class="badge rounded-pill bg-gradient-primary cursor-pointer mb-2" @click="mail = historique.mail_profiles" data-bs-toggle="modal" data-bs-target="#exampleModal">Email</span>
                                                <span class="badge rounded-pill bg-gradient-primary cursor-pointer" @click="profiles = historique.mail_profiles.profiles" data-bs-toggle="modal" data-bs-target="#exampleModal1">les condidats</span>
                                            </div>
                                            <div class="col d-flex justify-content-end">
                                                <h5 class="mb-0">{{moment(historique.created_at).format('MMMM Do YYYY')}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <pagination :data="historiques" :limit="2" @pagination-change-page="getAllHistoriques">
                    </pagination>
                </div>
            </section>
            <!-- -------- END Card -------- -->
        </div>
    </div>
</template>
<script>
import Nav from '.././Nav/Nav.vue';
import axios from 'axios';
var moment = require('moment');
export default {
    components: { Nav },
    data() {
        return {
            historiques: {},
            moment: moment,
            mail: [],
            profiles: [],
            keyword: ''
        }
    },
    watch:{
        keyword(after, before) {
            this.searchInHistoriq();
        }
    },
    methods: {
        async getAllHistoriques(page){
            if (typeof page === 'undefined') { page = 1; }
            await axios.get('api/historique-index?page=' + page).then((res) => {
                this.historiques = res.data; 
            }).catch((err) => {
                console.log(err.response.data);
            })
        },
        async searchInHistoriq(){
            await axios.get('api/SearchHistoriques', { params: { keyword: this.keyword } }).then((res) => {this.historiques = res.data}).catch((err) => { console.log(err.response.data); });
        },
    },
    mounted() {
        this.getAllHistoriques()
    },
}
</script>
<style lang="">
    
</style>