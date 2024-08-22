<script setup>
</script>
<template>
    <div class="notas">
        <div class="notas_main">
            <h1>Notas</h1>
            <ul class="notas_opciones">
                <li>Bimestre 1</li>
                <li>Bimestre 2</li>
                <li>Bimestre 3</li>
                <li>Bimestre 4</li>
            </ul>
            <ul class="notas_materias">
                <li>Ciencias</li>
                <li>Razonamiento Matematico</li>
                <li>Razonamiento Verbal</li>
                <li>Ingles</li>
                <li>Desarrollo Personal</li>
                <li>Matematica</li>
            </ul>
        </div>
    </div>

</template>
<style scoped>
.notas {
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

.notas_main {
    width: 80%;
    height: 100vh;
    background-color: #ffffffd2;
}
.notas_main h1{
    width: fit-content;
    padding: 10px 50px;
    background-color: blue;
    border-radius: 10px;
    color: #fff;
    font-size: 25px;
}
.notas_opciones{
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    background-color: rgb(214, 214, 214);
    border-radius: 20px;
}
.notas_opciones li{
    list-style: none;
    padding: 10px;
    transition: all 0.5s ease-in-out;
}
.notas_opciones li:hover{
    background-color: blue;
    color: #fff;
}
.notas_materias{
    padding: 50px 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    background-color: rgb(214, 214, 214);    
    border-radius: 50px;
}
.notas_materias li{
    width: 90%;
    list-style: none;
    background-color: rgb(143, 142, 142);
    color: #fff;
    text-align: center;
    border-radius: 20px;
    padding: 10px;
}
</style>