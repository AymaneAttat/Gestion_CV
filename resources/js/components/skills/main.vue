<template lang="">
    <div>
        <Nav />
        <carose />
        <!-- main -->
        <div class="card card-body shadow-xl mx-3 mx-md-4 mt-n6">
            <div class="container">
                <div class="section text-center">
                    <h2 class="title">Your main section here</h2>
                    
                    <img src="/img/93505-recruiter-hiring.gif" width="500" height="300" alt="">
                </div>
            </div>
        </div>
        <!-- end main <lottie-animation src="https://assets9.lottiefiles.com/packages/lf20_3dbxj2hv.json"/>-->
        <Footer />
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