<script setup>
import { ref } from 'vue';
import CreateCourse from '../components/CreateCourse.vue';
import EditCourse from '../components/EditCourse.vue';
import ExamplePdf from '../components/ExamplePdf.vue';
import { useModal } from '@/hook/useModal.vue';
import { getCursos, deleteCurso } from '@/api/cursosApi'; //qqui
import { useQuery, useMutation, useQueryClient } from '@tanstack/vue-query'
import Swal from "sweetalert2";
import { danger_alerta, show_alerta } from '@/components/AlertAdmin.vue';

// components
import Banner from '@/components/Banner.vue';
import Spiner from '@/components/Spiner.vue'

const curso = ref({});
const search = ref('');
const [create, openCreate, closeCreate] = useModal(false);
const [edit, openEdit, closeEdit] = useModal(false);
const [pdf, openPdf, closePdf] = useModal(false);
const queryClient = useQueryClient();


const { isLoading, data: registros, isError, error } = useQuery({
    queryKey: ['cursos'], //unico
    queryFn: getCursos,
    select: cursos => cursos.sort((a, b) => b.id - a.id),
});

const crear = () => {
    openCreate();
}

const editar = (item) => {
    openEdit();
    const aux = {
        id: item.id,
        nombre: item.subject,
        sigla: item.initials,
    }
    curso.value = { ...curso.value, ...aux };
}

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
            eliminarCurso.mutate(item.id);
        }
    });
}

const eliminarCurso = useMutation({
    mutationFn: deleteCurso,
    onSuccess: (response) => {
        queryClient.invalidateQueries('cursos');
        show_alerta("Eliminado Correctamente");
    },
    onError: (error) => {
        danger_alerta("Fallo del Servidor");
    },
});

const show_pdf = (item) =>{
    const aux = {
        id: item.id,
        nombre: item.subject,
        sigla: item.initials,
    }
    curso.value = { ...curso.value, ...aux };
    openPdf();
}

const filtered = () => {
    if (search.value.length == 0) return registros.value;
    const filter = registros.value.filter(item => {
        if (
            item.subject.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").includes(search.value.toLowerCase()) ||
            item.initials.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").includes(search.value.toLowerCase())
        ) {
            return item;
        }
    });
    return filter
}

const headers = [
    { text: "#", value: "id", },
    { text: "MATERIA", value: "subject", sortable: true },
    { text: "SIGLA", value: "initials", sortable: true },
    { text: "ESTADO", value: "state", sortable: true },
    { text: "ACCIÓN", value: "accion" },
];
</script>
<template>
    <template v-if="isLoading == true">
        <Spiner />
    </template>
    <template v-else>

        <!-- modal Crear -->
        <CreateCourse :isModal="create" @close="closeCreate" />
        <!-- modal Editar  -->
        <EditCourse :isModal="edit" @close="closeEdit" :item="curso" />
        <!-- modal pdf  -->
        <ExamplePdf :isModal="pdf" @close="closePdf" :item="curso" />

        <Banner :title="'Lista de Cursos'" />
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
            <template #item-state="item">
                <template v-if="item.state == 1">
                    <span class="text-primary">ACTIVO</span>
                </template>
                <template v-else>
                    <span class="text-danger">ELIMINADO</span>
                </template>
            </template>
            <template #item-accion="item">
                <div class="operation-wrapper d-flex align-items-center gap-1">
                    <button @click="editar(item)" class="btn btn-primary">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button @click="eliminar(item)" class="btn btn-danger">
                        <i class="fa-solid fa-x"></i>
                    </button>
                    <button @click="show_pdf(item)" class="btn btn-dark">
                        <i class="fa-regular fa-file-pdf"></i>
                    </button>
                </div>
            </template>
        </EasyDataTable>
    </template>
</template>