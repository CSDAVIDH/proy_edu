<script setup>
import { ref, watch } from 'vue';
import ModalMd from '@/components/ModalMd.vue'
import { useForm } from "@/hook/useForm.vue";
import Swal from "sweetalert2";
import { danger_alerta, show_alerta } from '@/components/AlertAdmin.vue';
import { getEspecialidades, updateEspecialidades } from '@/api/especialidades/especialidadesApi';
import { useMutation, useQueryClient } from '@tanstack/vue-query'

const props = defineProps({
    isModal: {
        type: Boolean,
        required: true,
    },

    item: {
        type: Object,
        required: true,
    },
});

watch(() => props.item, () => {
    handleRevalue(props.item);
});



const emit = defineEmits(['close']);
const especialidades = ref([]);
//DEFINIMOS VARIABLE
const loading = ref(false);
const queryClient = useQueryClient();

const validaciones = {
    nombre: { required: true,  },
    descripcion: { required: true, minString: 3, maxString: 200 },
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

const registrarEspecialidad = () => {
    verficador();
    if (validate.value) {
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
                actualizarEspecialidad.mutate(form.value);
            },
        });
    } else {
        danger_alerta("Verificar Formulario");
    }
}

const actualizarEspecialidad = useMutation({
    mutationFn: updateEspecialidades,
    onSuccess: (response) => {
        if (response.status === true) {
            queryClient.invalidateQueries('especialidades');
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
        danger_alerta("Fallo del Servidor");
        console.log(error)
    },
});

const closeModal = () => {
    emit('close');
}

</script>
<template>
    <ModalMd :isModal="isModal" @close="closeModal" :title="`Especialidad: ${item.nombre}`">
        <form @submit.prevent="registrarEspecialidad" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label fw-bold" for="nombre">Nombre de Especialidad</label>
                        <input type="text" id="nombre" :value="form.nombre" name="nombre" @change="handleChange"
                            @blur="handleBlur" class="form-control" required />
                        <p class="fs-6 text-danger" v-if="errors.nombre">
                            {{ errors.nombre }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label fw-bold" for="descripcion">Descripcion</label>
                        <input type="text" id="descripcion" :value="form.descripcion" name="descripcion" @change="handleChange"
                            @blur="handleBlur" class="form-control" required />
                        <p class="fs-6 text-danger" v-if="errors.descripcion">
                            {{ errors.descripcion }}
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
                    Actualizar
                </button>
            </div>
        </form>
    </ModalMd>
</template>