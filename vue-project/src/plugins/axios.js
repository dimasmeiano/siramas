import axios from 'axios'

const api = axios.create({
  baseURL: 'http://127.0.0.1:8000/api', // Ganti jika backend beda
  headers: {
    Accept: 'application/json',
  }
})

export default api