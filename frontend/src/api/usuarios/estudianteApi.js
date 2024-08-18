import { useAuthStore } from '@/stores/auth/auth';
import axios from 'axios';

const authStore = useAuthStore();

export const getEstudiantes = async () => {
    const response = await axios.get('/api/estudiantes', {
        headers: {
            'Authorization': 'Bearer ' + authStore.authToken,
        }
    })
        .then((response) => { return response.data })
        .catch((error) => { return error })
    return response;
}

export const storeEstudiante = async (body) => {
    const response = await axios.post('/api/estudiantes/store', body, {
        headers: {
            'Authorization': 'Bearer ' + authStore.authToken,
        }
    })
        .then((response) => { return response.data })
        .catch((error) => { return error })
    return response;
}