import { defineStore } from "pinia";
import { show_alerta } from "../../utils/functions";
import axios from 'axios';

export const useAuthStore = defineStore('auth', {
    state: () => ({ authUser: null, authToken: null }),
    getters: {
        user: (state) => state.authUser,
        token: (state) => state.authToken
    },
    actions: {
        async getToken() {
            await axios.get('/sanctum/csrf-cookie');
        },
        async login(form) {
            await this.getToken();
            await axios.post('/api/auth/login', form).then(
                (res) => {
                    this.authToken = res.data.token;
                    this.authUser = res.data.data;
                    this.router.push('/admin');
                }
            ).catch(
                (errors) => {
                    let desc = '';
                    errors.response.data.errors.map(
                        (e) => { desc = desc + ' ' + e }
                    )
                    show_alerta(desc, 'error', '');
                })
        },
        async logout() {
            await this.exit();
            // await axios.get('/api/auth/logout', this.authToken);
            // this.router.push('/login');
        },       
        exit(){
            const aux = {name:'', email:'', password:''}
            this.authUser = {...this.authUser, ...aux };
            this.authToken = null;
            this.router.push('/auth/login');   
        } 
    },

    persist: true
});