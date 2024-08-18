<script setup>
import { ref, watch } from 'vue';
import ModalMd from '@/components/ModalMd.vue'
import { useForm } from "@/hook/useForm.vue";
import Swal from "sweetalert2";
import { danger_alerta, show_alerta } from '@/components/AlertAdmin.vue';
import { getEstudiante, storeIncripcion, updateIncripcion } from '@/api/inscripciones/incripcionEstudianteApi';
import { useMutation, useQueryClient } from '@tanstack/vue-query';
import Spiner from '@/components/Spiner.vue';
import perfil from '@/assets/image/foto.jpg';
import Banner from '@/components/Banner.vue';

const props = defineProps({
    isModal: {
        type: Boolean,
        required: true,
    },
    item: {
        type: Object,
        required: true,
    },
});
const emit = defineEmits(['close']);

const closeModal = () => {
    emit('close');
}

const form = ref({
    grado_id: null,
    especialidad_id: null,
    paralelo_id: null,
    estudiante_id: null,
});

const estudiante = ref({});
const materias = ref([]);
const especialidades = ref([]);
const paralelos = ref([]);
const loading = ref(true);
const enviando = ref(false);
const queryClient = useQueryClient();
const tipos = ref(['MATERIA', 'FORMACIÓN', 'DESQUITE']);

const obsevaciones = ref(['INGRESO', 'INSCRITO', 'APROBADO', 'REPROBADO']);

watch(() => props.item, () => {
    loading.value = true;
    showEstudiante.mutate(props.item);
    const aux = {
        especialidad_id: props.item.especialidad_id,
        grado_id: props.item.grado_id,
        estudiante_id: props.item.id,
        paralelo_id: null,
    }
    form.value = { ...form.value, ...aux };
});

const registrar = () => {
    if (form.value.paralelo_id != null) {
        enviando.value = true;
        if (estudiante.value.observacion == 1) {
            actualizarInscripcion.mutate(form.value);
        } else {
            asignarInscripcion.mutate(form.value);
        }
    }
}


const showEstudiante = useMutation({
    mutationFn: getEstudiante,
    onSuccess: (response) => {
        console.log(response)
        loading.value = false;
        estudiante.value = { ...estudiante.value, ...response.estudiante }
        paralelos.value = response.paralelos;
        especialidades.value = response.especialidades;
        materias.value = response.materias;
        if (response.estudiante.observacion == 1) {
            form.value.paralelo_id = response.inscripcion.paralelo_id
        }
    },
    onError: (error) => {
        loading.value = false;
        danger_alerta("Fallo del Servidor");
        closeModal();
    },
});

const asignarInscripcion = useMutation({
    mutationFn: storeIncripcion,
    onSuccess: (response) => {
        if (response.status === true) {
            queryClient.invalidateQueries('inscripciones');
            show_alerta("Agregado Correctamente");
            enviando.value = false;
            closeModal();
        } else {
            enviando.value = false;
            danger_alerta("Fallo de Servidor");
        }
    },
    onError: (error) => {
        danger_alerta("Fallo del Servidor");
    },
});

const actualizarInscripcion = useMutation({
    mutationFn: updateIncripcion,
    onSuccess: (response) => {
        if (response.status === true) {
            queryClient.invalidateQueries('inscripciones');
            show_alerta("Actualizado Correctamente");
            enviando.value = false;
            closeModal();
        } else {
            enviando.value = false;
            danger_alerta("Fallo de Servidor");
        }
    },
    onError: (error) => {
        danger_alerta("Fallo del Servidor");
    },
});
</script>
<template>
    <ModalMd :isModal="isModal" @close="closeModal"
        :title="`Estudiante: ${item.nombre} ${item.paterno} ${item.materno}`">
        <template v-if="loading == true">
            <Spiner />
        </template>
        <template v-else>
            <div class="row">
                <div class="col-md-4">
                    <img :src="perfil" alt="image" width="200px" />
                </div>
                <div class="col-md-8">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Matricula</span>
                        <input type="text" :value="estudiante.matricula" class="form-control" disabled>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Nombres</span>
                        <input type="text" :value="estudiante.nombre" class="form-control" disabled>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Apellidos Paterno</span>
                        <input type="text" :value="estudiante.paterno" class="form-control" disabled>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Apellidos Materno</span>
                        <input type="text" :value="estudiante.materno" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Cedula de Identidad</span>
                        <input type="text" :value="`${estudiante.ci} ${estudiante.expedido}`" class="form-control"
                            disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Reincidencia</span>
                        <input type="text" :value="estudiante.reincidencia" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Grado Academico</span>
                        <input type="text" :value="estudiante.grado" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Obsevacion</span>
                        <input type="text" :value="obsevaciones[estudiante.observacion]" class="form-control" disabled>
                    </div>
                </div>
            </div>
            <template v-if="item.observacion == 0">
                <Banner :title="'Sin Materias Inscritas'" />
            </template>
            <template v-else>
                <div class="row">
                    <Banner :title="'Materias Inscritas'" />
                    <div class="col-12">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">MATERIA</th>
                                    <th scope="col">PARALELO</th>
                                    <th scope="col">GRADO</th>
                                    <th scope="col">ESPECIALIDAD</th>
                                    <th scope="col">TIPO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(row, index) in materias" :key="row.id">
                                    <th scope="row">{{ index + 1 }}</th>
                                    <td>{{ row.nombre }}</td>
                                    <td>{{ row.paralelo }}</td>
                                    <td>{{ row.grado }}</td>
                                    <td>{{ row.especialidad }}</td>
                                    <td>{{ tipos[row.tipo - 1] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </template>

            <form @submit.prevent="registrar" class="row">
                <div class="col-md-6" v-if="estudiante.grado_id == 2">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Orientacion</span>
                        <v-select :options="especialidades" :reduce="especialidad => especialidad.id" label="nombre"
                            class="form-control" v-model="form.especialidad_id" name="especialidad_id"
                            id="especialidad_id" placeholder="Elige una Especialidad" :required="true">
                            <template #option="option" :required="true">
                                <span>{{ option.nombre }}</span>
                            </template>
                            <template #search="{ attributes, events }">
                                <input class="vs__search" :required="!form.especialidad_id" v-bind="attributes"
                                    v-on="events" />
                            </template>
                        </v-select>
                    </div>
                </div>
                <div class="col-md-6" v-else>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Orientacion</span>
                        <input type="text" :value="estudiante.especialidad" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Paralelo</span>
                        <v-select :options="paralelos" :reduce="paralelo => paralelo.id" label="nombre"
                            class="form-control" v-model="form.paralelo_id" name="paralelo_id" id="paralelo_id"
                            placeholder="Elige un Paralelo" :required="true">
                            <template #option="option" :required="true">
                                <span>{{ option.nombre }}</span>
                            </template>
                            <template #search="{ attributes, events }">
                                <input class="vs__search" :required="!form.paralelo_id" v-bind="attributes"
                                    v-on="events" />
                            </template>
                        </v-select>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-between">
                    <button type="button" class="btn btn-danger"> Cancelar</button>
                    <button type="submit" class="btn btn-success" disabled :class="enviando ? 'd-block' : 'd-none'">
                        <i class="fa-solid fa-spinner fa-spin-pulse"></i>
                        <span class="mx-2">Cargando...</span>
                    </button>
                    <button type="submit" class="btn btn-primary" :class="enviando ? 'd-none' : 'd-block'">
                        Añadir
                    </button>
                </div>
            </form>



        </template>
    </ModalMd>
</template>