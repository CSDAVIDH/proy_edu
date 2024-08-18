<script setup>
import { ref, watch } from 'vue';
import ModalMd from '@/components/ModalMd.vue'
import { useForm } from "@/hook/useForm.vue";
import Swal from "sweetalert2";
import { danger_alerta, show_alerta } from '@/components/AlertAdmin.vue';
import { updateMateria } from '@/api/materias/materiasApi';
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
    grados: {
        type: Array,
        required: true,
    },    
    especialidades: {
        type: Array,
        required: true,
    },
});

watch(() => props.item, () => {
    handleRevalue(props.item);
});


const emit = defineEmits(['close']);
//DEFINIMOS VARIABLE
const loading = ref(false);
const queryClient = useQueryClient();

const validaciones = {
    nombre: { required: true, minString: 3, maxString: 90 },
    sigla: { required: true, minString: 3, maxString: 90 },
    horas_cademicas: { required: true, minNumber: 1, maxmaxNumberString: 999 },
    nivel: { required: true, minNumber: 1, maxmaxNumberString: 999 },
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

const registrarMateria = () => {
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
                actualizarMateria.mutate(form.value);
            },
        });
    } else {
        danger_alerta("Verificar Formulario");
    }
}

const actualizarMateria = useMutation({
    mutationFn: updateMateria,
    onSuccess: (response) => {
        if (response.status === true) {
            queryClient.invalidateQueries('materias');
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
    <ModalMd :isModal="isModal" @close="closeModal" :title="`Materia: ${item.nombre}`">
        <form @submit.prevent="registrarMateria" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label fw-bold" for="nombre">NOMBRE DE LA MATERIA</label>
                        <input type="text" placeholder="MATEMTICAS" id="nombre" :value="form.nombre" name="nombre"
                            @change="handleChange" @blur="handleBlur" class="form-control" required />
                        <p class="fs-6 text-danger" v-if="errors.nombre">
                            {{ errors.nombre }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label fw-bold" for="horas_cademicas">HORAS ACADEMICAS</label>
                        <input type="number" placeholder="100" id="horas_cademicas" :value="form.horas_cademicas"
                            name="horas_cademicas" @change="handleChange" @blur="handleBlur" class="form-control" required />
                        <p class="fs-6 text-danger" v-if="errors.horas_cademicas">
                            {{ errors.horas_cademicas }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label fw-bold" for="sigla">INICIALES O SIGLA</label>
                        <input type="text" :value="form.sigla" name="sigla" @change="handleChange" @blur="handleBlur"
                            class="form-control" placeholder="ADM-100" required />
                        <p class="fs-6 text-danger" v-if="errors.sigla">
                            {{ errors.sigla }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label fw-bold" for="porcentaje">PORCENTAJE</label>
                        <input type="text" :value="form.porcentaje" name="porcentaje" @change="handleChange" @blur="handleBlur"
                            class="form-control" placeholder="%" required />
                        <p class="fs-6 text-danger" v-if="errors.porcentaje">
                            {{ errors.porcentaje }}
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
                        <label class="form-label fw-bold" for="nivel">TIPO</label>
                        <!-- <input type="file" @input="producto.imagen = $event.target.files[0]" accept="image/*"  class="form-control"  /> -->
                        <select class="form-select" :value="form.tipo" name="tipo" @change="handleChange"
                            @blur="handleBlur" id="tipo">
                            <option value="">Selecciona una opción</option>
                            <option value="1">Materia</option>
                            <option value="2">Formación</option>
                            <option value="3">Desquite</option>
                         
                        </select>
                        <p class="fs-6 text-danger" v-show="errors.tipo">
                            {{ errors.tipo }}
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
</template>@/api/materias/materiasApi