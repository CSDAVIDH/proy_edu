import { useAuthStore } from '@/stores/auth/auth';
import axios from 'axios';

const authStore = useAuthStore();

export const getEstudiantes = async () => {
    const response = await axios.get('/api/inscripciones', {
        headers: {
            'Authorization': 'Bearer ' + authStore.authToken,
        }
    })
        .then((response) => { return response.data })
        .catch((error) => { return error })
    return response;
}


export const getEstudiante = async (estudiante) => {
    const response = await axios.get(`/api/inscripciones/estudiante/${estudiante.id}`, {
        headers: {
            'Authorization': 'Bearer ' + authStore.authToken,
        }
    })
        .then((response) => { return response.data })
        .catch((error) => { return error })
    return response;
}

export const storeIncripcion = async (estudiante) => {
    const response = await axios.post(`/api/inscripciones/estudiante/asignar`, estudiante, {
        headers: {
            'Authorization': 'Bearer ' + authStore.authToken,
        }
    })
        .then((response) => { return response.data })
        .catch((error) => { return error })
    return response;
}

export const updateIncripcion = async (estudiante) => {
    const response = await axios.post(`/api/inscripciones/estudiante/actualizar`, estudiante, {
        headers: {
            'Authorization': 'Bearer ' + authStore.authToken,
        }
    })
        .then((response) => { return response.data })
        .catch((error) => { return error })
    return response;
}
