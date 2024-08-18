<script setup>
import { defineProps } from 'vue';
import html2pdf from "html2pdf.js";
import ModalPdf from '@/components/ModalPdf.vue'

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

const emit = defineEmits(['close']);

const closeModal = () => {
    emit('close');
}

const exportToPDF = () => {
    const opt = {
        margin: 1,
        filename: 'curso.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 3 },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
    };
    const element = document.getElementById('element-to-convert');
    html2pdf().set(opt).from(element).save();
}

</script>
<template>
    <ModalPdf :isModal="isModal" @close="closeModal" :title="`Curso: ${item.nombre}`">
        <template #header>
            <button @click="exportToPDF" class="button_export_pdf">
                <i class="fa-solid fa-download"></i>
                <span>Descargar</span>
            </button>
        </template>
        <template #container>
            <div id="app" ref="document">
                <div id="element-to-convert"> <!-- // denrto del div  captura -->
                    <h1>{{ `Nombre de curso: ${item.nombre}` }}</h1>
                    <div class="clase_pdf_pru">
                        <p>{{ item.sigla }}</p>
                    </div>
                </div>
            </div>
        </template>
    </ModalPdf>
</template>
<style scoped>
.clase_pdf_pru {
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>