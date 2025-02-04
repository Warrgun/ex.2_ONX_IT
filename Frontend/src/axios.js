import axios from 'axios'

const axiosClient = axios.create({
    baseURL: import.meta.env.VITE_API_BASE_URL,
    withCredentials: true,
    withXSRFToken: true,
})

axiosClient.interceptors.response.use(response => response, error =>{
    if(error.response && error.response.status === 401){
        router.push({name: 'Login'})
    }

    throw error;
})

export default axiosClient;