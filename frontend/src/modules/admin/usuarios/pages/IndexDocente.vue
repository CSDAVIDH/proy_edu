<script setup>
import { ref } from 'vue';
import { useModal } from '@/hook/useModal.vue';
import { getDocentes, deleteDocente } from '@/api/usuarios/docenteApi';
import { useQuery, useMutation, useQueryClient } from '@tanstack/vue-query'
import Swal from "sweetalert2";
import { danger_alerta, show_alerta } from '@/components/AlertAdmin.vue';

//components
import Banner from '@/components/Banner.vue';
import Spiner from '@/components/Spiner.vue';
import CreateDocente from '../components/docentes/CreateDocente.vue';
import EditDocente from '../components/docentes/EditDocente.vue';
import ModalPdf from '@/components/ModalView.vue';

const docente = ref({
  id: 0,
  cv: '',
});
const search = ref('');
const [create, openCreate, closeCreate] = useModal(false);
const [edit, openEdit, closeEdit] = useModal(false);
const [pdf, openPdf, closePdf] = useModal(false);
const queryClient = useQueryClient();

const { isLoading, data: registros, isError, error } = useQuery({
  queryKey: ['docentes'], //unico
  queryFn: getDocentes,
});

const crear = () => {
  openCreate();
}

const editar = (item) => {
  docente.value = { ...docente.value, ...item };
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
      eliminarDocente.mutate(item);
    }
  });
}

const eliminarDocente = useMutation({
  mutationFn: deleteDocente,
  onSuccess: (response) => {
    queryClient.invalidateQueries('docentes');
    show_alerta("Eliminado Correctamente");
  },
  onError: (error) => {
    danger_alerta("Fallo del Servidor");
  },
});

const show_pdf = (item) => {
  docente.value = { ...docente.value, ...item };
  openPdf();
}

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
  { text: "CEDULA", value: "ci", sortable: true },
  { text: "GENERO", value: "genero", sortable: true },
  { text: "email", value: "email", sortable: true },
  { text: "ESPECIALIDAD", value: "especialidad", sortable: true },
  { text: "GRADO", value: "grado", sortable: true },
  { text: "ESTADO", value: "estado", sortable: true },
];

</script>
<template>
  <template v-if="isLoading == true">
    <Spiner />
  </template>
  <template v-else>
    <CreateDocente :isModal="create" @close="closeCreate" />
    <EditDocente :item="docente" :isModal="edit" @close="closeEdit" />
    <ModalPdf :url="docente.cv" :isModal="pdf" @close="closePdf" />

    <Banner :title="'Lista de Docentes'" />
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
            <button class="btn btn-danger" @click="show_pdf(item)">
              <i class="fa-regular fa-file-pdf"></i>
            </button>
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