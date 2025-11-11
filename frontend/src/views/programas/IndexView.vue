<template>
  <AppLayout>
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Notícias</h1>

        <router-link
          v-if="authStore.isAdmin"
          to="/programas/create"
          class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow transition"
        >
          Criar Notícia
        </router-link>
      </div>

      <div v-if="loading" class="text-center py-10">
        <p class="text-gray-600">Carregando notícias...</p>
      </div>

      <div v-else-if="programas.length === 0" class="text-center py-10">
        <p class="text-gray-600">Nenhuma notícia cadastrada.</p>
      </div>

      <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <div
          v-for="programa in programas"
          :key="programa.id"
          class="bg-white rounded-xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition flex flex-col justify-between h-full"
        >
          <div>
            <h2 class="font-bold text-xl mb-2">{{ programa.nome }}</h2>
            <p class="text-gray-600 text-sm mb-4">{{ programa.descricao }}</p>
            <p class="mt-2 text-sm"><span class="font-semibold">Categoria:</span> {{ programa.categoria }}</p>
          </div>

          <div class="mt-4 flex justify-between items-center">
            <a
              :href="programa.link_oficial"
              target="_blank"
              class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm shadow transition"
            >
              Ir para página
            </a>

            <router-link
              v-if="authStore.isAdmin"
              :to="`/programas/${programa.id}/edit`"
              class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm shadow transition"
            >
              Editar
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useAuthStore } from '../../stores/auth'
import { programasApi } from '../../services/api'
import AppLayout from '../../components/AppLayout.vue'

const authStore = useAuthStore()
const programas = ref([])
const loading = ref(true)

onMounted(async () => {
  try {
    const response = await programasApi.getAll()
    programas.value = response.data
  } catch (error) {
    console.error('Erro ao carregar programas:', error)
  } finally {
    loading.value = false
  }
})
</script>

