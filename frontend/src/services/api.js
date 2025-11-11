import axios from './axios'

export const programasApi = {
  getAll() {
    return axios.get('/api/programas')
  },
  getById(id) {
    return axios.get(`/api/programas/${id}`)
  },
  create(data) {
    return axios.post('/api/programas', data)
  },
  update(id, data) {
    return axios.put(`/api/programas/${id}`, data)
  },
  delete(id) {
    return axios.delete(`/api/programas/${id}`)
  }
}

export const profileApi = {
  get() {
    return axios.get('/api/profile')
  },
  update(data) {
    return axios.patch('/api/profile', data)
  },
  updatePassword(data) {
    return axios.put('/api/password', data)
  },
  delete() {
    return axios.delete('/api/profile')
  }
}

