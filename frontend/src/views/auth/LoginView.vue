<template>
    <GuestLayout>
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="handleLogin">
            <!-- Email -->
            <div>
                <label
                    for="email"
                    class="block font-medium text-sm text-gray-700"
                    >E-mail</label
                >
                <input
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 px-3 py-2"
                    required
                    autofocus
                />
                <p v-if="errors.email" class="mt-2 text-sm text-red-600">
                    {{ errors.email[0] }}
                </p>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label
                    for="password"
                    class="block font-medium text-sm text-gray-700"
                    >Senha</label
                >
                <input
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 px-3 py-2"
                    required
                />
                <p v-if="errors.password" class="mt-2 text-sm text-red-600">
                    {{ errors.password[0] }}
                </p>
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label class="inline-flex items-center">
                    <input
                        v-model="form.remember"
                        type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                    />
                    <span class="ms-2 text-sm text-gray-600"
                        >Manter conectado</span
                    >
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <router-link
                    to="/forgot-password"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Esqueceu a senha?
                </router-link>

                <button
                    type="submit"
                    :disabled="loading"
                    class="ms-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-50"
                >
                    {{ loading ? "Entrando..." : "Entrar" }}
                </button>
            </div>

            <div class="mt-4 text-center">
                <span class="text-sm text-gray-600">Não tem uma conta? </span>
                <router-link
                    to="/register"
                    class="text-sm text-indigo-600 hover:text-indigo-800"
                >
                    Registre-se aqui
                </router-link>
            </div>
        </form>
    </GuestLayout>
</template>

<script setup>
import { ref, reactive } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "../../stores/auth";
import GuestLayout from "../../components/GuestLayout.vue";

const router = useRouter();
const authStore = useAuthStore();

const status = ref("");
const loading = ref(false);
const errors = ref({});

const form = reactive({
    email: "",
    password: "",
    remember: false,
});

const handleLogin = async () => {
    loading.value = true;
    errors.value = {};

    const result = await authStore.login({
        email: form.email,
        password: form.password,
        remember: form.remember,
    });

    if (result.success) {
        router.push("/");
    } else {
        errors.value = result.errors;
    }

    loading.value = false;
};
</script>
