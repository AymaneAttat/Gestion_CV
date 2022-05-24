<template lang="">
    <div oncontextmenu="return false">
        <Nav />
        <br><br><br>
        <!-- main -->
        <div class="card card-body shadow-xl mx-3 mx-md-4 mt-n6 animate__animated animate__backInLeft" style="width: auto;">
            <div class="section text-center">
                <div class="container">
                    <pdf v-for="i in pageCount" :key="i" :src="url" :page="i" style="width: 70%; margin-left: auto; margin-right: auto;" oncontextmenu="return false"></pdf><br>
                    <button v-if="is_admin == 'Administrator'" type="button" class="btn bg-gradient-primary mb-0 btn-icon rounded-pill" data-bs-dismiss="modal"  @click="DownloadCV(pdfID)">
                        <div class="d-flex align-items-center">
                            <b-icon icon="cloud-download" animation="fade" aria-hidden="true"></b-icon> 
                            Télecharger
                        </div>  
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Nav from '.././Nav/Nav.vue';
    import pdf from 'vue-pdf';
    import { mapGetters, mapActions } from 'vuex';
export default {
    components: { Nav, pdf },
    //props: ['id', 'url'],
    errorCaptured() {
        return false
    },
    data() {
        return {
            pageCount: 0,
            url: this.$route.query.url,
            id: this.$route.query.id,
            pdfID: this.$route.query.pdfID,
        }
    },
    methods: {
        ...mapActions({
            'DownloadCv': 'profile/CVDownload',
        }),
        DownloadCV(id){
            this.DownloadCv(id)
                .then((res) => {
                    console.log(res)
                    let blob = new Blob([res.data], { type: 'application/pdf' })
                    let link = document.createElement('a')
                    link.href = window.URL.createObjectURL(blob)
                    link.download = 'bitdyne.pdf'
                    link.click()
                    this.flashMessage.success({ message: 'CV télechargé avec succes', time: 5000 })
                })/**/
                .catch((e) => {//console.log(e.response.data)
                    this.flashMessage.error({ message: 'CV non téléchargé !', time: 5000 })
                })
        },
    },
    computed: {
        ...mapGetters({
            'is_admin': 'auth/getRole'
        }),
    },
	mounted() {
        var loadingTask = pdf.createLoadingTask(this.url);
		loadingTask.promise.then(pdf => {
			this.pageCount = pdf.numPages;
		});
        console.log(this.url);
	}
}
</script>
<style lang="">
    
</style>