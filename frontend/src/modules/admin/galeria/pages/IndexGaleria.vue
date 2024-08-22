<script setup>
import galeria1 from '@/assets/image/galeria1.png';
</script>
<template>
    <div class="galeria">
        <div class="galeria_main">
            <h1>galeria</h1>            
            <div class="galeria_materias">
                <img :src="galeria1" alt="image" />
            </div>
        </div>
    </div>

</template>
<style scoped>
.galeria {
    width: 100%;
    height: 100vh;
    display: flex;
    align-items: flex-start;
    justify-content: center;
    background-image: url('../../../../assets/image/fondo_escolar.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
    background-position: center;
}

.galeria_main {
    display: flex;
    flex-direction: column;
    width: 80%;
    height: 100vh;
    background-color: #ffffffd2;
}
.galeria_main h1{
    width: fit-content;
    padding: 10px 50px;
    background-color: blue;
    border-radius: 10px;
    color: #fff;
    font-size: 25px;
}
.galeria_materias{
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
.galeria_materias img{
    width: 80%;
}

</style>