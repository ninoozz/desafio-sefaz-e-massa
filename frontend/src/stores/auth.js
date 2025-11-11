import { defineStore } from 'pinia'
import axios from '../services/axios'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null,
    token: localStorage.getItem('token') || null
  }),

  getters: {
    isAuthenticated: (state) => !!state.token && !!state.user,
    isAdmin: (state) => state.user?.role === 'admin'
  },

  actions: {
    async checkAuth() {
      if (!this.token) {
        this.user = null
        return
      }

      try {
        const response = await axios.get('/api/user')
        this.user = response.data
      } catch (error) {
        this.logout()
      }
    },

    async login(credentials) {
      try {
        // Fazer login (sem CSRF cookie - usando Bearer tokens)
        const response = await axios.post('/api/login', credentials)
        this.token = response.data.token
        this.user = response.data.user
        localStorage.setItem('token', this.token)
        return { success: true }
      } catch (error) {
        console.error('Erro no login:', error.response?.data)
        return { 
          success: false, 
          errors: error.response?.data?.errors || { email: ['Credenciais inválidas'] }
        }
      }
    },

    async register(data) {
      try {
        const response = await axios.post('/api/register', data)
        this.token = response.data.token
        this.user = response.data.user
        localStorage.setItem('token', this.token)
        return { success: true }
      } catch (error) {
        console.error('Erro no registro:', error.response?.data)
        return { 
          success: false, 
          errors: error.response?.data?.errors || {}
        }
      }
    },

    async logout() {
      try {
        if (this.token) {
          await axios.post('/api/logout')
        }
      } catch (error) {
        console.error('Erro ao fazer logout:', error)
      } finally {
        this.user = null
        this.token = null
        localStorage.removeItem('token')
      }
    }
  }
})

