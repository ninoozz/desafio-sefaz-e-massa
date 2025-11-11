<template>
  <AppLayout>
    <div class="max-w-xl mx-auto mt-10 bg-white shadow p-6 rounded">
      <h1 class="text-xl font-bold mb-4">Criar Notícia</h1>

      <form @submit.prevent="handleSubmit">
        <div class="mb-3">
          <label class="block font-medium mb-1">Nome</label>
          <input
            v-model="form.nome"
            type="text"
            class="border w-full p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
            required
          />
          <p v-if="errors.nome" class="text-red-600 text-sm mt-1">{{ errors.nome[0] }}</p>
        </div>

        <div class="mb-3">
          <label class="block font-medium mb-1">Descrição</label>
          <textarea
            v-model="form.descricao"
            class="border w-full p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 min-h-[100px]"
            required
          ></textarea>
          <p v-if="errors.descricao" class="text-red-600 text-sm mt-1">{{ errors.descricao[0] }}</p>
        </div>

        <div class="mb-3">
          <label class="block font-medium mb-1">Categoria</label>
          <input
            v-model="form.categoria"
            type="text"
            class="border w-full p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
            required
          />
          <p v-if="errors.categoria" class="text-red-600 text-sm mt-1">{{ errors.categoria[0] }}</p>
        </div>

        <div class="mb-3">
          <label class="block font-medium mb-1">Link Oficial</label>
          <input
            v-model="form.link_oficial"
            type="text"
            class="border w-full p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
          <p v-if="errors.link_oficial" class="text-red-600 text-sm mt-1">{{ errors.link_oficial[0] }}</p>
        </div>

        <div class="flex justify-between mt-6">
          <router-link
            to="/"
            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition"
          >
            Cancelar
          </router-link>

          <button
            type="submit"
            :disabled="loading"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition disabled:opacity-50"
          >
            {{ loading ? 'Criando...' : 'Criar' }}
          </button>
        </div>
      </form>
    </div>
  </AppLayout>
</template>

<script setup>
import { ref, reactive } from 'vue'
import { useRouter } from 'vue-router'
import { programasApi } from '../../services/api'
import AppLayout from '../../components/AppLayout.vue'

const router = useRouter()
const loading = ref(false)
const errors = ref({})

const form = reactive({
  nome: '',
  descricao: '',
  categoria: '',
  link_oficial: ''
})

const handleSubmit = async () => {
  loading.value = true
  errors.value = {}

  try {
    await programasApi.create(form)
    router.push('/')
  } catch (error) {
    if (error.response?.data?.errors) {
      errors.value = error.response.data.errors
    }
    console.error('Erro ao criar programa:', error)
  } finally {
    loading.value = false
  }
}
</script>

