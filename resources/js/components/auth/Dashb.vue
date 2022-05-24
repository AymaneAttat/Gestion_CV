<template lang="">
    <div>
        <Nav />
        <!--<Carose />
         main -->
        
        <!-- end main mt-n0-->
        <div class="card card-body shadow-xl mx-3 mx-md-4 my-md-9 animate__animated animate__backInLeft">
            <div class="container py-5">
                <div class="card d-flex blur justify-content-center shadow-lg my-md-0 my-md-6 mt-8 mb-5">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg p-3">
                            <h3 class="text-white text-primary mb-0">Dashboard</h3>
                        </div>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-4 position-relative">
                            <div class="info-horizontal bg-gradient-primary border-radius-xl d-block d-md-flex p-4">
                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" style="vertical-align: -0.125em;" width="1.5em" height="1.8em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path fill="white" d="M249.18 328.324c-9.788 15.384-19.179 30.434-40.222 45.055c-11.256 7.89-37.164 23.306-73.99 23.306C64.709 396.685 8 345.605 8 255.801c0-78.486 53.345-140.486 128.466-140.486c30.434 0 57.474 10.521 77.387 26.304c18.414 14.65 27.038 29.304 34.563 42.456l-52.58 26.273c-3.762-8.626-8.29-17.649-19.913-27.406c-12.784-10.155-25.54-13.152-36.46-13.152c-42.821 0-65.364 39.825-65.364 84.145c0 58.238 29.7 87.143 65.364 87.143c34.563 0 48.48-24.042 57.474-39.426l52.243 26.673zm184.194-204.75H504l-92.037 265.22h-67.597l-90.904-265.22h70.625l54.843 188.6z"/></svg>
                                <div class="ps-0 ps-md-3 mt-3 mt-md-0">
                                    <router-link :to="{name: 'profiles.index'}" class="text-white stretched-link"><h5 class="text-white stretched-link">Profiles</h5></router-link>
                                    <h1 class="text-white"><span id="state1" countTo="70">{{animatedNumberProfile}}</span>+</h1>
                                    
                                </div>
                            </div>

                            <hr class="vertical dark">
                        </div>
                        <div class="col-md-4 position-relative">
                            <div class="info-horizontal bg-gradient-primary border-radius-xl d-block d-md-flex p-4">
                                <i class="material-icons text-white text-3xl">flag</i>
                                <div class="ps-0 ps-md-3 mt-3 mt-md-0">
                                    <router-link :to="{name: 'skills.index'}" class="text-white"><h5 class="text-white">Compétences</h5></router-link>
                                    <h1 class="text-white"><span id="state2" countTo="15">{{animatedNumber}}</span>+</h1>
                                    
                                </div>
                            </div>
                            <hr class="vertical dark">
                        </div>
                        <div class="col-md-4">
                            <div class="info-horizontal bg-gradient-primary border-radius-xl d-block d-md-flex p-4">
                                <i class="material-icons text-white text-primary text-3xl">receipt_long</i>
                                <div class="ps-0 ps-md-3 mt-3 mt-md-0">
                                    <router-link :to="{name: 'historique.index'}" class="text-white"><h5 class="text-white">Historique</h5></router-link>
                                    <h1 class="text-white"><span id="state3" countTo="15">{{animatedNumberHistorique}}</span>+</h1>
                                    
                                </div>
                            </div>
                            <hr class="vertical dark">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Nav from '.././Nav/Nav.vue'
import { mapGetters } from 'vuex'
import axios from 'axios';
export default {
    components: { Nav },
    data() {
        return {
            nbrSkills: '',
            nbrProfiles: '',
            nbrHistoriques: '',
            error: '',
            animateNbrSkill: 0,
            animateNbrProfile: 0,
            animateNbrHistorique: 0
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
        },
        animatedNumberHistorique: function() {
            return this.animateNbrHistorique.toFixed(0);
        }
    },
    watch:{
        nbrSkills(){
            gsap.to(this.$data, { duration: 0.5, animateNbrSkill: this.nbrSkills });
        },
        nbrProfiles(){
            gsap.to(this.$data, { duration: 0.5, animateNbrProfile: this.nbrProfiles });
        },
        nbrHistoriques(){
            gsap.to(this.$data, { duration: 0.5, animateNbrHistorique: this.nbrHistoriques });
        }
    },
    methods: {
        async getNbrSkillsAndProfiles(){
            await axios.get('api/CountSkills').then((res) => {
                this.nbrSkills = res.data.nbrSkills,
                this.nbrProfiles = res.data.nbrProfiles,
                this.nbrHistoriques = res.data.nbrHistoriques
            }).catch(error => {
                this.error = error.response.data
                console.log('check error: ', this.error)}
            )
        },
    },
    created() {
        this.getNbrSkillsAndProfiles();
    },
}
</script>
<style lang="">
    
</style>