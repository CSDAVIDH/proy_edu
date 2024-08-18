<script setup>
import { defineProps } from 'vue';
const emit = defineEmits(['close']);

const props = defineProps({
    isModal: {
        type: Boolean,
        required: true,
        default: false
    },
});

const closeModal = () => {
    emit('close');
}

const clickmodal = (e) => {
    e.stopPropagation();
}
</script>
<template>
    <div class=" animate__animated animate__fadeIn modal_main" :class="isModal ? 'show' : null" @click="closeModal">
        <div class="modal_body" @click="clickmodal">
            <div class="modal_header">
                <div>
                    <slot name="header"/>
                </div>
                <button @click="closeModal">
                    <i class="fa-solid fa-x"></i>
                </button>
            </div>
            <div class="modal_container">
                <div class="modal_container_pdf">
                    <slot name="container"/>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
.modal_main {
    width: 100%;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 200;
    display: none;
    align-items: flex-start;
    justify-content: center;
    background-color: rgba(0, 0, 0, 0.555);
}

.modal_main.show {
    display: flex;
}

.modal_body {
    width: 80%;
    max-height: calc(100vh - 50px);
    transform: translateY(50px);
    border-radius: 10px;
    background-color: #000000c2;
    margin: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.modal_header {
    position: absolute;
    width: 100%;
    border-radius: 10px 10px 0 0;
    background-color: transparent;
    padding: 0 10px;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.modal_header button {
    border: none;
    padding: 10px;
    background-color: transparent;
}

.modal_header h1 {
    font-size: 18px;
    text-transform: uppercase
}

.modal_header button i {
    font-size: 20px;
    color: #696969;
    font-weight: bold;
    transition: all 0.5s ease-in-out;
}

.modal_header button:hover i {
    color: #fff;
}

.modal_container {
    margin-top: 30px;
    width: 100%;
    max-height: calc(100vh - 100px);
    padding: 20px;
    overflow: auto;
}

.modal_container_pdf{
    width: 816px;
    height: 1056px;
    padding: 38px;
    border: 1px solid #000;
    background-color: #fff;
}

@media (max-width: 1024px) {
    .modal_body {
        width: 90%;
    }
}

@media (max-width: 768px) {
    .modal_body {
        width: 100%;
    }
}
</style>