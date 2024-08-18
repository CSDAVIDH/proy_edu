import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useAdminLayoutStore = defineStore('admin_layout', () => {
    const sidebar = ref(false)

    const toogleSidebar = () => {
        sidebar.value = !sidebar.value;
    };

    return { sidebar, toogleSidebar };
})
