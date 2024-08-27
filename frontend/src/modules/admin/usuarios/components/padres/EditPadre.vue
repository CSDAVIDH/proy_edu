<script setup>
import { ref, watch } from 'vue';
import ModalMd from '@/components/ModalMd.vue'
import { useForm } from "@/hook/useForm.vue";
import Swal from "sweetalert2";
import { danger_alerta, show_alerta } from '@/components/AlertAdmin.vue';
import { updatePadre } from '@/api/usuarios/padreApi';
import { useMutation, useQueryClient } from '@tanstack/vue-query'
import user_default from "@/assets/image/user.png";

const props = defineProps({
  isModal: {
    type: Boolean,
    required: true,
  },
  item: {
    type: Object,
    required: true,
  }
});

const emit = defineEmits(["close"]);
const img_preview = ref(null);
const closeModal = () => {
  emit('close');
}

watch(() => props.item, () => {
  handleRevalue(props.item);
  if (props.item.imagen) {
    const url = import.meta.env.VITE_BACKEND_URL;
    img_preview.value = url + "/storage/" + props.item.imagen;
  } else {
    img_preview.value = null;
  }
});

//DEFINIMOS VARIABLE
const loading = ref(false);
const queryClient = useQueryClient();

const validaciones = {
  nombre: { required: true, minString: 3, maxString: 90 },
  paterno: { required: true, minString: 3, maxString: 90 },
  materno: { required: true, minString: 3, maxString: 90 },
  ci: { required: true, minString: 5, maxString: 12 },
  expedido: { required: true, minString: 2, maxString: 3 },
  email: { required: true, minString: 3, maxString: 90 },
  estado_civil: { required: true },
  genero: { required: true },
  direccion: { required: true, maxString: 250 },
  telefono: { required: true, maxNumber: 9999999999 },
  profesion: { required: true, maxString: 250 },
  imagen: { nullable: true },
};

const [
  form,
  errors,
  validate,
  verficador,
  handleChange,
  handleFile,
  handleBlur,
  handleRevalue
] = useForm(props.item, validaciones);

const registrar = () => {
  verficador();
  if (validate.value) {
    const formData = new FormData();
    Object.keys(form.value).map((element) => {
      formData.append(element, form.value[element]);
    });
    Swal.fire({
      title: "Esta seguro?",
      icon: "warning",
      text: "Verifique los datos antes de enviar.",
      showCancelButton: true,
      confirmButtonText: "Si, estoy seguro",
      cancelButtonText: `Cancelar`,
      showLoaderOnConfirm: true,
      preConfirm: () => {
        loading.value = true;
        actualizarPadre.mutate(formData);
      },
    });
  } else {
    danger_alerta("Verificar Formulario");
  }
}

const actualizarPadre = useMutation({
  mutationFn: updatePadre,
  onSuccess: (response) => {
    if (response.status === true) {
      console.log(response)
      queryClient.invalidateQueries('padres');
      show_alerta("Actualizado Correctamente");
      loading.value = false;
      closeModal();
    } else {
      loading.value = false;
      errors.value = response.response.data.errors
      danger_alerta("Fallo de Validacion");
    }
  },
  onError: (error) => {
    console.log(error)
    danger_alerta("Fallo del Servidor");
  },
});

const handleImage = (e) => {
  handleFile(e);
  img_preview.value = URL.createObjectURL(e.target.files[0]);
};

</script>
<template>
  <ModalMd :isModal="isModal" @close="closeModal" :title="'Editar registro'">
    <form @submit.prevent="registrar" enctype="multipart/form-data">
      <div class="row">
        <div v-if="img_preview" class="col-md-3 my-1 text-center">
          <img :src="img_preview" alt="image" height="150px" width="150px" />
        </div>
        <div v-else class="col-md-3 my-1 text-center">
          <img :src="user_default" alt="image" height="150px" width="150px" />
        </div>

        <div class="col-md-3 my-1">
          <div class="form-group">
            <label class="form-label fw-bold" for="nombre">NOMBRES</label>
            <input type="text" id="nombre" :value="form.nombre" name="nombre" @change="handleChange" @blur="handleBlur"
              class="form-control" required />
            <p class="fs-6 text-danger" v-if="errors.nombre">
              {{ errors.nombre }}
            </p>
          </div>
          <div class="form-group">
            <label class="form-label fw-bold" for="ci">CÉDULA DE IDENTIDAD</label>
            <input type="text" id="ci" :value="form.ci" name="ci" @change="handleChange" @blur="handleBlur"
              class="form-control" required />
            <p class="fs-6 text-danger" v-if="errors.ci">
              {{ errors.ci }}
            </p>
          </div>
        </div>
        <div class="col-md-3 my-1">
          <div class="form-group">
            <label class="form-label fw-bold" for="paterno">APELLIDO PATERNO</label>
            <input type="text" id="paterno" :value="form.paterno" name="paterno" @change="handleChange"
              @blur="handleBlur" class="form-control" required />
            <p class="fs-6 text-danger" v-if="errors.paterno">
              {{ errors.paterno }}
            </p>
          </div>
          <div class="form-group">
            <label class="form-label fw-bold" for="expedido">EXPEDIDO</label>
            <select class="form-control" name="expedido" id="expedido" :value="form.expedido" @change="handleChange"
              @blur="handleBlur">
              <option value="" selected>SELECCIONE UNA OPCIÓN</option>
              <option value="LP">LP</option>
              <option value="CB">CB</option>
              <option value="SC">SC</option>
              <option value="PO">PO</option>
              <option value="BE">BE</option>
              <option value="PA">PA</option>
              <option value="OR">OR</option>
              <option value="CH">CH</option>
              <option value="TA">TA</option>
            </select>
            <p class="fs-6 text-danger" v-if="errors.expedido">
              {{ errors.expedido }}
            </p>
          </div>
        </div>
        <div class="col-md-3 my-1">
          <div class="form-group">
            <label class="form-label fw-bold" for="materno">APELLIDO MATERNO</label>
            <input type="text" id="materno" :value="form.materno" name="materno" @change="handleChange"
              @blur="handleBlur" class="form-control" required />
            <p class="fs-6 text-danger" v-if="errors.materno">
              {{ errors.materno }}
            </p>
          </div>
          <div class="form-group">
            <label class="form-label fw-bold" for="genero">GÉNERO</label>
            <select class="form-control" name="genero" id="genero" @change="handleChange" @blur="handleBlur"
              :value="form.genero" required>
              <option value="" selected>SELECCIONE UNA OPCIÓN</option>
              <option value="masculino">MASCULINO</option>
              <option value="femenino">FEMENINO</option>
            </select>
            <p class="fs-6 text-danger" v-if="errors.genero">
              {{ errors.genero }}
            </p>
          </div>
        </div>
        <div class="col-md-4 my-1">
          <div class="form-group">
            <label class="form-label fw-bold" for="imagen">FOTOGRAFIA</label>
            <input type="file" name="imagen" @change="handleImage" accept="image/*" class="form-control" />
            <p class="fs-6 text-danger" v-if="errors.imagen">
              {{ errors.imagen }}
            </p>
          </div>
        </div>
        <div class="col-md-4 my-1">
          <div class="form-group">
            <label class="form-label fw-bold" for="email">CORREO ELECTRÓNICO</label>
            <input type="text" id="email" :value="form.email" name="email" @change="handleChange" @blur="handleBlur"
              class="form-control" required />
            <p class="fs-6 text-danger" v-if="errors.email">
              {{ errors.email }}
            </p>
          </div>
        </div>
        <div class="col-md-4 my-1">
          <label class="form-label fw-bold" for="estado_civil">ESTADO CIVIL</label>
          <select class="form-control" name="estado_civil" id="estado_civil" @change="handleChange" @blur="handleBlur" :value="form.estado_civil"
            required>
            <option value="" selected>SELECCIONE UNA OPCIÓN</option>
            <option value="soltero">SOLTERO</option>
            <option value="casado">CASADO</option>
            <option value="viudo">VIUDO</option>
            <option value="divorciado">DIVORCIADO</option>
          </select>
          <p class="fs-6 text-danger" v-if="errors.estado_civil">
            {{ errors.estado_civil }}
          </p>
        </div>
        <div class="col-md-4 my-1">
          <div class="form-group">
            <label class="form-label fw-bold" for="matricula">TELEFONO</label>
            <input type="number" name="telefono" @change="handleChange" :value="form.telefono" class="form-control" />
            <p class="fs-6 text-danger" v-if="errors.telefono">
              {{ errors.telefono }}
            </p>
          </div>
        </div>
        <div class="col-md-4 my-1">
          <div class="form-group">
            <label class="form-label fw-bold" for="profesion">PROFESIÓN</label>
            <input type="text" name="profesion" @change="handleChange" :value="form.profesion" class="form-control" />
            <p class="fs-6 text-danger" v-if="errors.profesion">
              {{ errors.profesion }}
            </p>
          </div>
        </div>
        <div class="col-md-4 my-1">
          <div class="form-group">
            <label class="form-label fw-bold" for="direccion">DIRECCIÓN</label>
            <input type="text" name="direccion" @change="handleChange" :value="form.direccion" class="form-control" />
            <p class="fs-6 text-danger" v-if="errors.direccion">
              {{ errors.direccion }}
            </p>
          </div>
        </div>
      </div>
      <div class="d-flex align-items-center justify-content-between m-3">
        <button @click="closeModal" type="button" class="btn btn-danger">
          Cerrar
        </button>
        <button class="btn btn-success" disabled :class="loading ? 'd-block' : 'd-none'">
          <i class="fa-solid fa-spinner fa-spin-pulse"></i>
          <span class="mx-2">Cargando...</span>
        </button>
        <button type="submit" class="btn btn-primary" :class="loading ? 'd-none' : 'd-block'">
          Registrar
        </button>
      </div>
    </form>
  </ModalMd>
</template>