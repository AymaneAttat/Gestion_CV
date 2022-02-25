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
                                <td scope="row"><small><b>{{ prof.skill1 ? prof.skill1 : '' }}</b></small> <small><b>{{ prof.skill2 ? '| '+prof.skill2 : '' }}</b></small> <small><b>{{ prof.skill3 ? '| '+prof.skill3 : '' }}</b></small> <small><b>{{ prof.skill4 ? '| '+prof.skill4 : '' }}</b></small> <small><b>{{ prof.skill5 ? '| '+prof.skill5 : '' }}</b></small></td>
                                <td scope="row"><small>{{prof.telephone}}</small></td>
                                <td scope="row">
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="Ajouter CV pdf" class="badge bg-gradient-primary">
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
    import Nav from '.././Nav/Nav.vue'
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
            error: ''
        }
    },
    methods: {
        async getProfile(){
            //console.log(this.id)
            try {
                const test = await axios.get('api/show-profile/'+this.id)
                return this.prof = test.data.data 
            } catch (e) {
                this.error = e.response.data
                console.log('check error: ', this.error)
                this.flashMessage.error({
                    message: this.error.message,
                    time: 5000
                });
            }
            
        },
        async deleteProfile() {
            await axios.delete('/api/delete-profile/'+ this.prof.id).then(() => this.$router.replace({name: 'profiles.index'}))
            .catch(error => {
                this.error = error.response.data
                console.log('check error: ', this.error)
            });

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
                this.flashMessage.success({
                    message: 'fichier télécharger avec succès!',
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
        }
    },
    created() {
        this.getProfile()
    },
}
</script>
<style lang="">
    
</style>