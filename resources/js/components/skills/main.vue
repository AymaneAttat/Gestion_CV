<template lang="">
    <div>
        <Nav />
        <!-- main -->
        <div class="card card-body shadow-xl mx-3 mx-md-4 mt-2">
            <section class="my-5 pt-3">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 m-auto">
                            <img class="animate__animated animate__backInLeft" src="logo.svg" alt="Bitdyn" style="width:90%">
                            <div class="row">
                                <h6 class="animate__animated animate__backInLeft">L'excellence d'un service d'outsourcing IT adapté à tous les types et tailles de business.</h6>
                                <div class="col-8">
                                    <!-- <a href="/login" type="button" class="btn bg-gradient-info mb-0 h-100 position-relative z-index-2">Connectez-vous</a> -->
                                    <router-link :to="{name: 'auth.login'}" class="btn bg-gradient-info mb-0 h-100 position-relative z-index-2">Connectez-vous</router-link>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 ms-auto">
                            <div class="position-relative animate__animated animate__backInLeft">
                                <img class="max-width-50 w-100 position-relative z-index-2" src="/img/62874-scrolling.gif" alt="image">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- end main <lottie-animation src="https://assets9.lottiefiles.com/packages/lf20_3dbxj2hv.json"/> /img/62874-scrolling.gif-->
    </div>
</template>
<script>
import Nav from '.././Nav/Nav.vue'
import carose from '.././Nav/carose.vue'
import Footer from '.././Nav/Footer.vue'
import "vue-gifplayer/src/gif.css"
export default {
    components: { Nav, Footer, carose },
}
</script>
<style lang="">
    
</style>