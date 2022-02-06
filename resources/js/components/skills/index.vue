<template lang="">
    <div>
        <Navbar /><br><br><br><br>
        <div class="container px-4 py-5 bg-white">
            
            <b-dropdown id="dropdown-dropup" dropup text="+ Ajouter" variant="primary" class="float-right m-2">
                <b-dropdown-item href="#" v-b-modal.modal-multi-1>Ajouter une Compétence</b-dropdown-item>
                <b-dropdown-item href="#" v-b-modal.modal-multi-2>Insérer des compétences</b-dropdown-item>
            </b-dropdown>
            
            <b-modal id="modal-multi-1" title="Ajouter une Compétence" hide-footer>
                <b-form @submit="onSubmit()" v-if="show">
                    <b-form-group id="input-group-1" label="Compétence:" label-for="input-1" description="We'll never share your email with anyone else.">
                        <b-form-input id="input-1" v-model="form.skill" placeholder="Entrer une compétence" required></b-form-input>
                    </b-form-group>
              
                    <b-button type="submit" variant="primary">Ajouter</b-button>
                </b-form>
            </b-modal>

            <b-modal id="modal-multi-2" title="Insérer des compétences" ok-only no-stacking>
                <p class="my-4">Hello from modal!</p>
                <b-form @submit="onSubmit1()" v-if="show">
                    <b-form-group id="input-group-1" label="Compétence:" label-for="input-1" description="assurez-vous d’insérer le fichier correct."></b-form-group>
                        <b-form-file v-model="file" :state="Boolean(file)" placeholder="Choisissez un fichier ou déposez-le ici..." drop-placeholder="Déposer le fichier ici..."></b-form-file>
                    </b-form-group>
                    <b-button type="submit" variant="primary">Ajouter</b-button>
                </b-form>
                <div class="mt-3">Selected file: {{ file ? file.name : '' }}</div>
            </b-modal>
            <h2 class="pb-3 border-bottom">Les technologies</h2>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 g-6 py-5">
                <div v-for="dat in data.data" class="col d-flex justify-content-start">
                    <div>
                        <div class="form-checkbox form-check-inline">
                            <input class="form-check-input" type="checkbox" :value="dat.id">
                            <label class="form-check-label">{{ dat.skill }}</label>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="text-center">
                <button type="button" class="float-center btn btn-secondary" style="background-color: #ac2bac; ">Chercher</button>
            </div>
            
        </div>
    </div>
</template>
<script>
//import { mapGetters, mapActions } from 'vuex' border-radius: 5px 25px;
    import axios from 'axios';
    import Navbar from '.././Nav/Navbar.vue'
export default {
    components: { Navbar },
    data() {
        return {
            data : {},
            form: {
                skill: ''
            },
            foods: [{ text: 'Select One', value: null }, 'Carrots', 'Beans', 'Tomatoes', 'Corn'],
            show: true,
            file: null
        }
    },
    methods: {
        async getAllSkills(){
            const test = await axios.get('api/skills-index')
            return this.data = test.data,
            console.log(this.data)
        },
        async onSubmit() {
            await axios.post('api/upload-skill', this.form).then(() => this.$router.replace({name: 'skills.index'}));
        },
        async onSubmit1() {
            await axios.post('api/upload-content', this.file).then(() => this.$router.replace({name: 'skills.index'}));
        }
        /*
        onSubmit(event) {
            event.preventDefault()
            alert(JSON.stringify(this.form))
        }
        */
    },
    created() {
        this.getAllSkills()
    },
}
</script>
<style lang="">
    
</style>