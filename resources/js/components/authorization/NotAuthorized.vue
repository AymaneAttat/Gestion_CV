<template lang="">
    <div>
        <Nav />
        <br>
        <div class="card card-body shadow-xl mx-3 mx-md-4 mt-n1" style="width: auto;">
            <div class="container">
                    <div class="row">
                        <div class="col-md-6 m-auto">
                            <div class="row">
                                <div class="section text-center">
                                    <h1 class="animate__animated animate__backInLeft">401, Vous n'avez pas l'autorisation.</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 ms-auto">
                            <div class="position-relative animate__animated animate__backInLeft">
                                <img class="max-width-50 w-100 position-relative z-index-2" src="/img/unauthorized.png" alt="unauthorized">
                            </div>
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
}
</script>
<style lang="">
    
</style>