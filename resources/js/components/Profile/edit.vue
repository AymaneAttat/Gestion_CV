<template lang="">
    <div>
        <Nav />
        <br><br><br>
        <div class="card card-body shadow-xl mx-3 mx-md-4 mt-n6">
            <div class="container py-5">
                <div class="card d-flex blur justify-content-center shadow-lg my-sm-0 my-sm-6 mt-8 mb-5">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg p-3">
                            <h3 class="text-white text-primary mb-0">Modifier Profile</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        
                        <form id="contact-form" @submit.prevent="modifierProfile()">
                            <div class="card-body p-0 my-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Prenom</label>
                                            <input v-model="prof.prenom" type="text" class="form-control" placeholder="Prénom">
                                        </div>
                                    </div>
                                    <div class="col-md-6 ps-md-2">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Nom</label>
                                            <input v-model="prof.nom" type="text" class="form-control" placeholder="Nom familier">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Téléphone</label>
                                            <input v-model="prof.telephone" type="text" class="form-control" placeholder="Numéro Télephone">
                                        </div>
                                    </div>
                                    <div class="col-md-6 ps-md-2">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Email</label>
                                            <input v-model="prof.email" type="email" class="form-control" placeholder="hello@creative-tim.com">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 ps-md-2">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Date début d'expérience</label>
                                            <input v-model="prof.date_debut_experience" class="form-control" type="date">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Compétence 1</label>
                                            <input v-model="prof.skill1" type="text" class="form-control" placeholder="Compétence">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Compétence 2</label>
                                            <input v-model="prof.skill2" type="text" class="form-control" placeholder="Compétence">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Compétence 3</label>
                                            <input v-model="prof.skill3" type="text" class="form-control" placeholder="Compétence">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Compétence 4</label>
                                            <input v-model="prof.skill4" type="text" class="form-control" placeholder="Compétence">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Compétence 5</label>
                                            <input v-model="prof.skill5" type="text" class="form-control" placeholder="Compétence">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-0 mt-md-0 mt-4">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Formation</label>
                                        <textarea v-model="prof.formation" name="message" class="form-control" id="message" rows="6" placeholder="Formation"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn bg-gradient-primary mt-3 mb-0">Modifier</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Nav from '.././Nav/Nav.vue'
export default {
    components: { Nav },
    data() {
        return {
            prof: {},
            //id: this.$route.params.id
            id: this.$route.query.id,
        }
    },
    methods: {
        async getProfile(){
            //console.log(this.id)  {{moment(prof.date_debut_experience , 'YYYY-MM-DD').format('YYYY-MM-DD')}} push
            const test = await axios.get('api/show-profile/'+this.id)
            return this.prof = test.data
        },
        async modifierProfile(){
            await axios.put('/api/update-profile/'+ this.prof.id, this.prof).then(() => this.$router.replace({name: 'profiles.test', query: {id: this.prof.id}}))
            .catch(error => {
                this.error = error.response.data
                console.log('check error: ', this.error)
            });
        }
    },
    mounted() {
        this.getProfile()
    },
}
</script>
<style lang="">
    
</style>