<script setup>
import { ref, defineProps } from 'vue';
import ModalMd from '@/components/ModalMd.vue'
import { useForm } from "@/hook/useForm.vue";
import Swal from "sweetalert2";
import { danger_alerta, show_alerta } from '@/components/AlertAdmin.vue';
import { storeCurso } from '@/api/dashboardApi';
import { useMutation, useQueryClient } from '@tanstack/vue-query'

const props = defineProps({
    isModal: {
        type: Boolean,
        required: true,
    },
});

//DEFINIMOS VARIABLE
const loading = ref(false);
const queryClient = useQueryClient();
const curso = {
    id: 0,
    nombre: null,
    sigla: null,
};

const validaciones = {
    nombre: { required: true, minString: 3, maxString: 100 },
    sigla: { required: true, minString: 3, maxString: 10 },
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
] = useForm(curso, validaciones);


const emit = defineEmits(['close']);

const closeModal = () => {
    emit('close');
}

const registrar = () => {
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
                createCurso.mutate(form.value);
            },
        });
    } else {
        danger_alerta("Verificar Formulario");
    }
}

const createCurso = useMutation({
    mutationFn: storeCurso,
    onSuccess: (response) => {
        if (response.status === true) {
            queryClient.invalidateQueries('cursos');
            show_alerta("Agregado Correctamente");
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
    },
});

</script>
<template>
    <ModalMd :isModal="isModal" @close="closeModal" :title="'Crear Nuevo Curso'">
        <form @submit.prevent="registrar" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label fw-bold" for="nombre">Nombre del Curso</label>
                        <input type="text" id="nombre" :value="form.nombre" name="nombre" @change="handleChange"
                            @blur="handleBlur" class="form-control" required />
                        <p class="fs-6 text-danger" v-if="errors.nombre">
                            {{ errors.nombre }}
                        </p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label fw-bold" for="sigla">INICIALES O SIGLA</label>
                        <input type="text" :value="form.sigla" name="sigla" @change="handleChange" @blur="handleBlur"
                            class="form-control" required />
                        <p class="fs-6 text-danger" v-if="errors.sigla">
                            {{ errors.sigla }}
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
                    Añadir
                </button>
            </div>
        </form>
    </ModalMd>
</template>