<template>
    <AppLayout>
        <div class="relative w-full min-h-[500px] overflow-hidden">
            <div
                class="flex flex-col md:flex-row items-center justify-center min-h-[550px] space-y-6 md:space-y-0 md:space-x-10 max-w-6xl mx-auto px-6"
            >
                <div
                    class="flex flex-col justify-center space-y-4 max-w-xl min-h-[350px] overflow-hidden rounded-2xl text-center md:text-left"
                >
                    <h1 class="text-5xl font-bold text-[#005da9]">
                        Empreendedor
                    </h1>
                    <h1 class="text-4xl font-semibold">
                        Organizado ganha mais.<br />Simples assim.
                    </h1>
                    <h1 class="text-xl max-w-lg">
                        Receba atualizações oficiais da SEFAZ sobre benefícios
                        fiscais, incentivos e programas direto no seu email —
                        sem perder oportunidades.
                    </h1>

                    <router-link
                        v-if="!authStore.isAuthenticated"
                        to="/register"
                        class="text-white font-bold rounded-lg border p-3 max-w-[10rem] bg-[#0071ce] border-[#008cff] hover:bg-[#0176d6] text-center mx-auto md:mx-0"
                    >
                        Crie sua conta
                    </router-link>
                </div>

                <div
                    class="relative w-full md:w-[550px] h-[300px] bg-[#005da9] rounded-2xl overflow-hidden"
                >
                    <video
                        autoplay
                        muted
                        loop
                        playsinline
                        class="absolute inset-0 w-full h-full object-cover"
                    >
                        <source
                            src="http://localhost:8000/videos/fundo.mp4"
                            type="video/mp4"
                        />
                    </video>
                </div>
            </div>
        </div>

        <div class="w-full bg-[#005da9] pt-16 pb-16">
            <h1
                class="text-center text-6xl font-extrabold text-white tracking-tight mb-10"
            >
                SEFAZ É MASSA
            </h1>

            <div
                class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-10 text-white text-center"
            >
                <div class="space-y-2">
                    <h2 class="text-3xl font-bold">Tudo Centralizado</h2>
                    <p class="text-md opacity-90">
                        Acesso rápido a notícias em um só lugar.
                    </p>
                </div>

                <div class="space-y-2">
                    <h2 class="text-3xl font-bold">Transparência Real</h2>
                    <p class="text-md opacity-90">
                        Informações oficiais direto da SEFAZ, atualizadas de
                        forma contínua.
                    </p>
                </div>

                <div class="space-y-2">
                    <h2 class="text-3xl font-bold">Oportunidades Certas</h2>
                    <p class="text-md opacity-90">
                        Receba notificações e descubra novos benefícios para seu
                        negócio.
                    </p>
                </div>
            </div>
        </div>

        <div class="max-w-[69rem] mx-auto mt-24 px-6 mb-24">
            <div class="flex justify-between items-center mb-10">
                <h1 class="text-3xl font-bold">Notícias</h1>

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
                <p class="text-gray-600">
                    Nenhuma notícia disponível no momento.
                </p>
            </div>

            <div
                v-else
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8"
            >
                <div
                    v-for="programa in programas"
                    :key="programa.id"
                    class="bg-white rounded-xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition flex flex-col justify-between h-full"
                >
                    <div>
                        <h2 class="font-bold text-xl mb-2">
                            {{ programa.nome }}
                        </h2>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {{ programa.descricao }}
                        </p>
                        <p class="mt-2 text-sm">
                            <span class="font-semibold">Categoria:</span>
                            {{ programa.categoria }}
                        </p>
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
import { ref, onMounted } from "vue";
import { useAuthStore } from "../stores/auth";
import { programasApi } from "../services/api";
import AppLayout from "../components/AppLayout.vue";

const authStore = useAuthStore();
const programas = ref([]);
const loading = ref(true);

onMounted(async () => {
    try {
        const response = await programasApi.getAll();
        programas.value = response.data;
    } catch (error) {
        console.error("Erro ao carregar programas:", error);
    } finally {
        loading.value = false;
    }
});
</script>

<style scoped>
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
