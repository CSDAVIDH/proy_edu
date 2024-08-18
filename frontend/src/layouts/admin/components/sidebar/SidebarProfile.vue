<script setup>
import { computed } from "vue";
import perfil from "@/assets/image/perfil.jpg";
import { useAdminLayoutStore } from "@/stores/layouts/app";
import { useAuthStore } from "@/stores/auth/auth";

const authStore = useAuthStore();
const layout = useAdminLayoutStore();

const sidebar = computed(() => {
    return layout.sidebar;
})


</script>
<template>
    <div class="sidebar_profile" :class="sidebar ? 'sidebar' : ''">
        <template v-if="perfil">
            <div class="profile_image">
                <img :src="perfil" alt="perfil" />
            </div>
        </template>
        <template v-else>
            <div class="profile_image">
                <img :src="perfil" alt="perfil" />
            </div>
        </template>

        <div class="profile_name">
            <h3>Bienvenida(o),</h3>
            <h5>{{ authStore.user.name }}</h5>
        </div>
    </div>
</template>
<style scoped>
.sidebar_profile {
    width: 100%;
    height: 80px;
    overflow-x: hidden;
    display: none;
    align-items: center;
    justify-content: center;
}

.sidebar_profile.sidebar {
    display: flex;
}

.profile_image {
    width: 55px;
    height: 55px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f7f6f6;
    border-radius: 50%;
}

.profile_image img {
    width: 45px;
    height: 45px;
    border-radius: 50%;
}

.profile_name {
    width: 120px;
    margin-left: 20px;
    line-height: 8px;
}

.profile_name h3 {
    width: 120px;
    text-wrap: wrap;
    text-align: justify;
    color: #bbc9c4;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 12px;
    padding-bottom: 8px;
    margin: 0;
}

.profile_name h5 {
    width: 120px;
    text-wrap: wrap;
    color: #f0eedd;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 12px;
    line-height: 12px;
    margin: 0;
}

@media (max-width: 999px) {
    .sidebar_profile.sidebar {
        display: none;
    }
}</style>
