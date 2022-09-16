import axios from 'axios';
const BASE_URL = location.pathname + "api/";

export default axios.create({
    baseURL: BASE_URL,
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    }
})

