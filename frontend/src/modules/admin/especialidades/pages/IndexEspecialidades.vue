<script setup>
import { ref } from 'vue';

import CreateEspecialidad from '../components/especialidades/CreateEspecialidad.vue';
import EditEspecialidad from '../components/especialidades/EditEspecialidad.vue';
import { useModal } from '@/hook/useModal.vue';
import { getEspecialidades, deleteEspecialidades} from '@/api/especialidades/especialidadesApi';
import { useQuery, useMutation, useQueryClient } from '@tanstack/vue-query'
import Swal from "sweetalert2";
import { danger_alerta, show_alerta } from '@/components/AlertAdmin.vue';

// components
import Banner from '@/components/Banner.vue';
import Spiner from '@/components/Spiner.vue'

const especialidad = ref({});
const search = ref('');
const [create, openCreate, closeCreate] = useModal(false);
const [edit, openEdit, closeEdit] = useModal(false);
const queryClient = useQueryClient();

const { isLoading, data: registros, isError, error } = useQuery({
    queryKey: ['especialidades'],
    queryFn: getEspecialidades,
    select: especialidades => especialidades.sort((a, b) => b.id - a.id),
    onError: (error) => {
        console.error("Error fetching especialidades:", error);
    },
    
});


const crear = () => {
    openCreate();
}

const editar = (item) => {    
    openEdit();
    especialidad.value = { ...especialidad.value, ...item };
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
            eliminarEspecialidad.mutate(item.id);
        }
    });
}

const eliminarEspecialidad = useMutation({
    mutationFn: deleteEspecialidades,
    onSuccess: (response) => {
        queryClient.invalidateQueries('especialidades');
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
            item.descripcion.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").includes(search.value.toLowerCase()) ||
            item.nombre.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").includes(search.value.toLowerCase())
        ) {
            return item;
        }
    });
    return filter
}



const headers = [
    { text: "#", value: "id", },
    { text: "NOMBRE", value: "nombre" },
    { text: "DESCRIPCION", value: "descripcion", sortable: true },
    { text: "ESTADO", value: "estado", sortable: true },
    { text: "ACCIÓN", value: "accion" },

];
console.log(registros)
</script>
<template>
    <template v-if="isLoading == true">
        <Spiner />
    </template>
    <template v-else>

        <!-- modal Crear -->
        <CreateEspecialidad :isModal="create" @close="closeCreate"  />
        <!-- modal Editar  -->
        <EditEspecialidad :isModal="edit" @close="closeEdit" :item="especialidad" />

        <Banner :title="'Lista de Especialidades'" />
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



