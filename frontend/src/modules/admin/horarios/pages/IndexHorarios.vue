<script setup>
</script>
<template>
    <div class="horarios">
        <div class="horarios_main">
            <h1>Horarios</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Hora</th>
                        <th scope="col">Lunes</th>
                        <th scope="col">Martes</th>
                        <th scope="col">Miercoles</th>
                        <th scope="col">Jueves</th>
                        <th scope="col">Viernes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">7:35 - 7:50</th>
                        <td></td>
                        <td></td>
                        <td class="table-light">Conserjeria</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th scope="row">7:50 - 9:10</th>
                        <td class="table-primary">Comunicación</td>
                        <td class="table-danger">Personal Social</td>
                        <td></td>
                        <td></td>
                        <td class="table-primary">Comunicación</td>
                    </tr>
                    <tr>
                        <th scope="row">9:10 - 9:30</th>
                        <td></td>
                        <td></td>
                        <td class="table-light">Conserjeria</td>
                        <td></td>
                        <td></td>
                    </tr> 
                    <tr>
                        <th scope="row">9:30 - 9:50</th>
                        <td></td>
                        <td></td>
                        <td class="table-danger">Personal Social</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr class="table-success">
                        <th scope="row">11:10 - 11:40</th>
                        <td></td>
                        <td></td>
                        <td>Recreo</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th scope="row">11:40 - 13:00</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="table-primary">Comunicación</td>
                    </tr>
                    <tr>
                        <th scope="row">13:00 - 14:20</th>
                        <td></td>
                        <td class="table-primary">Comunicacion</td>
                        <td class="table-warning">Raz Verbal</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<style scoped>
.horarios {
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

.horarios_main {
    width: 80%;
    height: 100vh;
    background-color: #ffffffd2;
}

.horarios_main h1 {
    width: fit-content;
    padding: 10px 50px;
    background-color: blue;
    border-radius: 10px;
    color: #fff;
    font-size: 25px;
}
</style>