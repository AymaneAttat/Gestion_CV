<template lang="">
    <div>

      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#"><img src="logo.svg" alt="Bitdyn" width="110" height="30"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
      
          <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav me-auto">
                <li v-if="authenticated" class="nav-item">
                  <router-link v-if="is_admin == 'Administrator'" class="nav-link" active-class="active" :to="{name: 'dashboard'}">Dashboard</router-link>
                </li>
                <li v-if="authenticated" class="nav-item">
                  <router-link v-if="is_admin == 'Administrator'" active-class="active" :to="{name: 'profiles.index'}" class="nav-link">Profiles</router-link>
                </li>
                <li v-if="authenticated" class="nav-item">
                  <router-link active-class="active" :to="{name: 'historique.index'}" class="nav-link">Historiques</router-link>
                </li>
                <li v-if="authenticated" class="nav-item">
                  <router-link :to="{name: 'skills.index'}" active-class="active" class="nav-link">Compétences</router-link>
                </li>
                <li v-if="authenticated" class="nav-item">
                  <router-link v-if="is_admin == 'Administrator'" active-class="active" :to="{name: 'users.index'}" class="nav-link">Utilisateurs</router-link>
                </li><!-- v-can="'ajouter_utilisateur'" v-if="is_admin == 1" v-if="$can('ajouter_profiles')" v-can="'ajouter_utilisateur'" v-if="Laravel.user.can['Administrator']" v-can="'ajouter_utilisateur'"-->
            </ul>
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <li v-if="!authenticated" class="nav-item-active">
                  <a class="nav-link" href="/login">Connecter</a>
                </li>
                <li class="nav-item-active" v-if="authenticated">
                  <a class="nav-link active" href="#">{{user.name}}</a>
                </li>
                <li v-if="authenticated" class="nav-item-active">
                    <a @click="logOut" class="nav-link" href="#">
                      <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" style="vertical-align: -0.125em; color: #ec407a" width="1.2em" height="1.2em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><g fill="currentColor"><path d="M13 4.009a1 1 0 1 0-2 0l-.003 8.003a1 1 0 0 0 2 0L13 4.01Z"/><path d="M4 12.992c0-2.21.895-4.21 2.343-5.657l1.414 1.414a6 6 0 1 0 8.485 0l1.415-1.414A8 8 0 1 1 4 12.992Z"/></g></svg>Log out
                    </a>
                </li>
            </ul>
            
          </div>
        </div>
    </nav>
    </div>
</template>
<script>
//import x from '../../../../public/assets/img/down-arrow-dark.svg' this.$store.state.auth.authenticated this.$store.auth.commit('authenticated')
    import { mapGetters, mapActions } from 'vuex'
export default {
    computed: {
        ...mapGetters({
            'authenticated': 'auth/authenticated',
            'user': 'auth/getUser',
            'is_admin': 'auth/getRole'
        })
    },
    methods: {
        ...mapActions({
            'signOut': 'auth/signOut'
        }),
        logOut(){
            this.signOut().then(() => this.$router.replace({ name: 'main'}))
        },
    },
}
</script>
<style lang="">
    
</style>