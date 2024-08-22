<script setup>
import { ref } from 'vue';
import { links } from './links';
</script>
<template>
    <div class="dashboard_main">
        <div class="cards_main">
            <template v-for="link in links" :key="link.id">
                <router-link :to="{ name: link.route }" class="card_body">
                    <img :src="link.image" alt="image">
                    <h3>{{ link.nombre }}</h3>
                </router-link>
            </template>
        </div>

    </div>
</template>
<style scoped>
.dashboard_main {
    width: 100%;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-image: url('../../../assets/image/fondo_escolar.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
    background-position: center;
}
.cards_main{
    width: 80%;
    height: 100vh;
    padding: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    gap: 15px;
    background-color: rgba(211, 208, 208, 0.747);
}
.card_body{
    width: 200px;
    display: flex;
    flex-direction: column;
    align-items: center;
    transition: all 0.5s ease-in-out;
    color: rgb(8, 59, 94);
    font-weight: bold;
    border-radius: 20px;
    text-decoration: none;
}
.card_body img{
    width: 150px;
}

.card_body:hover{
    background-color: rgba(3, 72, 104, 0.712);
    color: rgb(252, 252, 252);
}
</style>