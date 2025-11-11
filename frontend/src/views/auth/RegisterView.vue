<template>
  <GuestLayout>
    <form @submit.prevent="handleRegister">
      <!-- Name -->
      <div>
        <label for="name" class="block font-medium text-sm text-gray-700">Nome</label>
        <input
          id="name"
          v-model="form.name"
          type="text"
          class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 px-3 py-2"
          required
          autofocus
        />
        <p v-if="errors.name" class="mt-2 text-sm text-red-600">{{ errors.name[0] }}</p>
      </div>

      <!-- Email -->
      <div class="mt-4">
        <label for="email" class="block font-medium text-sm text-gray-700">E-mail</label>
        <input
          id="email"
          v-model="form.email"
          type="email"
          class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 px-3 py-2"
          required
        />
        <p v-if="errors.email" class="mt-2 text-sm text-red-600">{{ errors.email[0] }}</p>
      </div>

      <!-- Password -->
      <div class="mt-4">
        <label for="password" class="block font-medium text-sm text-gray-700">Senha</label>
        <input
          id="password"
          v-model="form.password"
          type="password"
          class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 px-3 py-2"
          required
        />
        <p v-if="errors.password" class="mt-2 text-sm text-red-600">{{ errors.password[0] }}</p>
      </div>

      <!-- Password Confirmation -->
      <div class="mt-4">
        <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Confirmar Senha</label>
        <input
          id="password_confirmation"
          v-model="form.password_confirmation"
          type="password"
          class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 px-3 py-2"
          required
        />
        <p v-if="errors.password_confirmation" class="mt-2 text-sm text-red-600">{{ errors.password_confirmation[0] }}</p>
      </div>

      <div class="flex items-center justify-end mt-4">
        <router-link
          to="/login"
          class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
          Já possui conta?
        </router-link>

        <button
          type="submit"
          :disabled="loading"
          class="ms-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-50"
        >
          {{ loading ? 'Registrando...' : 'Registrar' }}
        </button>
      </div>
    </form>
  </GuestLayout>
</template>

<script setup>
import { ref, reactive } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '../../stores/auth'
import GuestLayout from '../../components/GuestLayout.vue'

const router = useRouter()
const authStore = useAuthStore()

const loading = ref(false)
const errors = ref({})

const form = reactive({
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
})

const handleRegister = async () => {
  loading.value = true
  errors.value = {}

  const result = await authStore.register(form)

  if (result.success) {
    router.push('/')
  } else {
    errors.value = result.errors
  }

  loading.value = false
}
</script>

