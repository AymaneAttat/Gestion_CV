<template lang="">
    <div>
        <Nav />
        <Carose />
        <!-- main -->
        <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">
            <div class="container">
                <div class="section text-center">
                    <section class="pt-3 pb-4" id="count-stats">
                        <div class="container">
                            <div class="row">
                            <div class="col-lg-9 mx-auto py-3">
                                <div class="row">
                                    <div class="col-md-4 position-relative">
                                        <div class="p-3 text-center">
                                            <h1 class="text-gradient text-primary"><span id="state1" countTo="70">{{animatedNumberProfile}}</span>+</h1>
                                            <router-link :to="{name: 'profiles.index'}" class="text-primary icon-move-right"><h5 class="mt-3">Profiles</h5></router-link>
                                        </div>
                                        <hr class="vertical dark">
                                    </div>
                                    <div class="col-md-4 position-relative">
                                        <div class="p-3 text-center">
                                            <h1 class="text-gradient text-primary"> <span id="state2" countTo="15">{{animatedNumber}}</span>+</h1>
                                            <router-link :to="{name: 'skills.index'}" class="text-primary icon-move-right"><h5 class="mt-3">Compétences</h5></router-link>
                                        </div>
                                        <hr class="vertical dark">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="p-3 text-center">
                                            <h1 class="text-gradient text-primary" id="state3" countTo="4">0</h1>
                                            <h5 class="mt-3">Historique</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <!-- end main -->
    </div>
</template>
<script>
import Nav from '.././Nav/Nav.vue'
import Carose from '.././Nav/carose.vue'
import { mapGetters } from 'vuex'
import axios from 'axios';
export default {
    components: { Nav, Carose },
    data() {
        return {
            nbrSkills: '',
            nbrProfiles: '',
            error: '',
            animateNbrSkill: 0,
            animateNbrProfile: 0
        }
    },
    computed: {
        ...mapGetters({
            'authenticated': 'auth/authenticated',
            'user': 'auth/getUser'
        }),
        animatedNumber: function() {
            
            return this.animateNbrSkill.toFixed(0);
        },
        animatedNumberProfile: function() {
            
            return this.animateNbrProfile.toFixed(0);
        }
    },
    watch:{
        nbrSkills(){
            gsap.to(this.$data, { duration: 0.5, animateNbrSkill: this.nbrSkills });
        },
        nbrProfiles(){
            gsap.to(this.$data, { duration: 0.5, animateNbrProfile: this.nbrProfiles });
        }
    },
    methods: {
        async getNbrSkills(){
            await axios.get('api/CountSkills').then(res => 
                this.nbrSkills = res.data
            ).catch(error => {
                this.error = error.response.data
                console.log('check error: ', this.error)}
            )
        },
        async getNbrProfiles(){
            await axios.get('api/CountProfiles').then(res => this.nbrProfiles = res.data).catch(error => {
                this.error = error.response.data
                console.log('check error: ', this.error)}
            )
        }
    },
    created() {
        this.getNbrSkills();
        this.getNbrProfiles();
    },
}
</script>
<style lang="">
    
</style>