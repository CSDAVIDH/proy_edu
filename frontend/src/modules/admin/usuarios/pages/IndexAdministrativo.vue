<script setup>
import { ref } from 'vue';
import { useModal } from '@/hook/useModal.vue';
import { getAdministrativos } from '@/api/usuarios/administrativoApi';
import { useQuery, useMutation, useQueryClient } from '@tanstack/vue-query'
import Swal from "sweetalert2";
import { danger_alerta, show_alerta } from '@/components/AlertAdmin.vue';

//components
import Banner from '@/components/Banner.vue';
import Spiner from '@/components/Spiner.vue'

const administrativo = ref({});
const search = ref('');
const [create, openCreate, closeCreate] = useModal(false);
const [edit, openEdit, closeEdit] = useModal(false);
const [pdf, openPdf, closePdf] = useModal(false);
const queryClient = useQueryClient();


const { isLoading, data: registros, isError, error } = useQuery({
  queryKey: ['administrativos'], //unico
  queryFn: getAdministrativos,
  select: administrativos => administrativos.sort((a, b) => b.id - a.id),
});

const crear = () => {
  openCreate();

}

const editar = (item) => {
  openEdit();
  administrativo.value = { ...administrativo.value, ...item };
}

// const eliminar = (item) => {
//     Swal.fire({
//         title: "Esta seguro?",
//         text: "Una vez realizado, no podrá revertir la acción!",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#3085d6",
//         cancelButtonColor: "#d33",
//         confirmButtonText: "Si, eliminar!",
//     }).then((result) => {
//         if (result.isConfirmed) {
//             eliminarAdministrativo.mutate(item.id);
//         }
//     });
// }

// const eliminarAdministrativo = useMutation({
//     mutationFn: deleteMateria,
//     onSuccess: (response) => {
//         queryClient.invalidateQueries('materias');
//         show_alerta("Eliminado Correctamente");
//     },
//     onError: (error) => {
//         danger_alerta("Fallo del Servidor");
//     },
// });

// const show_pdf = (item) => {
//     materia.value = { ...materia.value, ...item };
//     openPdf();
// }

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

console.log(registros.value)
const headers = [
  { text: "#", value: "id", },
  { text: "NOMBRE", value: "nombres", sortable: true },
  { text: "CEDULA", value: "ci", sortable: true },
  { text: "GENERO", value: "genero", sortable: true },
  { text: "CORREO", value: "email ", sortable: true },
  { text: "CARGO", value: "cargo", sortable: true },
  { text: "GRADO", value: "cargo", sortable: true },
  { text: "ESTADO", value: "estado", sortable: true },
  // { text: "ACCIÓN", value: "accion" },
];
</script>
<template>
  <template v-if="isLoading == true">
    <Spiner />
  </template>
  <template v-else>


    <Banner :title="'Lista de Administrativos'" />
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
      <!-- <template #item-accion="item">
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
            </template> -->
    </EasyDataTable>
  </template>
</template>@/api/materias/materiasApi