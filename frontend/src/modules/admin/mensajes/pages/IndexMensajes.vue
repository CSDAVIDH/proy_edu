<script setup>
</script>
<template>
    <div class="mensajes">
        <div class="main_mensajes">
            <div class="main_opciones">
                <h1>COMUNICADOS</h1>
                <ul>
                    <li>Reunion de padres</li>
                    <li>Entrega de Notas</li>
                    <li>Pagar cuata de paseo</li>
                    <li>Clase de financiamiento</li>
                    <li>Jornada educativa</li>
                </ul>
                <h1>ANUNCIOS</h1>
                <ul>
                    <li>Dia de la Juventud</li>
                    <li>Chocolatada Navideña</li>
                    <li>Rosca de Integración</li>
                    <li>Cancion criolla</li>
                    <li>Medalla Milagrosa</li>
                </ul>
            </div>
            <div class="mensajes_body">
                <h2>Para visualizar, seleccione boletin deseado.</h2>
            </div>
        </div>
    </div>
</template>
<style scoped>
.mensajes {
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

.main_mensajes {
    width: 80%;
    height: 100vh;
    display: flex;
    align-items: flex-start;
    background-image: url('../../../../assets/image/fondo_escolar.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
    background-position: center;
}

.main_opciones {
    width: 200px;
    background-color: rgb(133, 183, 187);
}

.main_opciones {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.main_opciones h1 {
    width: 110%;
    padding: 10px;
    font-size: 25px;
    font-weight: bold;
    background-color: rgb(17, 134, 189);
    color: #fff;
    text-align: center;
}

.main_opciones li {
    list-style: none;
    color: #fff;
    padding: 5px;
}
.mensajes_body{
    width: 100%;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(255, 255, 255, 0.863);
}
.mensajes_body h2{
    text-align: center;
    color: rgb(97, 91, 91);
}
</style>