<script setup>
import { ref, watch } from 'vue';
import ModalMd from '@/components/ModalMd.vue';
import { storeEstudiantes } from '@/api/inscripciones/inscripcionGradosApi';
import { useQuery, useMutation, useQueryClient } from '@tanstack/vue-query'

const props = defineProps({
    isModal: {
        type: Boolean,
        required: true,
    },
    registro: {
        type: Object,
        required: true,
    },
    items: {
        type: Array,
        required: true,
    },
});
const emit = defineEmits(['close', 'reload']);
const estudiantes = ref(props.items);
const observaciones = ref(['INGRESO', 'INSCRITO', 'APROBADO', 'REPROBADO']);
const itemsSelected = ref([]);
const alert = ref(false)
const enviando = ref(false);

const closeModal = () => {
    emit('close');
}

watch(() => props.items, () => {
    estudiantes.value = props.items;
});

const registrar = () => {
    const body = {
        grado_id: props.registro.grado_id,
        especialidad_id: props.registro.especialidad_id,
        paralelo_id: props.registro.paralelo_id,
        fecha: props.registro.fecha,
        periodo: props.registro.periodo,
        estudiantes: itemsSelected.value,
    }
    if (itemsSelected.value.length > 0) {
        crearEstudiantes.mutate(body)
    } else {
        alert.value = true;
        setTimeout(() => {
            alert.value = false;
        }, 1000)
    }
}

const crearEstudiantes = useMutation({
    mutationFn: storeEstudiantes,
    onSuccess: (response) => {
        console.log(response);
        emit('reload');
        closeModal();
    },
    onError: (error) => {
        closeModal();
        danger_alerta("Fallo del Servidor");
    },
});

const headers = [
    { text: "#", value: "id" },
    { text: "ESTUDIANTES", value: "nombres", sortable: true },
    { text: "CÉDULA", value: "ci", sortable: true },
    { text: "MATRÍCULA", value: "matricula", sortable: true },
    { text: "GÉNERO", value: "genero", sortable: true },
    { text: "OBSERVACIÓN", value: "observacion", sortable: true },
    // { text: "ACCIÓN", value: "accion" },
];

</script>
<template>
    <ModalMd :isModal="isModal" @close="closeModal" :title="`Lista de Estudiantes`">
        <div class="container-fluid my-2">
            <div class="d-flex justify-content-end">
                <button class="btn btn-success" disabled :class="enviando ? 'd-block' : 'd-none'">
                    <i class="fa-solid fa-spinner fa-spin-pulse"></i>
                    <span class="mx-2">Cargando...</span>
                </button>
                <button @click="registrar" type="button" class="btn btn-primary"
                    :class="enviando ? 'd-none' : 'd-block'">
                    <span>Agregar</span>
                </button>
            </div>
        </div>
        <div v-show="alert" class="alert alert-warning" role="alert">
            No selecionado ningun estudiante
        </div>
        <template v-if="estudiantes.length > 0">
            <EasyDataTable :headers="headers" :items="estudiantes" buttons-pagination
                :rowsPerPageMessage="'filas por página'" :rowsOfPageSeparatorMessage="'de'"
                :emptyMessage="'No hay datos disponibles'" v-model:items-selected="itemsSelected">

                <template #item-nombres="item">
                    <span>{{
                        item.nombre +
                        " " +
                        item.paterno +
                        " " +
                        item.materno
                    }}</span>
                </template>
                <template #item-ci="item">
                    <span>{{ item.ci }} - {{ item.expedido }} </span>
                </template>
                <template #item-observacion="item">
                    <span>{{ observaciones[item.observacion] }} </span>
                </template>

            </EasyDataTable>
        </template>
        <template v-else>
            <span>Sin estudiantes</span>
        </template>

    </ModalMd>

</template>