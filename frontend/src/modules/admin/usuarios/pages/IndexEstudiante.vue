<script setup>
import { ref } from 'vue';
import { useModal } from '@/hook/useModal.vue';
import { getEstudiantes, deleteEstudiante } from '@/api/usuarios/estudianteApi';
import { useQuery, useMutation, useQueryClient } from '@tanstack/vue-query'
import Swal from "sweetalert2";
import { danger_alerta, show_alerta } from '@/components/AlertAdmin.vue';

//components
import Banner from '@/components/Banner.vue';
import Spiner from '@/components/Spiner.vue';
import CreateEstudiante from '../components/estudiantes/CreateEstudiante.vue';
import EditEstudiante from '../components/estudiantes/EditEstudiante.vue';

const estudiante = ref({});
const search = ref('');
const [create, openCreate, closeCreate] = useModal(false);
const [edit, openEdit, closeEdit] = useModal(false);
const queryClient = useQueryClient();

const { isLoading, data: registros, isError, error } = useQuery({
  queryKey: ['estudiantes'], //unico
  queryFn: getEstudiantes,
});

const crear = () => {
  openCreate();
}

const editar = (item) => {
  estudiante.value = { ...estudiante.value, ...item };
  openEdit();
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
      eliminarEstudiante.mutate(item);
    }
  });
}

const eliminarEstudiante = useMutation({
  mutationFn: deleteEstudiante,
  onSuccess: (response) => {
    queryClient.invalidateQueries('estudiantes');
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
      item.genero.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").includes(search.value.toLowerCase()) ||
      item.email.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "").includes(search.value.toLowerCase())
    ) {
      return item;
    }
  });
  return filter
}

const headers = [
  { text: "#", value: "accion", },
  { text: "NOMBRE", value: "nombres", sortable: true },
  { text: "MATRICULA", value: "matricula", sortable: true },
  { text: "CEDULA", value: "ci", sortable: true },
  { text: "GENERO", value: "genero", sortable: true },
  { text: "CORREO", value: "email", sortable: true },
  { text: "FECHA", value: "fecha_alta", sortable: true },
  { text: "ESTADO", value: "estado", sortable: true },
];

</script>
<template>
  <template v-if="isLoading == true">
    <Spiner />
  </template>
  <template v-else>
    <CreateEstudiante :isModal="create" @close="closeCreate" />
    <EditEstudiante :item="estudiante" :isModal="edit" @close="closeEdit" />

    <Banner :title="'Lista de Estudiante'" />
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
    <EasyDataTable :headers="headers" :items="filtered()" buttons-pagination :rowsPerPageMessage="'filas por página'"
      :rowsOfPageSeparatorMessage="'de'" :emptyMessage="'No hay datos disponibles'">
      <template #item-ci="item">
        <span>{{ item.ci + ' ' + item.expedido }}</span>
      </template>
      <template #item-nombres="item">
        <span>{{ item.nombre + ' ' + item.paterno + ' ' + item.materno }}</span>
      </template>
      <template #item-estado="item">
        <template v-if="item.estado == 1">
          <span class="badge bg-green text-primary">ACTIVO</span>
        </template>
        <template v-else>
          <span class="text-danger">ELIMINADO</span>
        </template>
      </template>
      <template #item-accion="item">
        <template v-if="item.estado == 1">
          <div class="d-flex align-items-center gap-1">
            <div class="dropdown">
              <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-bars"></i>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li>
                  <button @click="editar(item)" class="dropdown-item">
                    <i class="fa-solid fa-pen-to-square"></i> Editar</button>
                </li>
                <li>
                  <button @click="eliminar(item)" class="dropdown-item">
                    <i class="fa-solid fa-trash"></i> Eliminar</button>
                </li>
              </ul>
            </div>
          </div>
        </template>
      </template>
    </EasyDataTable>
  </template>
</template>