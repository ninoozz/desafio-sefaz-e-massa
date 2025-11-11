<template>
    <nav class="bg-[#005da9] border-b border-gray-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-[8vh]">
                <div class="flex">
                    <div class="shrink-0 flex items-center space-x-10">
                        <router-link to="/">
                            <img
                                src="/images/logo-sem-nome.png"
                                alt="SEFAZ Logo"
                                class="size-[4rem] object-contain"
                            />
                        </router-link>
                        <div>
                            <h1 class="font-bold text-white">SEFAZ</h1>
                            <h2 class="font-semibold text-white text-sm">
                                Secretaria de Estado da Fazenda de Alagoas
                            </h2>
                        </div>
                    </div>


                </div>

                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <div v-if="authStore.isAuthenticated" class="ml-3 relative">
                        <button
                            @click="showDropdown = !showDropdown"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                        >
                            <div>{{ authStore.user?.name }}</div>
                            <div class="ms-1">
                                <svg
                                    class="fill-current h-4 w-4"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </div>
                        </button>

                        <div
                            v-if="showDropdown"
                            @click="showDropdown = false"
                            class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10"
                        >
                            <div class="py-1">
                                <router-link
                                    to="/profile"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                >
                                    Perfil
                                </router-link>
                                <a
                                    href="#"
                                    @click.prevent="handleLogout"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                >
                                    Sair
                                </a>
                            </div>
                        </div>
                    </div>

                    <template v-else>
                        <router-link
                            to="/login"
                            class="inline-flex items-center text-gray-200 font-bold hover:text-gray-900 px-4 mr-7"
                        >
                            Entrar
                        </router-link>
                        <router-link
                            to="/register"
                            class="inline-flex items-center text-white font-bold rounded-lg border py-3 p-3 bg-[#0071ce] border-[#008cff] hover:bg-[#0176d6] px-[17px]"
                        >
                            Crie sua conta
                        </router-link>
                    </template>
                </div>

                <div class="-me-2 flex items-center sm:hidden">
                    <button
                        @click="showMobileMenu = !showMobileMenu"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                    >
                        <svg
                            class="h-6 w-6"
                            stroke="currentColor"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <path
                                v-if="!showMobileMenu"
                                class="inline-flex"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                            <path
                                v-else
                                class="inline-flex"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div v-if="showMobileMenu" class="sm:hidden bg-[#005da9]">
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="space-y-1">
                    <template v-if="authStore.isAuthenticated">
                        <router-link
                            to="/profile"
                            @click="showMobileMenu = false"
                            class="block px-4 py-2 text-base font-medium text-white hover:bg-[#004080]"
                        >
                            Perfil
                        </router-link>
                        <a
                            href="#"
                            @click.prevent="handleLogout"
                            class="block px-4 py-2 text-base font-medium text-white hover:bg-[#004080]"
                        >
                            Sair
                        </a>
                    </template>

                    <template v-else>
                        <router-link
                            to="/login"
                            @click="showMobileMenu = false"
                            class="block px-4 py-2 text-base font-medium text-white hover:bg-[#004080]"
                        >
                            Entrar
                        </router-link>
                        <router-link
                            to="/register"
                            @click="showMobileMenu = false"
                            class="block px-4 py-2 text-base font-medium text-white hover:bg-[#004080]"
                        >
                            Registrar
                        </router-link>
                    </template>
                </div>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import { useAuthStore } from "../stores/auth";

const authStore = useAuthStore();
const router = useRouter();
const route = useRoute();

const showDropdown = ref(false);
const showMobileMenu = ref(false);

const isActive = (path) => {
    return route.path === path || route.path.startsWith(path + "/");
};

const handleLogout = async () => {
    showDropdown.value = false;
    showMobileMenu.value = false;
    await authStore.logout();
    router.push("/login");
};
</script>
