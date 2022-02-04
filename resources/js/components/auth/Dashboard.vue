<template lang="">
    <div>
        <Navbar />
        <br>
        <div class="container">
            <br>
            <img src="/public/image/27562-searching-for-profile.gif" alt="" class="img-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm mt-5">
                        <div class="card-header">
                            <h3>Dashboard</h3>
                        </div>
                        <div class="card-body">
                            <p class="mb-0">You are logged in as <b>{{user.email}}</b></p>
                            <router-link :to="{name: 'skills.index'}">Chercher les technologies</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</template>
<script>
    import { mapGetters, mapActions } from 'vuex'
    import Navbar from '.././Nav/Navbar.vue'
    export default {
        components: { Navbar },
        computed: {
        ...mapGetters({
            'authenticated': 'auth/authenticated',
            'user': 'auth/getUser'
        })
    },
    }
</script>
<style lang="">
    
</style>