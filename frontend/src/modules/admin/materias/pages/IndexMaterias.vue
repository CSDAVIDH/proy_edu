<script setup>
import { ref } from 'vue';
import CreateMateria from '../components/materias/CreateMateria.vue';
import EditMateria from '../components/materias/EditMateria.vue';
import { useModal } from '@/hook/useModal.vue';
import { getMaterias, deleteMateria, getGradosEspecialidades } from '@/api/materias/materiasApi';
import { useQuery, useMutation, useQueryClient } from '@tanstack/vue-query'
import Swal from "sweetalert2";
import { danger_alerta, show_alerta } from '@/components/AlertAdmin.vue';

//components
import Banner from '@/components/Banner.vue';
import Spiner from '@/components/Spiner.vue'

const materia = ref({});
const especialidades = ref([]);
const grados = ref([]);
const search = ref('');
const [create, openCreate, closeCreate] = useModal(false);
const [edit, openEdit, closeEdit] = useModal(false);
const [pdf, openPdf, closePdf] = useModal(false);
const queryClient = useQueryClient();

const { isLoading, data: registros, isError, error } = useQuery({
    queryKey: ['materias'], //unico
    queryFn: getMaterias,
    select: materias => materias.sort((a, b) => b.id - a.id),
});

const crear = () => {
    openCreate();
    gradosEspecialidades.mutate();
}

const editar = (item) => {
    openEdit();
    materia.value = { ...materia.value, ...item };
    gradosEspecialidades.mutate();
}

const gradosEspecialidades = useMutation({
    mutationFn: getGradosEspecialidades,
    onSuccess: (response) => {
        especialidades.value = response.especialidades;
        grados.value = response.grados;
    },
    onError: (error) => {
        danger_alerta("Fallo del Servidor");
        closeCreate();
        closeEdit();
    },
});

const eliminar = (item) => {
    Swal.fire({
        title: "Esta seguro?",
        text: "Una vez realizado, no podrá revertir la acción!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar!",
    }).then((result) => {
        if (result.isConfirmed) {
            eliminarMateria.mutate(item.id);
        }
    });
}

const eliminarMateria = useMutation({
    mutationFn: deleteMateria,
    onSuccess: (response) => {
        queryClient.invalidateQueries('materias');
        show_alerta("Eliminado Correctamente");
    },
    onError: (error) => {
        danger_alerta("Fallo del Servidor");
    },
});

const show_pdf = (item) => {
    materia.value = { ...materia.value, ...item };
    openPdf();
}

const filtered = () => {
    if (search.value.length == 0) return registros.value;
    const filter = registros.value.filter(item => {
        if (
            item.nombre.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").includes(search.value.toLowerCase()) ||
            item.sigla.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").includes(search.value.toLowerCase()) ||
            item.horas_cademicas.toString().includes(search.value)
        ) {
            return item;
        }
    });
    return filter
}

const headers = [
    { text: "#", value: "id", },
    { text: "MATERIA", value: "nombre", sortable: true },
    { text: "SIGLA", value: "sigla", sortable: true },
    { text: "GRADO", value: "grado", sortable: true },
    { text: "ESPECIALIDAD", value: "especialidad", sortable: true },
    { text: "HORAS ACADEMICAS", value: "horas_cademicas", sortable: true },
    { text: "ESTADO", value: "estado", sortable: true },
    { text: "ACCIÓN", value: "accion" },
];
</script>
<template>
    <template v-if="isLoading == true">
        <Spiner />
    </template>
    <template v-else>

        <!-- modal Crear -->
        <CreateMateria :isModal="create" @close="closeCreate" :grados="grados" :especialidades="especialidades" />
        <!-- modal Editar  -->
         
        <EditMateria :isModal="edit" @close="closeEdit" :item="materia" :grados="grados" :especialidades="especialidades" />
        <!-- modal pdf  -->
        <!-- <ExamplePdf :isModal="pdf" @close="closePdf" :item="materia" /> -->
    
        <Banner :title="'Lista de Materias'" />
        <div class="d-flex align-items-center justify-content-end py-4">
            <div class="row container">
                <div class="col-md-10">
                    <input class="form-control" type="search" v-model="search" placeholder="Buscar">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-success" @click="crear">
                        <span>Crear nuevo</span>
                    </button>
                </div>
            </div>
        </div>
        <EasyDataTable :headers="headers" :items="filtered()" buttons-pagination
            :rowsPerPageMessage="'filas por página'" :rowsOfPageSeparatorMessage="'de'"
            :emptyMessage="'No hay datos disponibles'">
            <template #item-estado="item">
                <template v-if="item.estado == 1">
                    <span class="text-primary">ACTIVO</span>
                </template>
                <template v-else>
                    <span class="text-danger">ELIMINADO</span>
                </template>
            </template>
            <template #item-accion="item">
                <div v-if="item.estado == 1" class="operation-wrapper d-flex align-items-center gap-1">
                    <button @click="editar(item)" class="btn btn-primary">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button @click="eliminar(item)" class="btn btn-danger">
                        <i class="fa-solid fa-x"></i>
                    </button>
                </div>
            </template>
        </EasyDataTable>
    </template>
</template>