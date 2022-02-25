<template lang="">
    <div>
        <Nav />
        <br><br><br>
        <div class="card card-body shadow-xl mx-3 mx-md-4 mt-n6">
            <div class="container">
                <div class="section text-center">
                    <div class="table-responsive-sm">
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Email</th>
                                    <th scope="col">PRENOM</th>
                                    <th scope="col">NOM</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><!--v-for="profile in profiles.data"-->
                                    <th scope="row"><small>vide</small></th>
                                    <td><small>vide</small></td>
                                    <td><small>vide</small></td>
                                    <th scope="row"><small>vide</small></th>
                                    <td><small>vide</small></td>
                                </tr>
                            </tbody>
                        </table>
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
    data() {
        return {
            users: [],
            errors: ''
        }
    },
    methods: {
        /*async getAllUsers(){
            try {
                const test = await axios.get('api/users-index')
                return this.users = test.data.data
                console.log(this.users)
            } catch (e) {
                
            }
            
        },*/
    },
    mounted() {
        this.getAllUsers()
    },
}
</script>
<style lang="">
    
</style>