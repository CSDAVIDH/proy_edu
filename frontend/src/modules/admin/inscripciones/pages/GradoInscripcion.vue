<script setup>
import { ref, onMounted, watch } from 'vue';
import { getInscritos, getDatos, getEstudiantes } from '@/api/inscripciones/inscripcionGradosApi';
import ListaEstudiantes from '../components/grados/ListaEstudiantes.vue';
import { useQuery, useMutation, useQueryClient } from '@tanstack/vue-query'
import { useModal } from '@/hook/useModal.vue';
import Swal from "sweetalert2";
import { danger_alerta, show_alerta } from '@/components/AlertAdmin.vue';

//components
import Banner from '@/components/Banner.vue';
import Spiner from '@/components/Spiner.vue'

const props = defineProps({
    id: {
        type: Number,
        required: true,
    },
});

onMounted(() => {
    getDatosAll.mutate(datos.value);
});

const datos = ref({
    grado_id: props.id,
    especialidad_id: 1,
    paralelo_id: 1,
    fecha: '2024-01-05',
    periodo: 1,
});

const paralelos = ref([]);
const especialidades = ref([]);
const estudiantes = ref([]);
const grado = ref({});
const inscritos = ref({});
const queryClient = useQueryClient();
const isLoading = ref(true);
const enviando = ref(false);
const consultando = ref(false);
const [modal, openModal, closeModal] = useModal(false);

const getDatosAll = useMutation({
    mutationFn: getDatos,
    onSuccess: (response) => {
        paralelos.value = response.paralelos;
        grado.value = { ...grado.value, ...response.grado };
        especialidades.value = response.especialidades;
        isLoading.value = false;
        datos.value.fecha = response.fecha;
        datos.value.paralelo_id = paralelos.value[0].id;
        datos.value.especialidad_id = especialidades.value[0].id;
    },
    onError: (error) => {
        danger_alerta("Fallo del Servidor");
        isLoading.value = false;
    },
});


const getInscritosAll = useMutation({
    mutationFn: getInscritos,
    onSuccess: (response) => {
        paralelos.value = response.paralelos;
        inscritos.value = response.inscritos;
        consultando.value = false;
        console.log(response)
    },
    onError: (error) => {
        danger_alerta("Fallo del Servidor");
        isLoading.value = false;
    },
});

const consultar = () => {
    const periodo = new Date(datos.value.fecha).getMonth();
    if (periodo <= 5) {
        datos.value.periodo = 1;
    } else {
        datos.value.periodo = 2;
    }
    consultando.value = true;
    getInscritosAll.mutate(datos.value);
}

const agregar = () => {
    openModal();
    const periodo = new Date(datos.value.fecha).getMonth();
    if (periodo <= 5) {
        datos.value.periodo = 1;
    } else {
        datos.value.periodo = 2;
    }
    getEstudiantesAll.mutate(datos.value);
}

const getEstudiantesAll = useMutation({
    mutationFn: getEstudiantes,
    onSuccess: (response) => {
        estudiantes.value = response;
    },
    onError: (error) => {
        closeModal();
        danger_alerta("Fallo del Servidor");
    },
});


const headers = [
    { text: "#", value: "id" },
    // { text: "ACCIÓN", value: "accion" },
    { text: "ESTUDIANTES", value: "nombres", sortable: true },
    { text: "CÉDULA", value: "ci", sortable: true },
    { text: "GÉNERO", value: "genero", sortable: true },
    { text: "MATRÍCULA", value: "matricula", sortable: true },
];

</script>
<template>
    <template v-if="isLoading == true">
        <Spiner />
    </template>
    <template v-else>
        <Banner :title="`GRADO ${grado.descripcion}`" />
        <ListaEstudiantes :isModal="modal" @close="closeModal" :registro="datos" :items="estudiantes"
            @reload="consultar" />
        <div class="container-fluid">

            <div class="row">
                <!-- <div class="col-12 d-flex justify-content-between py-2">
                    <button type="button" class="btn btn-danger"> Volver</button>
                    <button type="submit" class="btn btn-success" disabled :class="enviando ? 'd-block' : 'd-none'">
                        <i class="fa-solid fa-spinner fa-spin-pulse"></i>
                        <span class="mx-2">Cargando...</span>
                    </button>
                    <button type="submit" class="btn btn-primary" :class="enviando ? 'd-none' : 'd-block'">
                        Añadir
                    </button>
                </div> -->
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Fecha</span>
                        <input type="date" v-model="datos.fecha" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Orientacion</span>
                        <v-select :options="especialidades" :reduce="especialidad => especialidad.id" label="nombre"
                            class="form-control" v-model="datos.especialidad_id" name="especialidad_id"
                            id="especialidad_id" placeholder="Elige una Especialidad" :required="true">
                            <template #option="option" :required="true">
                                <span>{{ option.nombre }}</span>
                            </template>
                            <template #search="{ attributes, events }">
                                <input class="vs__search" :required="!datos.especialidad_id" v-bind="attributes"
                                    v-on="events" />
                            </template>
                        </v-select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Paralelo</span>
                        <v-select :options="paralelos" :reduce="paralelo => paralelo.id" label="nombre"
                            class="form-control" v-model="datos.paralelo_id" name="paralelo_id" id="paralelo_id"
                            placeholder="Elige un Paralelo" :required="true">
                            <template #option="option" :required="true">
                                <span>{{ option.nombre }}</span>
                            </template>
                            <template #search="{ attributes, events }">
                                <input class="vs__search" :required="!datos.paralelo_id" v-bind="attributes"
                                    v-on="events" />
                            </template>
                        </v-select>
                    </div>
                </div>

                <div class="col-md-6">
                    <button class="btn btn-success" disabled :class="consultando ? 'd-block' : 'd-none'">
                        <i class="fa-solid fa-spinner fa-spin-pulse"></i>
                        <span class="mx-2">Cargando...</span>
                    </button>
                    <button @click="consultar" type="button" class="btn btn-danger"
                        :class="consultando ? 'd-none' : 'd-block'">
                        <i class="fa-brands fa-searchengin"></i>
                        <span>Verificar</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="container-fluid my-2">
            <div class="d-flex justify-content-end">
                <button @click="agregar" type="button" class="btn btn-primary">
                    <i class="fa-regular fa-address-book"></i>
                    <span class="mx-1">Agregar Estudiantes</span>
                </button>
            </div>
        </div>

        <template v-if="inscritos.length > 0">
            <EasyDataTable :headers="headers" :items="inscritos" buttons-pagination
                :rowsPerPageMessage="'filas por página'" :rowsOfPageSeparatorMessage="'de'"
                :emptyMessage="'No hay datos disponibles'">
                <template #item-nombres="item">
                    <span>{{
                        item.nombre +
                        " " +
                        item.paterno +
                        " " +
                        item.materno
                    }}</span>
                </template>
                <!-- <template #item-accion="item">
                    <div v-if="item.estado == 1" class="operation-wrapper d-flex align-items-center gap-1">
                        <button @click="editar(item)" class="btn btn-primary">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button @click="eliminar(item)" class="btn btn-danger">
                            <i class="fa-solid fa-x"></i>
                        </button>
                    </div>
                </template> -->
            </EasyDataTable>
        </template>
        <template v-else>
            <div class="container-fluid">
                <div class="alert alert-danger" role="alert">
                    Sin Estudiantes
                </div>
            </div>
        </template>
    </template>
</template>