<template lang="">
    <div>
        <Nav /><br>
        <!-- main -->
            <section class="card card-body shadow-xl mx-3 mx-md-4 pb-5 position-relative bg-gradient-dark mx-n3 animate__animated animate__backInLeft">
                <div class="container">
                    <!--<div class="row">
                        <div class="col-md-8 text-start mb-3 mt-5">
                            <h3 class="text-white z-index-1 position-relative">Historique</h3>
                            <p class="text-white opacity-8 mb-0">There’s nothing I really wanted to do in life that I wasn’t able to get good at. That’s my skill.</p>
                        </div>
                    </div>-->

                    <div class="row">
                        
                        <div class="col-md-6 m-auto">
                            <br><br><br><br>
                            <img class="animate__animated animate__backInLeft" src="logo.svg" alt="Bitdyn" style="width:80%">
                            <div class="row">
                                <h6 class="text-white animate__animated animate__backInLeft">L'excellence d'un service d'outsourcing IT adapté à tous les types et tailles de business.</h6>
                                <div class="col-8">
                                    <!-- <a href="/login" type="button" class="btn bg-gradient-info mb-0 h-100 position-relative z-index-2">Connectez-vous</a> -->
                                    <router-link :to="{name: 'auth.login'}" class="btn bg-gradient-info mb-0 h-100 position-relative z-index-2">Connectez-vous</router-link>
                                </div>
                            </div><br>
                        </div>
                        <div class="col-md-5 ms-auto">
                            <div class="position-relative animate__animated animate__backInLeft">
                                <!----><br><br><br><br> <img src="assets/img/hero-img.png" class="img-fluid" alt=""><br>
                            </div>
                            <br>
                        </div>
                    </div>
                    <br>
                </div>
            </section>


        <!-- end main <lottie-animation src="https://assets9.lottiefiles.com/packages/lf20_3dbxj2hv.json"/> /img/62874-scrolling.gif-->
    </div>
</template>
<script>
import Nav from '.././Nav/Nav.vue'
import "vue-gifplayer/src/gif.css"
export default {
    components: { Nav },
}
</script>
<style lang="">
    
</style>