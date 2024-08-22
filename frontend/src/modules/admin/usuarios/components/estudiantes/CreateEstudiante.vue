<script setup>
import { ref, defineProps } from 'vue';
import ModalMd from '@/components/ModalMd.vue'
import { useForm } from "@/hook/useForm.vue";
import Swal from "sweetalert2";
import { danger_alerta, show_alerta } from '@/components/AlertAdmin.vue';
import { storeEstudiante } from '@/api/usuarios/estudianteApi';
import { useMutation, useQueryClient } from '@tanstack/vue-query';

const props = defineProps({
    isModal: {
        type: Boolean,
        required: true,
    },
});

//DEFINIMOS VARIABLE
const loading = ref(false);
const queryClient = useQueryClient();
const estudiante = {
    id: 0,
    nombre: null,
    paterno: null,
    materno: null,
    ci: null,
    genero: null,
    email:null,
    expedido: null,
    nota: null
};

const validaciones = {
    nombre: { required: true, minString: 3, maxString: 90 },
    paterno: { required: true, minString: 3, maxString: 90 },
    materno: { required: true, minString: 3, maxString: 90 },
    nota: { required: true, minNumber: 51, maxNumber: 100},
    ci: { required: true, minString: 5, maxString:  12},
    expedido: { required: true, minString: 2, maxString: 3 },
    email: { required: true, minString: 3, maxString: 90 },
    genero: { required: true },

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
] = useForm(estudiante, validaciones);

const emit = defineEmits(['close']);

const closeModal = () => {
    emit('close');
}

const registrar = () => {
    return console.log(form.value)
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
                createEstudiante.mutate(form.value);
            },
        });
    } else {
        danger_alerta("Verificar Formulario");
    }
}

const createEstudiante = useMutation({
    mutationFn: storeEstudiante,
    onSuccess: (response) => {
        if (response.status === true) {
            queryClient.invalidateQueries('estudiantes');
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

const mySelectEvent = () => {
    console.log('mySelectEvent')
}
const myChangeEvent = () => {
    console.log('myChangeEvent')
}

</script>
<template>
    <ModalMd :isModal="isModal" @close="closeModal" :title="'Registrar nuevo estudiante'">
        <form @submit.prevent="registrar" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4 my-1">
                    <div class="form-group">
                        <label class="form-label fw-bold" for="nombre">NOMBRES</label>
                        <input type="text" id="nombre" :value="form.nombre" name="nombre"
                            @change="handleChange" @blur="handleBlur" class="form-control" required />
                        <p class="fs-6 text-danger" v-if="errors.nombre">
                            {{ errors.nombre }}
                        </p>
                    </div>
                </div>
                <div class="col-md-4 my-1">
                    <div class="form-group">
                        <label class="form-label fw-bold" for="paterno">APELLIDO PATERNO</label>
                        <input type="text" id="paterno" :value="form.paterno" name="paterno"
                            @change="handleChange" @blur="handleBlur" class="form-control" required />
                        <p class="fs-6 text-danger" v-if="errors.paterno">
                            {{ errors.paterno }}
                        </p>
                    </div>
                </div>
                <div class="col-md-4 my-1">
                    <div class="form-group">
                        <label class="form-label fw-bold" for="materno">APELLIDO MATERNO</label>
                        <input type="text" id="materno" :value="form.materno" name="materno"
                            @change="handleChange" @blur="handleBlur" class="form-control" required />
                        <p class="fs-6 text-danger" v-if="errors.materno">
                            {{ errors.materno }}
                        </p>
                    </div>
                </div>
                <div class="col-md-4 my-1">
                    <div class="form-group">
                        <label class="form-label fw-bold" for="ci">CÉDULA DE IDENTIDAD</label>
                        <input type="text" id="ci" :value="form.ci"
                            name="ci" @change="handleChange" @blur="handleBlur" class="form-control"
                            required />
                        <p class="fs-6 text-danger" v-if="errors.ci">
                            {{ errors.ci }}
                        </p>
                    </div>
                </div>
                <div class="col-md-4 my-1">
                    <div class="form-group">
                        <label class="form-label fw-bold" for="expedido">EXPEDIDO</label>
                        <select class="form-control" name="expedido" id="expedido" :value="form.expedido" @change="handleChange" @blur="handleBlur">
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
                <div class="col-md-4 my-1">
                    <div class="form-group">
                        <label class="form-label fw-bold" for="email">CORREO ELECTRÓNICO</label>
                        <input type="text" id="email" :value="form.email"
                            name="email" @change="handleChange" @blur="handleBlur" class="form-control"
                            required />
                        <p class="fs-6 text-danger" v-if="errors.email">
                            {{ errors.email }}
                        </p>
                    </div>
                </div>
                <div class="col-md-4 my-1">
                    <div class="form-group">
                        <label class="form-label fw-bold" for="genero">GÉNERO</label>
                       <select class="form-control" name="genero" id="genero" @change="handleChange" @blur="handleBlur" required >
                        <option value="" selected>SELECCIONE UNA OPCIÓN</option>
                            <option value="MASCULINO">MASCULINO</option>
                            <option value="FEMENINO">FEMENINO</option>
                       </select>
                        <p class="fs-6 text-danger" v-if="errors.genero">
                            {{ errors.genero }}
                        </p>
                    </div>
                </div>
                <div class="col-md-4 my-1">
                    <div class="form-group">
                        <label class="form-label fw-bold" for="nota">NOTA DE INGRESO</label>
                        <input type="number" id="nota" :value="form.nota"
                            name="nota" @change="handleChange" @blur="handleBlur" class="form-control"
                            required />
                        <p class="fs-6 text-danger" v-if="errors.nota">
                            {{ errors.nota }}
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