import { createApp, markRaw } from 'vue';
import { createPinia } from 'pinia';
import createPersistedstate from 'pinia-plugin-persistedstate';
import { createVfm } from 'vue-final-modal'
import Vue3EasyDataTable from 'vue3-easy-data-table';
import { VueQueryPlugin } from '@tanstack/vue-query';
import vSelect from "vue-select";
import App from './App.vue';
import router from './router';
import axios from 'axios';

import "vue-select/dist/vue-select.css";
import './assets/css/main.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import '@fortawesome/fontawesome-free/css/all.min.css';
import 'bootstrap/dist/js/bootstrap.bundle';
import 'vue-final-modal/style.css';
import 'vue3-easy-data-table/dist/style.css';
import 'animate.css';
import './assets/css/buttons.css';

window.axios = axios;
const url = import.meta.env.VITE_BACKEND_URL;


window.axios.defaults.baseURL = url;
window.axios.defaults.headers.common['Accept'] = 'aplication/json';
// window.axios.defaults.headers.common['Content-Type'] = 'aplication/json';
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.withCredentials = true;

const app = createApp(App)

const pinia = createPinia();
pinia.use(({store}) => {
    store.router = markRaw(router)
})
pinia.use(createPersistedstate);
const vfm = createVfm()

app.use(pinia);
app.use(router);
app.use(vfm);
app.use(VueQueryPlugin);
app.component('EasyDataTable', Vue3EasyDataTable);
app.component("v-select", vSelect);

app.mount('#app')
