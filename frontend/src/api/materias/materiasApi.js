import { useAuthStore } from '@/stores/auth/auth';
import axios from 'axios';

const authStore = useAuthStore();

export const getMaterias = async () => {
    const response = await axios.get('/api/materias', {
        headers: {
            'Authorization': 'Bearer ' + authStore.authToken,
        }
    })
        .then((response) => { return response.data })
        .catch((error) => { return error })
    return response;
}

export const getGradosEspecialidades = async () => {
    const response = await axios.get('/api/materias/grado-especialidad', {
        headers: {
            'Authorization': 'Bearer ' + authStore.authToken,
        }
    })
        .then((response) => { return response.data })
        .catch((error) => { return error })
    return response;
}

export const storeMateria = async (body) => {
    const response = await axios.post('/api/materias/store', body, {
        headers: {
            'Authorization': 'Bearer ' + authStore.authToken,
        }
    })
        .then((response) => { return response.data })
        .catch((error) => { return error })
    return response;
}

export const updateMateria = async (body) => {
    const response = await axios.post('/api/materias/update', body, {
        headers: {
            'Authorization': 'Bearer ' + authStore.authToken,
        }
    })
        .then((response) => { return response.data })
        .catch((error) => { return error })
    return response;
}

export const deleteMateria = async (body) => {
    const response = await axios.delete(`/api/materias/${body}`, {
        headers: {
            'Authorization': 'Bearer ' + authStore.authToken,
        }
    })
        .then((response) => { return response.data })
        .catch((error) => { return error })
    return response;
}

