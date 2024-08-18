<script setup>
import { ref, onMounted } from 'vue';
import { useAuthStore } from '@/stores/auth/auth';

import perfil from "@/assets/image/perfil.jpg";

const open = ref(false);
const profile_main = ref(null);
const authStore = useAuthStore();

const toogleOpen = () => {
    open.value = !open.value;
}

onMounted(() => {
    profile_main.value = document.querySelector('#profile_main');
});

window.addEventListener("click", function (e) {
    if (!profile_main.value.contains(e.target)) {
        open.value = false;
    }
});

const url = import.meta.env.VITE_BACKEND_URL;

const logout = () => {
    authStore.exit();
};

</script>
<template>
    <div class="profile_main" id="profile_main">
        <button class="button_profile" @click="toogleOpen">
            <template v-if="authStore.user.profile_photo_url">
                <img :src="url + '/storage/' + authStore.user.profile_photo_url" alt="perfil">
            </template>
            <template v-else>
                <img :src="perfil" alt="perfil">
            </template>
            <span>{{ authStore.user.name }}</span>
            <i class="fa-solid fa-caret-down"></i>
        </button>
        <div class="profile_links" :class="open ? 'active' : ''">
            <!-- <Link :href="route('index')" class="profile_link">
                <span>Página Web</span>
            </Link>
            <Link :href="route('profile.show')" class="profile_link">
                <span>Perfil</span>
            </Link> -->
            <button type="button" @click="logout" class="profile_link">
                <span>Cerrar Sesión</span>
                <i class="fa-solid fa-right-from-bracket"></i>
            </button>
        </div>
    </div>
</template>
<style scoped>
.button_profile{
    width: 150px;
    display: flex;
    align-items: center;
    border: none;
    gap: 2px;
}
.button_profile img{
    height: 40px;
    border-radius: 50%;
}
.button_profile span{
    font-size: 12px;
    line-height: 15px;
    color: #3d3c3c;
}
.button_profile i{
    font-size: 10px;
}

.profile_links{
    width: 220px;
    display: none;
    flex-direction: column;
    position: absolute;
    top: 60px;
    right: 10px;
    background-color: #fff;
    border: 1px solid #c1c8cf;
    border-radius: 2px;
}
.profile_links.active{
    display: flex;
}
.profile_link{
    display: flex;
    border: none;
    text-decoration: none;
    align-items: center;
    justify-content: space-between;
    padding: 7px 15px;
    font-size: 12px;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    color: #000000cb;
    background-color: #fff;
    transition: all 0.3s ease-in-out;
}

.profile_link:hover{    
    background-color: #ebedf5;
}
</style>