<template>
  <AppLayout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
          <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium text-gray-900">Informações do Perfil</h3>
            <p class="mt-1 text-sm text-gray-600">
              Atualize as informações do seu perfil e endereço de e-mail.
            </p>
          </div>
        </div>

        <div class="mt-5 md:mt-0 md:col-span-2">
          <form @submit.prevent="updateProfile">
            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6">
                  <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                  <input
                    v-model="profileForm.name"
                    type="text"
                    id="name"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-3 py-2"
                  />
                  <p v-if="profileErrors.name" class="mt-2 text-sm text-red-600">{{ profileErrors.name[0] }}</p>
                </div>

                <div class="col-span-6">
                  <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                  <input
                    v-model="profileForm.email"
                    type="email"
                    id="email"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-3 py-2"
                  />
                  <p v-if="profileErrors.email" class="mt-2 text-sm text-red-600">{{ profileErrors.email[0] }}</p>
                </div>
              </div>
            </div>

            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 sm:rounded-b-md">
              <button
                type="submit"
                :disabled="updatingProfile"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50"
              >
                {{ updatingProfile ? 'Salvando...' : 'Salvar' }}
              </button>
            </div>
          </form>
        </div>
      </div>

      <div class="hidden sm:block mt-10">
        <div class="py-5">
          <div class="border-t border-gray-200"></div>
        </div>
      </div>

      <div class="mt-10 sm:mt-0 md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
          <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium text-gray-900">Atualizar Senha</h3>
            <p class="mt-1 text-sm text-gray-600">
              Certifique-se de usar uma senha longa e aleatória para manter sua conta segura.
            </p>
          </div>
        </div>

        <div class="mt-5 md:mt-0 md:col-span-2">
          <form @submit.prevent="updatePassword">
            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6">
                  <label for="current_password" class="block text-sm font-medium text-gray-700">Senha Atual</label>
                  <input
                    v-model="passwordForm.current_password"
                    type="password"
                    id="current_password"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-3 py-2"
                  />
                  <p v-if="passwordErrors.current_password" class="mt-2 text-sm text-red-600">{{ passwordErrors.current_password[0] }}</p>
                </div>

                <div class="col-span-6">
                  <label for="password" class="block text-sm font-medium text-gray-700">Nova Senha</label>
                  <input
                    v-model="passwordForm.password"
                    type="password"
                    id="password"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-3 py-2"
                  />
                  <p v-if="passwordErrors.password" class="mt-2 text-sm text-red-600">{{ passwordErrors.password[0] }}</p>
                </div>

                <div class="col-span-6">
                  <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Senha</label>
                  <input
                    v-model="passwordForm.password_confirmation"
                    type="password"
                    id="password_confirmation"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-3 py-2"
                  />
                </div>
              </div>
            </div>

            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 sm:rounded-b-md">
              <button
                type="submit"
                :disabled="updatingPassword"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50"
              >
                {{ updatingPassword ? 'Salvando...' : 'Salvar' }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue'
import { useAuthStore } from '../../stores/auth'
import { profileApi } from '../../services/api'
import AppLayout from '../../components/AppLayout.vue'

const authStore = useAuthStore()

const updatingProfile = ref(false)
const updatingPassword = ref(false)
const profileErrors = ref({})
const passwordErrors = ref({})

const profileForm = reactive({
  name: '',
  email: ''
})

const passwordForm = reactive({
  current_password: '',
  password: '',
  password_confirmation: ''
})

onMounted(() => {
  if (authStore.user) {
    profileForm.name = authStore.user.name
    profileForm.email = authStore.user.email
  }
})

const updateProfile = async () => {
  updatingProfile.value = true
  profileErrors.value = {}

  try {
    const response = await profileApi.update(profileForm)
    authStore.user = response.data
    alert('Perfil atualizado com sucesso!')
  } catch (error) {
    if (error.response?.data?.errors) {
      profileErrors.value = error.response.data.errors
    }
    console.error('Erro ao atualizar perfil:', error)
  } finally {
    updatingProfile.value = false
  }
}

const updatePassword = async () => {
  updatingPassword.value = true
  passwordErrors.value = {}

  try {
    await profileApi.updatePassword(passwordForm)
    alert('Senha atualizada com sucesso!')
    passwordForm.current_password = ''
    passwordForm.password = ''
    passwordForm.password_confirmation = ''
  } catch (error) {
    if (error.response?.data?.errors) {
      passwordErrors.value = error.response.data.errors
    }
    console.error('Erro ao atualizar senha:', error)
  } finally {
    updatingPassword.value = false
  }
}
</script>

