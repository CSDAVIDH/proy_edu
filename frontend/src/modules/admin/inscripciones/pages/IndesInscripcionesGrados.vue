<script setup>
import { ref } from 'vue';
import { getGrados } from '@/api/inscripciones/inscripcionGradosApi';
import { useQuery } from '@tanstack/vue-query'


//components
import Banner from '@/components/Banner.vue';
import Spiner from '@/components/Spiner.vue'

const search = ref('');

const { isLoading, data: registros, isError, error } = useQuery({
    queryKey: ['inscripciones.grados'], //unico
    queryFn: getGrados,
});

const showModal = (item) => {
    openModal();
    estudiante.value = { ...estudiante.value, ...item };
}

const filtered = () => {
    if (search.value.length == 0) return registros.value;
    const filter = registros.value.filter(item => {
        if (
            item.descripcion.toLowerCase().normalize('NFD').includes(search.value.toLowerCase()) ||
            item.nivel.toString().includes(search.value)
        ) {
            return item;
        }
    });
    return filter
}

const headers = [
    { text: "#", value: "id", },
    { text: "GRADO", value: "descripcion", sortable: true },
    { text: "NIVEL", value: "nivel", sortable: true },
    { text: "ACCIÓN", value: "accion" },
];
</script>
<template>
    <template v-if="isLoading == true">
        <Spiner />
    </template>
    <template v-else>
        <Banner :title="'Lista de Grados'" />
        <div class="d-flex align-items-center justify-content-end py-4">
            <div class="row container">
                <div class="col-md-10">
                    <input class="form-control" type="search" v-model="search" placeholder="Buscar">
                </div>
            </div>
        </div>
        <EasyDataTable :headers="headers" :items="filtered()" buttons-pagination
            :rowsPerPageMessage="'filas por página'" :rowsOfPageSeparatorMessage="'de'"
            :emptyMessage="'No hay datos disponibles'">
            <template #item-accion="item">
                <router-link :to="{ name: 'admin.incripciones.grado.id', params: { grado_id: item.id }}" class="btn btn-primary" title="Ver Datos">
                    <i class="fa-solid fa-arrow-pointer"></i>
                </router-link>              
            </template>
        </EasyDataTable>
    </template>
</template>