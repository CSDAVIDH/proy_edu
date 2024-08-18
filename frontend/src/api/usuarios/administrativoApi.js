import { useAuthStore } from '@/stores/auth/auth';
import axios from 'axios';

const authStore = useAuthStore();

export const getAdministrativos = async () => {
    const response = await axios.get('/api/administrativos', {
        headers: {
            'Authorization': 'Bearer ' + authStore.authToken,
        }
    })
        .then((response) => { return response.data })
        .catch((error) => { return error })
    return response;
}