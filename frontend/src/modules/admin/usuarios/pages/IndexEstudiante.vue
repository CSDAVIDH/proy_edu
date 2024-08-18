<script setup>
import { ref } from "vue";
import { useModal } from "@/hook/useModal.vue";
import CreateEstudiante from '../components/estudiantes/CreateEstudiante.vue';
import EditEstudiante from '../components/estudiantes/EditEstudiante.vue';
import { getEstudiantes } from "@/api/usuarios/estudianteApi";
import { useQuery, useMutation, useQueryClient } from "@tanstack/vue-query";
import Swal from "sweetalert2";
import { danger_alerta, show_alerta } from "@/components/AlertAdmin.vue";

//components
import Banner from "@/components/Banner.vue";
import Spiner from "@/components/Spiner.vue";

const estudiante = ref({});
const search = ref("");
const [create, openCreate, closeCreate] = useModal(false);
const [edit, openEdit, closeEdit] = useModal(false);
const [pdf, openPdf, closePdf] = useModal(false);
const queryClient = useQueryClient();

const {
  isLoading,
  data: registros,
  isError,
  error,
} = useQuery({
  queryKey: ["estudiantes"], //unico
  queryFn: getEstudiantes,
  select: (estudiantes) => estudiantes.sort((a, b) => b.id - a.id),
});

const crear = () => {
  //alert("Hola mundo")
  openCreate();
  // console.log(estudiantes)
};

const editar = (item) => {
  openEdit();
  estudiante.value = { ...estudiante.value, ...item };
};

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
  const filter = registros.value.filter((item) => {
    if (
      item.nombre
        .toLowerCase()
        .normalize("NFD")
        .replace(/[\u0300-\u036f]/g, "")
        .includes(search.value.toLowerCase()) ||
      item.genero
        .toLowerCase()
        .normalize("NFD")
        .replace(/[\u0300-\u036f]/g, "")
        .includes(search.value.toLowerCase()) ||
      item.email
        .toLowerCase()
        .normalize("NFD")
        .replace(/[\u0300-\u036f]/g, "")
        .includes(search.value.toLowerCase())
    ) {
      return item;
    }
  });
  return filter;
};

//console.log(registros.value)
const headers = [
  { text: "#", value: "id" },
  { text: "ACCIÓN", value: "accion" },
  { text: "ESTUDIANTES", value: "nombres", sortable: true },
  { text: "CÉDULA", value: "ci", sortable: true },
  { text: "GÉNERO", value: "genero", sortable: true },
  { text: "CORREO", value: "email", sortable: true },
  { text: "MATRÍCULA", value: "matricula", sortable: true },
  { text: "ESTADO", value: "estado", sortable: true },
  // { text: "ACCIÓN", value: "accion" },
];
</script>
<template>
  <template v-if="isLoading == true">
    <Spiner />
  </template>
  <template v-else>

    <!-- modal Crear -->
    <CreateEstudiante :isModal="create" @close="closeCreate" />
        <!-- modal Editar  -->
  <!--    <EditEstudiante :isModal="edit" @close="closeEdit" :item="materia" :grados="grados" :especialidades="especialidades" />
      modal pdf  -->
        <!-- <ExamplePdf :isModal="pdf" @close="closePdf" :item="materia" /> -->

    <Banner :title="'Lista de Estudiantes'" />
    <div class="d-flex align-items-center justify-content-end py-4">
      <div class="row container">
        <div class="col-md-10">
          <input
            class="form-control"
            type="search"
            v-model="search"
            placeholder="Buscar"
          />
        </div>
        <div class="col-md-2">
          <button class="btn btn-success" @click="crear">
            <span>Crear nuevo</span>
          </button>
        </div>
      </div>
    </div>
    <EasyDataTable
      :headers="headers"
      :items="filtered()"
      buttons-pagination
      :rowsPerPageMessage="'filas por página'"
      :rowsOfPageSeparatorMessage="'de'"
      :emptyMessage="'No hay datos disponibles'"
    >
      <template #item-accion="item">
        <template v-if="item.estado == 1">
          <div class="dropdown">
            <button
              class="btn btn-primary btn-sm dropdown-toggle"
              type="button"
              id="dropdownMenuButton1"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              Opciones
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><button @click="editar(item)" class="dropdown-item">
              <i class="fa-solid fa-pen-to-square"></i> Editar</button></li>
              <li> <button @click="eliminar(item)" class="dropdown-item">
              <i class="fa-solid fa-trash"></i> Eliminar</button></li>
            </ul>
          </div>
        </template>
      </template>
      <template #item-ci="item">
        <span>{{ item.persona.ci }} - {{ item.persona.expedido }} </span>
      </template>
      <template #item-nombres="item">
        <span>{{
          item.persona.nombre +
          " " +
          item.persona.paterno +
          " " +
          item.persona.materno
        }}</span>
      </template>
      <template #item-genero="item">
        <span>{{ item.persona.genero }}</span>
      </template>
      <template #item-email="item">
        <span>{{ item.persona.user.email }}</span>
      </template>
      <template #item-estado="item">
        <template v-if="item.estado == 1">
          <span class="badge bg-success text-white">ACTIVO</span>
        </template>
        <template v-else>
          <span class="badge bg-danger text-white">INACTIVO</span>
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