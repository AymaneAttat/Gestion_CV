<template lang="">
    <div>
        <Nav />
        <br><br><br><br>
        <div class="card card-body shadow-xl mx-3 mx-md-4 mt-n6">
            <div class="container">
                <div class="section text-center">
                    <section class="py-sm-7 py-5 position-relative">
                        <div class="container">
                            <div class="row">
                            <div class="col-12 mx-auto">
                                
                                <div class="row py-5">
                                    <div class="col-lg-7 col-md-7 z-index-2 position-relative px-md-2 px-sm-5 mx-auto">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h3 class="mb-0">{{prof.prenom}} {{prof.nom}}</h3>
                                            <div class="d-block">
                                                <button type="button" class="btn btn-sm btn-outline-info text-nowrap mb-0">{{prof.email}}</button>
                                            </div>
                                        </div>
                                        <p class="text-lg mb-0">
                                            {{prof.formation}}.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="table-responsive-sm">
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" style="max-width: 80%;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Your modal title</h5>
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
                    <table class="table table-hover table-sm table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">Expérience</th>
                                <th scope="col">Compétence</th>
                                <th scope="col">Téléphone</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row"><small>{{moment(prof.date_debut_experience , "YYYY-MM-DD").fromNow()}}, depuis {{prof.date_debut_experience}}</small></th>
                                <td scope="row"><small><b>{{ prof.skill1 ? prof.skill1 : '' }}</b><b>{{ prof.skill2 ? '| '+prof.skill2 : '' }}</b> <b>{{ prof.skill3 ? '| '+prof.skill3 : '' }}</b> <b>{{ prof.skill4 ? '| '+prof.skill4 : '' }}</b> <b>{{ prof.skill5 ? '| '+prof.skill5 : '' }}</b></small></td>
                                <td scope="row"><small>{{prof.telephone}}</small></td>
                                <td scope="row">
                                    <span v-if="prof.pdf"  @click="test = prof.pdf.path" class="badge bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" data-bs-toggle="tooltip" data-bs-placement="top" title="Voir CV" aria-hidden="true" role="img" style="vertical-align: -0.125em;" width="1em" height="1.3em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 448 512"><path fill="currentColor" d="M48 32C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48H48zm98.88 133.234c19.636 0 37.082 6.789 49.929 16.971c11.88 9.452 17.444 18.907 22.298 27.393l-33.923 16.949c-2.427-5.565-5.347-11.387-12.846-17.682c-8.248-6.552-16.478-8.484-23.524-8.484c-27.626 0-42.17 25.693-42.17 54.287c0 37.573 19.161 56.22 42.17 56.22c22.3 0 31.278-15.51 37.08-25.435L219.6 302.66c-6.315 9.926-12.374 19.635-25.95 29.069c-7.262 5.09-23.977 15.037-47.736 15.037C100.586 346.766 64 313.81 64 255.87c0-50.636 34.415-90.637 82.88-90.637zm75.483 5.328h45.565L303.31 292.24l35.125-121.678H384l-59.379 171.112H281.01l-58.647-171.111z"/></svg>
                                    </span>
                                    <span v-else data-bs-toggle="tooltip" data-bs-placement="top" title="Ajouter CV pdf" class="badge bg-gradient-primary">
                                        <form method="POST" enctype="multipart/form-data">
                                            <input type="file" @change="selectFile">
                                        </form>
                                    </span>
                                    <router-link :to="{name: 'profile.edit', query: {id: prof.id}}">
                                        <a>
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Modifier le profile" class="badge bg-gradient-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" style="vertical-align: -0.125em;" width="1em" height="1.3em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 36 36"><path d="M28 30H6V8h13.22l2-2H6a2 2 0 0 0-2 2v22a2 2 0 0 0 2 2h22a2 2 0 0 0 2-2V15l-2 2z" class="clr-i-outline clr-i-outline-path-1" fill="currentColor"/><path d="M33.53 5.84l-3.37-3.37a1.61 1.61 0 0 0-2.28 0L14.17 16.26l-1.11 4.81A1.61 1.61 0 0 0 14.63 23a1.69 1.69 0 0 0 .37 0l4.85-1.07L33.53 8.12a1.61 1.61 0 0 0 0-2.28zM18.81 20.08l-3.66.81l.85-3.63L26.32 6.87l2.82 2.82zM30.27 8.56l-2.82-2.82L29 4.16L31.84 7z" class="clr-i-outline clr-i-outline-path-2" fill="currentColor"/></svg>
                                            </span>
                                        </a>
                                    </router-link>
                                    <a @click="deleteProfile">
                                        <a>
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Supprimer le profile" class="badge bg-gradient-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" style="vertical-align: -0.125em;" width="1em" height="1.3em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path d="M42.7 469.3c0 23.5 19.1 42.7 42.7 42.7h341.3c23.5 0 42.7-19.1 42.7-42.7V192H42.7v277.3zm320-213.3h42.7v192h-42.7V256zm-128 0h42.7v192h-42.7V256zm-128 0h42.7v192h-42.7V256zm384-170.7h-128V42.7C362.7 19.1 343.5 0 320 0H192c-23.5 0-42.7 19.1-42.7 42.7v42.7h-128C9.5 85.3 0 94.9 0 106.7V128c0 11.8 9.5 21.3 21.3 21.3h469.3c11.8 0 21.3-9.5 21.3-21.3v-21.3c.1-11.8-9.4-21.4-21.2-21.4zm-170.7 0H192V42.7h128v42.6z" fill="currentColor"/></svg>
                                            </span>
                                        </a>
                                    </a>
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
    import Nav from '../Nav/Nav.vue';
    import { mapActions } from 'vuex';
    var moment = require('moment');
export default {
    components: { Nav },
    //props: ['id'],
    data() {
        return {
            prof: {},
            //id: this.$route.params.id
            id: this.$route.query.id,
            moment: moment,
            file: '',
            error: '',
            test: ''
        }
    },
    methods: {
        ...mapActions({
            'findProfile': 'profile/getProfile',
            'supprimerProfile': 'profile/deleteProfile',
        }),
        getProfile(){
            this.findProfile(this.id).then((res) => { this.prof = res });
        },
        deleteProfile() {
            this.supprimerProfile(this.prof.id).then((res) => this.$router.replace({name: 'profiles.index'}), this.flashMessage.success({ message: 'Profile Supprimer !', time: 5000 }))
        },
        selectFile(event){
            this.file = event.target.files[0];
            this.saveCV();
        },
        async saveCV(){
            let formData = new FormData();
            formData.append('file', this.file);
            formData.append('id', this.id);
            await axios.post('api/store-cv', formData).then(() => 
                this.$router.replace({name: 'profiles.index'}),
                this.flashMessage.success({ message: 'CV télécharger avec succès!', time: 5000 })
            )
            .catch(error => {
                this.error = error.response.data
                console.log('check error: ', this.error)
                this.flashMessage.error({ message: 'CV non télécharger !', time: 5000 });
            });
        }
    },
    created() {
        this.getProfile()
    },
}
</script>
<style lang="">
    
</style>