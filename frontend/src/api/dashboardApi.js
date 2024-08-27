import { useAuthStore } from '@/stores/auth/auth';
import axios from 'axios';

const authStore = useAuthStore();

export const getDashboard = async () => {
    const response = await axios.get('/api/dashboard', {
        headers: {
            'Authorization': 'Bearer ' + authStore.authToken,
        }
    })
        .then((response) => { return response.data })
        .catch((error) => { return error })
    return response;
}


