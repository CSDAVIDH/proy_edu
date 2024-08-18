<script setup>
import { ref, defineProps, watch } from 'vue';
import ModalMd from '@/components/ModalMd.vue'
import { useForm } from "@/hook/useForm.vue";
import Swal from "sweetalert2";
import { danger_alerta, show_alerta } from '@/components/AlertAdmin.vue';
import { storeParalelo } from '@/api/materias/paraleloApi';
import { getEspecialidades } from '@/api/especialidades/especialidadesApi';
import { useMutation, useQueryClient } from '@tanstack/vue-query';

const props = defineProps({
    isModal: {
        type: Boolean,
        required: true,
    },
    grados: {
        type: Array,
        required: true,
    },    
    especialidades: {
        type: Array,
        required: true,
    },
});
const emit = defineEmits(['cerrar']);

//DEFINIMOS VARIABLE
const loading = ref(false);

const queryClient = useQueryClient();
const paralelo = {
    id: 0,
    nombre: null,
    grado_id: null,
    especialidad_id: null,
    estado: null,
};

const validaciones = {
    nombre: { required: true },
    grado_id: { required: true},
    especialidad_id: { required: true },
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
] = useForm(paralelo, validaciones);

const closeModal = () => {
    emit('cerrar');
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
                createParalelo.mutate(form.value);
            },
        });
    } else {
        danger_alerta("Verificar Formulario");
    }
}

const createParalelo = useMutation({
    mutationFn: storeParalelo,
    onSuccess: (response) => {
        if (response.status === true) {
            queryClient.invalidateQueries('paralelos');
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
    <ModalMd :isModal="isModal" @close="closeModal" :title="'Crear Nuevo Paralelo'">
        <form @submit.prevent="registrar" enctype="multipart/form-data">
            <div class="row">
               
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label fw-bold" for="especialidad_id">ESPECIALIDAD</label>
                        <v-select :options="especialidades" :reduce="especialidad => especialidad.id" label="descripcion"
                            v-model="form.especialidad_id" name="especialidad_id" id="especialidad_id" placeholder="Elige una Especialidad"
                            :required="true">
                            <template  #option="option" :required="true">
                                <span>{{ option.nombre }}</span>
                            </template>
                            <template #search="{ attributes, events }">
                                <input class="vs__search" :required="!form.especialidad_id" v-bind="attributes" v-on="events" />
                            </template>
                        </v-select>
                        <p class="fs-6 text-danger" v-show="errors.especialidad_id">
                            {{ errors.especialidad_id }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label fw-bold" for="grado_id">GRADO</label>
                        <v-select :options="grados" :reduce="grado => grado.id" label="descripcion"
                            v-model="form.grado_id" name="grado_id" id="grado_id" placeholder="Elige un Grado"
                            :required="true">
                            <template  #option="option" :required="true">
                                <span>{{ option.descripcion }}</span>
                            </template>
                            <template #search="{ attributes, events }">
                                <input class="vs__search" :required="!form.grado_id" v-bind="attributes" v-on="events" />
                            </template>
                        </v-select>
                        <p class="fs-6 text-danger" v-show="errors.grado_id">
                            {{ errors.grado_id }}
                        </p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label fw-bold" for="nombre">Nombre del Paralelo</label>
                        <input type="text" id="nombre" :value="form.nombre" name="nombre" @change="handleChange"
                            @blur="handleBlur" class="form-control" required />
                        <p class="fs-6 text-danger" v-if="errors.nombre">
                            {{ errors.nombre }}
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