import { useAuthStore } from '@/stores/auth/auth';
import axios from 'axios';

const authStore = useAuthStore();

export const getGrados = async () => {
    const response = await axios.get('/api/inscripciones/grados', {
        headers: {
            'Authorization': 'Bearer ' + authStore.authToken,
        }
    })
        .then((response) => { return response.data })
        .catch((error) => { return error })
    return response;
}

export const getDatos = async (body) => {
    const response = await axios.post('/api/inscripciones/datos', body, {
        headers: {
            'Authorization': 'Bearer ' + authStore.authToken,
        }
    })
        .then((response) => { return response.data })
        .catch((error) => { return error })
    return response;
}


export const getInscritos = async (body) => {
    const response = await axios.post('/api/inscripciones/inscritos', body, {
        headers: {
            'Authorization': 'Bearer ' + authStore.authToken,
        }
    })
        .then((response) => { return response.data })
        .catch((error) => { return error })
    return response;
}

export const getEstudiantes = async (body) => {
    const response = await axios.post('/api/inscripciones/estudiantes', body, {
        headers: {
            'Authorization': 'Bearer ' + authStore.authToken,
        }
    })
        .then((response) => { return response.data })
        .catch((error) => { return error })
    return response;
}

export const storeEstudiantes = async (body) => {
    const response = await axios.post('/api/inscripciones/estudiantes/store', body, {
        headers: {
            'Authorization': 'Bearer ' + authStore.authToken,
        }
    })
        .then((response) => { return response.data })
        .catch((error) => { return error })
    return response;
}