<script setup>
import { ref } from 'vue';

import CreateParalelo from '../components/paralelos/CreateParalelo.vue';
import EditParalelo from '../components/paralelos/EditParalelo.vue';
import { useModal } from '@/hook/useModal.vue';
import { getParalelos, deleteParalelo } from '@/api/materias/paraleloApi';
import { getGradosEspecialidades } from '@/api/materias/materiasApi';
import { useQuery, useMutation, useQueryClient } from '@tanstack/vue-query'
import Swal from "sweetalert2";
import { danger_alerta, show_alerta } from '@/components/AlertAdmin.vue';

// components
import Banner from '@/components/Banner.vue';
import Spiner from '@/components/Spiner.vue'

const paralelo = ref({});
const especialidades = ref([]);
const grados = ref([]);
const search = ref('');
const [create, openCreate, closeCreate] = useModal(false);
const [edit, openEdit, closeEdit] = useModal(false);
const queryClient = useQueryClient();

const { isLoading, data: registros, isError, error } = useQuery({
    queryKey: ['paralelos'],
    queryFn: getParalelos,
    select: paralelos => paralelos.sort((a, b) => b.id - a.id),
});


const crear = () => {
    openCreate();
    gradosEspecialidades.mutate();
}

const editar = (item) => {
    openEdit();
    paralelo.value = { ...paralelo.value, ...item };
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
            eliminarParalelo.mutate(item.id);
        }
    });
}

const eliminarParalelo = useMutation({
    mutationFn: deleteParalelo,
    onSuccess: (response) => {
        queryClient.invalidateQueries('paralelos');
        show_alerta("Eliminado Correctamente");
    },
    onError: (error) => {
        danger_alerta("Fallo del Servidor");
    },
});

const filtered = () => {
    if (search.value.length == 0) return registros.value;
    const filter = registros.value.filter(item => {
        if (
            item.nombre.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").includes(search.value.toLowerCase()) ||
            item.grado.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").includes(search.value.toLowerCase()) ||
            item.especialidad.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").includes(search.value.toLowerCase())
        ) {
            return item;
        }
    });
    return filter
}

const headers = [
    { text: "#", value: "id", },
    { text: "NOMBRE", value: "nombre", sortable: true },
    { text: "GRADO", value: "grado", sortable: true },
    { text: "ESPECIALIDAD", value: "especialidad", sortable: true },
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
        <CreateParalelo :isModal="create" @cerrar="closeCreate" :grados="grados" :especialidades="especialidades" />
        <!-- modal Editar   
       -->
       <EditParalelo :isModal="edit" @close="closeEdit" :item="paralelo" :grados="grados" :especialidades="especialidades" />


        <Banner :title="'Lista de Paralelos'" />
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
                <template v-if="item.estado == 1">
                    <div class="operation-wrapper d-flex align-items-center gap-1">
                        <button @click="editar(item)" class="btn btn-primary">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button @click="eliminar(item)" class="btn btn-danger">
                            <i class="fa-solid fa-x"></i>
                        </button>
                    </div>
                </template>
            </template>
        </EasyDataTable>
    </template>
</template>