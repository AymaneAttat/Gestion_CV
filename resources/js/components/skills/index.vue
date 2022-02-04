<template lang="">
    <div>
        <Navbar /><br><br>
        <div class="container px-4 py-5 bg-white">
            <button type="button" class="float-right btn btn-primary btn-sm">+ Ajouter</button>
            
            <h2 class="pb-2 border-bottom">Les technologies</h2>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 py-5">
                <div v-for="dat in data.data" class="col d-flex align-items-start">
                    <div>
                        
                        <label class="form-checkbox">
                            <input type="checkbox" :value="dat.id" v-model="selected">
                            <i class="form-icon"></i><p class="fst-italic">{{ dat.skill }}</p>
                        </label>
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
            test : {}
        }
    },
    methods: {
        async getAllSkills(){
            const test = await axios.get('api/skills-index')
            return this.data = test.data,
            console.log(this.data)
        },
    },
    created() {
        this.getAllSkills()
    },
}
</script>
<style lang="">
    
</style>