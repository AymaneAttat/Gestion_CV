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
        async getAllSkills(){
            try {
                const test = await axios.get('api/skills-index')
                return test.data.data
                //console.log(test.data)
            } catch (error) {
                console.log(error);
            }
            
        },
        async searchSkill(_, credentials) {
            try {
                const result = await axios.get('api/livesearch', { params: { keyword: credentials } })
                return result
            } catch (error) {
                console.log(error);
            }
            
        },
        async storeSkill(_, credentials) {
            try {
                return await axios.post('api/upload-skill', credentials);
            } catch (e) {
                return e;
            }
        },
        async storeSkills(_, credentials) {
            try {
                return await axios.post('api/upload-content', credentials);
            } catch (err) {
                console.log(err)
                //this.flashMessage.error({ message: error.message, time: 5000 })
                return err;
            }
        },
        async findProfilesBySkills(_, credentials) {
            try {
                const result = await axios.get('api/searchProfiles', {params:{select_members: credentials}})
                console.log(result)
                return result
            } catch (error) {
                console.log(error)
            }
        },
        async sendEmailsToProfiles(_, credentials) {
            try {
                return await axios.post('api/sendEmails', credentials);
            } catch (error) {
                console.log(error.response.data);
            }
        }
    }
}