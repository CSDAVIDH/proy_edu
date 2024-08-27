<script setup>
import { links } from './links';
import { ref } from 'vue'; import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)


import { getDashboard } from '@/api/dashboardApi';
import { useQuery, useMutation, useQueryClient } from '@tanstack/vue-query'
import Swal from "sweetalert2";
import { danger_alerta, show_alerta } from '@/components/AlertAdmin.vue';

// components
import Banner from '@/components/Banner.vue';
import Spiner from '@/components/Spiner.vue'

const grado = ref({});
const search = ref('');
const queryClient = useQueryClient();

const { isLoading, data: registros, isError, error } = useQuery({
    queryKey: ['dashboard'],
    queryFn: getDashboard,
    onError: (error) => {
        console.error("Error fetching grados:", error);
    },

});

const chartData = {
    labels: ['Enero', 'Febrero', 'Marzo'],
    datasets: [
        {
            label: 'Datos Inscritos',
            backgroundColor: '#014561',
            data: [40, 20, 12]
        }
    ]
}
</script>
<template>
    <template v-if="isLoading == true">
        <Spiner />
    </template>
    <template v-else>
        <div class="dashboard_main">
            <div class="row container-fluid justify-content-center gap-2">
                <div class="col-md-6 dashboard_estadistica">
                    <h1>Estadisticas</h1>
                    <div class="dashboard_cards">
                        <div class="dashboard_card bg_danger">
                            <button class="btn btn-danger">
                                <i class="fa-regular fa-user"></i>
                            </button>
                            <span>{{ 'Administrativos' }}</span>
                            <h1>{{ registros.administrativos }}</h1>
                        </div>
                        <div class="dashboard_card bg_primary">
                            <button class="btn btn-primary">
                                <i class="fa-regular fa-user"></i>
                            </button>
                            <span>{{ 'Docentes' }}</span>
                            <h1>{{ registros.docentes }}</h1>
                        </div>
                        <div class="dashboard_card bg_success">
                            <button class="btn btn-success">
                                <i class="fa-regular fa-user"></i>
                            </button>
                            <span>{{ 'Estudiantes' }}</span>
                            <h1>{{ registros.estudiantes }}</h1>
                        </div>
                        <div class="dashboard_card bg_warning">
                            <button class="btn btn-warning">
                                <i class="fa-regular fa-user"></i>
                            </button>
                            <span>{{ 'Padres' }}</span>
                            <h1>{{ registros.padres }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 dashboard_estadistica">
                    <!-- <h1>Estadisticas</h1> -->
                    <div class="porcentaje">
                        <h3>
                            <span>Presentes </span>
                            <span>0%</span>
                        </h3>
                        <div class="linea"></div>
                    </div>
                    <div class="porcentaje">
                        <h3>
                            <span>Ausentes </span>
                            <span>0%</span>
                        </h3>
                        <div class="linea"></div>
                    </div>
                    <div class="porcentaje">
                        <h3>
                            <span>Noticias </span>
                            <span>0%</span>
                        </h3>
                        <div class="linea"></div>
                    </div>
                    <div class="porcentaje">
                        <h3>
                            <span>Mensajes </span>
                            <span>0%</span>
                        </h3>
                        <div class="linea"></div>
                    </div>
                </div>
            </div>
            <div class="dashboard_chart">
                <Bar :data="chartData" />
            </div>
        </div>
    </template>
</template>
<style scoped>
.dashboard_main {
    width: 100%;
    height: calc(100vh - 100px);
}

.dashboard_estadistica {
    background-color: white;
    padding: 20px;
    margin-top: 20px;
    border-radius: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.dashboard_estadistica h1 {
    width: fit-content;
    text-align: center;
    font-size: 18px;
    font-weight: bold;
    text-transform: uppercase;
    background-image: linear-gradient(90deg, #014561, #03364c);
    background-repeat: no-repeat;
    background-size: 100% 3px;
    padding-bottom: 5px;
    background-position: center bottom;
    margin-bottom: 30px;
}

.dashboard_cards {
    width: 100%;
    display: flex;
    align-items: flex-start;
    gap: 10px;
    flex-wrap: wrap;
    justify-content: space-around;

}

.dashboard_card {
    width: 110px;
    height: 140px;
    border-radius: 10px;
    padding: 20px;
    color: white;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.dashboard_card i {
    font-size: 25px;
}

.dashboard_card span {
    font-size: 11px;
    text-transform: uppercase;
    font-weight: bold;
}

.dashboard_card h1 {
    font-size: 30px;
    text-transform: uppercase;
    font-weight: bold;
}

.bg_danger {
    background-color: rgb(247, 64, 64);
}

.bg_primary {
    background-color: rgb(64, 159, 247);
}

.bg_success {
    background-color: rgb(83, 224, 40);
}

.bg_warning {
    background-color: rgb(231, 194, 30);
}

.porcentaje {
    width: 100%;
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.porcentaje h3 {
    width: 100%;
    font-size: 14px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.linea {
    width: 100%;
    margin-top: 10px;
    height: 5px;
    border-radius: 5px;
    position: static;
    background-color: rgb(145, 145, 145);
}

.dashboard_chart{
    width: 100%;
    margin-top: 20px;
    background-color: white;
    padding: 50px;
    border-radius: 50px;
}
</style>