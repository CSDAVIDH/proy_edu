<script setup>
</script>
<template>
    <div class="tareas">
        <div class="tareas_main">
            <h1>tareas</h1>
            <div class="tareas_recuadro">
                <span>Selecciona método de visualización</span>
                <button>Gestor de Archivos</button>
            </div>
            <h2>Lista de Tareas</h2>
        </div>
    </div>
</template>
<style scoped>
.tareas {
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

.tareas_main {
    width: 80%;
    height: 100vh;
    background-color: #ffffffd2;
}
.tareas_main h1{
    width: fit-content;
    padding: 10px 50px;
    background-color: blue;
    border-radius: 10px;
    color: #fff;
    font-size: 25px;
}
.tareas_recuadro{
    width: 100%;
    height: 300px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.tareas_recuadro span{
    font-size: 25px;
    color: rgb(90, 87, 87);
    margin-bottom: 20px;
}
.tareas_recuadro button{
    color: blue;
    font-weight: bold;
    padding: 5px 10px;
    background-color: #fff;
    border-color: blue;
    border-width: 1px;
    border-style: solid;
}
.tareas_main h2{
    color: rgb(78, 77, 77);
    font-size: 30px;
    padding: 20px;
}
</style>