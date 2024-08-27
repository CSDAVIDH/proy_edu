import { useAuthStore } from '@/stores/auth/auth';
import axios from 'axios';

const authStore = useAuthStore();

export const getPadres = async () => {
    const response = await axios.get('/api/padres', {
        headers: {
            'Authorization': 'Bearer ' + authStore.authToken,
        }
    })
        .then((response) => { return response.data })
        .catch((error) => { return error })
    return response;
}

export const storePadre = async (body) => {
    const response = await axios.post('/api/padre/store', body, {
        headers: {
            'Authorization': 'Bearer ' + authStore.authToken,
        }
    })
        .then((response) => { return response.data })
        .catch((error) => { return error })
    return response;
}

export const updatePadre = async (body) => {
    const response = await axios.post('/api/padre/update', body, {
        headers: {
            'Authorization': 'Bearer ' + authStore.authToken,
        }
    })
        .then((response) => { return response.data })
        .catch((error) => { return error })
    return response;
}

export const deletePadre = async (body) => {
    const response = await axios.delete(`/api/padre/delete/${body.persona_id}`, {
        headers: {
            'Authorization': 'Bearer ' + authStore.authToken,
        }
    })
        .then((response) => { return response.data })
        .catch((error) => { return error })
    return response;
}

export const passwordPadre = async (body) => {
    const response = await axios.put(`/api/padre/password/${body.id}`, body, {
        headers: {
            'Authorization': 'Bearer ' + authStore.authToken,
        }
    })
        .then((response) => { return response.data })
        .catch((error) => { return error })
    return response;
}