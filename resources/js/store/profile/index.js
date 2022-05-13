import axios from 'axios';

export default {
    namespaced: true,
    state: {
        
    },
    mutations: {
        
    },
    getters: {
        
    },
    actions: {
        async searchProfile(_, payload){
            try {
                var credentials = payload.keyword;
                var sort_direction = payload.sort_direction;
                var sort_field = payload.sort_field;
                const result = await axios.get('api/liveSearchProfiles?keyword='+ credentials +'&sort_direction=' +sort_direction+ '&sort_field=' + sort_field);//const result = await axios.get('api/liveSearchProfiles', { params: { keyword: credentials } });
                return result;
            } catch (error) {
                console.log(error.response.data);
            }
        },
        async uploadProfilesExcel(_, credentials) {
            try {
                let formData = new FormData();
                formData.append('uploaded_file', credentials);
                return await axios.post('api/upload-profiles', formData);
            } catch (error) {
                console.log(error.response.data);
            }
        },
        async paginateProfiles(_, payload) {
            try {
                var credentials = payload.page;
                var sort_direction = payload.sort_direction;
                var sort_field = payload.sort_field;
                if (typeof credentials === 'undefined') {
                    credentials = 1;
                }
                const result = await axios.get('api/profiles-index?page=' + credentials + '&sort_direction=' +sort_direction+ '&sort_field=' + sort_field);
                return result;
            } catch (error) {
                console.log('check error: ', error.response.data)
            }
        },
        async uploadAllCV(_, credentials){
            try {
                let form = new FormData();
                for(let i=0; i<credentials.length;i++){
                    form.append('pics[]',credentials[i]);
                }
                console.log(form);
                const config = { headers: { 'Content-Type': 'multipart/form-data' } };
                document.getElementById('upload-file').value=[];
                return await axios.post('api/store-all-cv', form, config);
            } catch (error) {
                console.log('check error: ', error.response.data);
                return error.response.data;
            }
        },
        async getProfile(_, credentials){
            try {
                const test = await axios.get('api/show-profile/'+credentials)
                console.log(test.data)
                return test.data 
            } catch (e) {
                console.log('check error: ', e.response.data)
            } 
        },
        async deleteProfile(_, credentials) {
            try {
                return await axios.delete('/api/delete-profile/'+ credentials);
            } catch (error) {
                console.log('check error: ', error.response.data)
            }
        },
        async CVDownload(_, credentials){
            console.log(credentials);
            try {
                return await axios({ url: 'api/downloadPdf/'+credentials , method: 'GET', responseType: 'blob' });
            } catch (error) {
                console.log('check error: ', error.response.data);
                return error;
            }
        }
    }
}