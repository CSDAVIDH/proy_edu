<script setup>
import { computed } from "vue";
import { useAuthStore } from '@/stores/auth/auth';
import { useAdminLayoutStore } from "@/stores/layouts/app";
import logo_icon from "@/assets/image/logo_icon.png";

const layout = useAdminLayoutStore();
const authStore = useAuthStore();

const sidebar = computed(() => {
    return layout.sidebar;
})

const logout = () => {
    authStore.exit();
    // authStore.logout();
};
</script>
<template>
    <div class="sidebar_footer" :class="sidebar ? 'sidebar' : ''">
        <div class="footer_link">
            <img :src="logo_icon" alt="aleph" />
        </div>
        <router-link :to="{ name: 'admin.index' }" class="footer_link">
            <i class="fa-solid fa-gear"></i>
        </router-link>
        <router-link :to="{ name: 'admin.index' }" class="footer_link">
            <i class="fa-regular fa-user"></i>
        </router-link>
        <button type="button" @click="logout" class="footer_link">
            <i class="fa-solid fa-power-off"></i>
        </button>
    </div>
</template>
<style scoped>
.sidebar_footer {
    width: 70px;
    height: 40px;
    position: absolute;
    bottom: 0;
    display: flex;
    transform: translateY(40px);
    opacity: 0;
    align-items: center;
    justify-content: space-around;
    overflow-x: hidden;
    background-color: #172d44;
    transition: all 0.5s ease-in-out;
}

.sidebar_footer.sidebar {
    position: fixed;
    width: 230px;
    opacity: 1;
    transform: translateY(0);
}

.footer_link {
    width: 100%;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    border: none;
    color: #73879d;
    background-color: transparent;
    overflow-x: hidden;
}

.footer_link:hover {
    background-color: #425567;
}

.footer_link img {
    height: 30px;
}

@media (max-width: 999px) {
    .sidebar_footer.sidebar {
        width: 70px;
        opacity: 0;
        transform: translateY(40px);
    }
}
</style>
