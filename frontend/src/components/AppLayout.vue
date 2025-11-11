<template>
    <div class="min-h-screen bg-gray-100 flex flex-col">
        <NavigationBar />

        <main class="flex-grow">
            <slot />
        </main>

        <footer
            class="w-full py-8 bg-[#005da9] text-white border-t border-gray-600"
        >
            <div
                class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between gap-10 text-base md:items-center"
            >
                <div class="flex items-center space-x-3">
                    <img
                        src="/images/logo-sem-nome.png"
                        alt="SEFAZ Logo"
                        class="size-[4rem] object-contain"
                    />
                    <div>
                        <h1 class="font-bold text-white">SEFAZ</h1>
                        <h2 class="font-semibold text-white text-sm">
                            Secretaria de Estado da Fazenda de Alagoas
                        </h2>
                    </div>
                </div>

                <div>
                    <p class="font-semibold">Links SEFAZ AL</p>
                    <ul class="mt-2 space-y-1">
                        <li>
                            <a
                                href="https://sefaz.al.gov.br"
                                target="_blank"
                                class="underline"
                                >Site Oficial</a
                            >
                        </li>
                        <li>
                            <a
                                href="https://sefaz.al.gov.br/ipva"
                                target="_blank"
                                class="underline"
                                >Consulta IPVA</a
                            >
                        </li>
                        <li>
                            <a
                                href="https://sefaz.al.gov.br/servicos"
                                target="_blank"
                                class="underline"
                                >Serviços Online</a
                            >
                        </li>
                        <li>
                            <a
                                href="https://sefaz.al.gov.br/nfe"
                                target="_blank"
                                class="underline"
                                >NF-e</a
                            >
                        </li>
                    </ul>
                </div>

                <div>
                    <p class="font-semibold">Governo de Alagoas</p>
                    <ul class="mt-2 space-y-1">
                        <li>
                            <a
                                href="https://alagoas.al.gov.br"
                                target="_blank"
                                class="underline"
                                >Portal Oficial AL</a
                            >
                        </li>
                        <li>
                            <a
                                href="https://transparencia.al.gov.br"
                                target="_blank"
                                class="underline"
                                >Transparência</a
                            >
                        </li>
                        <li>
                            <a
                                href="https://ouvidoria.al.gov.br"
                                target="_blank"
                                class="underline"
                                >Ouvidoria</a
                            >
                        </li>
                    </ul>
                </div>

                <div v-if="authStore.isAuthenticated">
                    <p class="font-semibold">Sistema Interno</p>
                    <ul class="mt-2 space-y-1">
                        <li>
                            <router-link to="/" class="underline"
                                >Dashboard</router-link
                            >
                        </li>
                        <li>
                            <router-link to="/profile" class="underline"
                                >Perfil</router-link
                            >
                        </li>
                        <li>
                            <a
                                href="#"
                                @click.prevent="handleLogout"
                                class="underline"
                                >Sair</a
                            >
                        </li>
                    </ul>
                </div>
            </div>

            <div class="text-center text-xs text-white mt-6 opacity-80">
                © {{ new Date().getFullYear() }} SEFAZ AL - DESAFIO SEFAZ É
                MASSA
            </div>
        </footer>
    </div>
</template>

<script setup>
import { useAuthStore } from "../stores/auth";
import { useRouter } from "vue-router";
import NavigationBar from "./NavigationBar.vue";

const authStore = useAuthStore();
const router = useRouter();

const handleLogout = async () => {
    await authStore.logout();
    router.push("/login");
};
</script>
