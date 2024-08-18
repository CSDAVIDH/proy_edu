<script setup>
import logo from '@/assets/image/logo.png'

</script>
<template>
    <div class="main_auth">
        <div class="body_auth">
            <div class="body_auth_image">
                <img :src="logo" alt="image">
            </div>
            <div class="body_admin">
                <router-view />
            </div>
        </div>
    </div>
</template>
<style scoped>
.main_auth {
    width: 100%;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-image:linear-gradient(120deg, rgba(0, 0, 0, 0.575) 0%, rgba(0, 0, 0, 0.397) 100%), url('../assets/image/backgroud_auth.png');
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.body_auth {
    padding: 20px;
    border-radius: 10px;
}
.body_auth_image{
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 50px;
}

.body_auth_image img{
    width: 100px;
}

</style>