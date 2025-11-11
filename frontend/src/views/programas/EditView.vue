<template>
  <AppLayout>
    <div class="max-w-xl mx-auto mt-14 mb-14 bg-white shadow-lg p-8 rounded-xl">
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Editar Notícia</h1>
        <button
          @click="handleDelete"
          :disabled="deleting"
          class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg transition disabled:opacity-50"
        >
          {{ deleting ? 'Excluindo...' : 'Excluir' }}
        </button>
      </div>

      <div v-if="loadingPrograma" class="text-center py-10">
        <p class="text-gray-600">Carregando...</p>
      </div>

      <form v-else @submit.prevent="handleUpdate">
        <div class="mb-4">
          <label class="block font-medium mb-1">Nome</label>
          <input
            v-model="form.nome"
            type="text"
            class="border w-full p-2 rounded focus:outline-none focus:ring-2 focus:ring-gray-800"
            required
          />
          <p v-if="errors.nome" class="text-red-600 text-sm mt-1">{{ errors.nome[0] }}</p>
        </div>

        <div class="mb-4">
          <label class="block font-medium mb-1">Descrição</label>
          <textarea
            v-model="form.descricao"
            class="border w-full p-2 rounded focus:outline-none focus:ring-2 focus:ring-gray-800 min-h-[100px]"
            required
          ></textarea>
          <p v-if="errors.descricao" class="text-red-600 text-sm mt-1">{{ errors.descricao[0] }}</p>
        </div>

        <div class="mb-4">
          <label class="block font-medium mb-1">Categoria</label>
          <input
            v-model="form.categoria"
            type="text"
            class="border w-full p-2 rounded focus:outline-none focus:ring-2 focus:ring-gray-800"
            required
          />
          <p v-if="errors.categoria" class="text-red-600 text-sm mt-1">{{ errors.categoria[0] }}</p>
        </div>

        <div class="mb-8">
          <label class="block font-medium mb-1">Link Oficial</label>
          <input
            v-model="form.link_oficial"
            type="text"
            class="border w-full p-2 rounded focus:outline-none focus:ring-2 focus:ring-gray-800"
          />
          <p v-if="errors.link_oficial" class="text-red-600 text-sm mt-1">{{ errors.link_oficial[0] }}</p>
        </div>

        <div class="flex justify-between">
          <router-link
            to="/"
            class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg transition"
          >
            Cancelar
          </router-link>

          <button
            type="submit"
            :disabled="updating"
            class="bg-gray-900 hover:bg-gray-800 text-white px-5 py-2 rounded-lg transition disabled:opacity-50"
          >
            {{ updating ? 'Salvando...' : 'Salvar' }}
          </button>
        </div>
      </form>
    </div>
  </AppLayout>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { programasApi } from '../../services/api'
import AppLayout from '../../components/AppLayout.vue'

const router = useRouter()
const route = useRoute()

const loadingPrograma = ref(true)
const updating = ref(false)
const deleting = ref(false)
const errors = ref({})

const form = reactive({
  nome: '',
  descricao: '',
  categoria: '',
  link_oficial: ''
})

onMounted(async () => {
  try {
    const response = await programasApi.getById(route.params.id)
    Object.assign(form, response.data)
  } catch (error) {
    console.error('Erro ao carregar programa:', error)
    router.push('/')
  } finally {
    loadingPrograma.value = false
  }
})

const handleUpdate = async () => {
  updating.value = true
  errors.value = {}

  try {
    await programasApi.update(route.params.id, form)
    router.push('/')
  } catch (error) {
    if (error.response?.data?.errors) {
      errors.value = error.response.data.errors
    }
    console.error('Erro ao atualizar programa:', error)
  } finally {
    updating.value = false
  }
}

const handleDelete = async () => {
  if (!confirm('Tem certeza que deseja excluir esta notícia?')) {
    return
  }

  deleting.value = true

  try {
    await programasApi.delete(route.params.id)
    router.push('/')
  } catch (error) {
    console.error('Erro ao excluir programa:', error)
    alert('Erro ao excluir notícia')
  } finally {
    deleting.value = false
  }
}
</script>

