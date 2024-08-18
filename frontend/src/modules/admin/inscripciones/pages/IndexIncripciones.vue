<script setup>
import { ref } from 'vue';
import { getEstudiantes } from '@/api/inscripciones/incripcionEstudianteApi';
import { useModal } from '@/hook/useModal.vue';
import { useQuery, useMutation, useQueryClient } from '@tanstack/vue-query'
import Swal from "sweetalert2";
import { danger_alerta, show_alerta } from '@/components/AlertAdmin.vue';
import ShowEstudiante from '../components/Estudiantes/ShowEstudiante.vue'

//components
import Banner from '@/components/Banner.vue';
import Spiner from '@/components/Spiner.vue'

const estudiante = ref({});
const search = ref('');
const [modal, openModal, closeModal] = useModal(false);
const queryClient = useQueryClient();


const { isLoading, data: registros, isError, error } = useQuery({
    queryKey: ['inscripciones'], //unico
    queryFn: getEstudiantes,
});

const showModal = (item) => {
    openModal();
    estudiante.value = {...estudiante.value, ...item};
}

const filtered = () => {
    if (search.value.length == 0) return registros.value;
    const filter = registros.value.filter(item => {
        if (
            item.matricula.toLowerCase().normalize('NFD').includes(search.value.toLowerCase()) ||
            item.nombre.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").includes(search.value.toLowerCase()) ||
            item.paterno.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").includes(search.value.toLowerCase()) ||
            item.materno.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").includes(search.value.toLowerCase()) ||
            item.ci.toString().includes(search.value)
        ) {
            return item;
        }
    });
    return filter
}

const headers = [
    { text: "#", value: "id", },
    { text: "MATRICULA", value: "matricula", sortable: true },
    { text: "NOMBRE", value: "nombre", sortable: true },
    { text: "PATERNO", value: "paterno", sortable: true },
    { text: "MATERNO", value: "materno", sortable: true },
    { text: "CEDULA", value: "ci", sortable: true },
    { text: "REINCIDENCIA", value: "reincidencia", sortable: true },
    { text: "ACCIÓN", value: "accion" },
];
</script>
<template>
    <template v-if="isLoading == true">
        <Spiner />
    </template>
    <template v-else>
        <!-- modal show estudiante  -->
        <ShowEstudiante :isModal="modal" :item="estudiante" @close="closeModal" />
        <Banner :title="'Lista de Estudiantes'" />
        <div class="d-flex align-items-center justify-content-end py-4">
            <div class="row container">
                <div class="col-md-10">
                    <input class="form-control" type="search" v-model="search" placeholder="Buscar">
                </div>
            </div>
        </div>
        <EasyDataTable :headers="headers" :items="filtered()" buttons-pagination
            :rowsPerPageMessage="'filas por página'" :rowsOfPageSeparatorMessage="'de'"
            :emptyMessage="'No hay datos disponibles'">
            <template #item-ci="item">
                <span>{{ `${item.ci} ${item.expedido}` }}</span>
            </template>
            <template #item-accion="item">
                <div v-if="item.estado == 1" class="operation-wrapper d-flex align-items-center gap-1">
                    <button type="button" @click="showModal(item)" class="btn btn-primary" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Ver Datos">
                        <i class="fa-solid fa-arrow-pointer"></i>
                    </button>
                </div>
            </template>
        </EasyDataTable>
    </template>
</template>