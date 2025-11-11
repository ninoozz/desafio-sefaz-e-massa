<template>
    <div class="w-full flex h-screen">
        <div
            class="min-h-screen w-1/2 flex-1 flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#005da9]"
        >
            <div class="mb-8">
                <router-link to="/">
                    <img
                        src="/images/logo.png"
                        alt="SEFAZ - Secretaria de Estado da Fazenda de Alagoas"
                        class="h-32 w-auto object-contain"
                    />
                </router-link>
            </div>

            <div
                class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
            >
                <h1
                    class="text-black text-xl font-semibold mb-5 text-center mt-4"
                >
                    {{ pageTitle }}
                </h1>
                <slot />
            </div>
        </div>
        <img
            src="/images/login-imagem.png"
            alt="SEFAZ - Secretaria de Estado da Fazenda de Alagoas"
            class="w-1/2 h-screen object-cover"
        />
    </div>
</template>

<script setup>
import { computed } from "vue";
import { useRoute } from "vue-router";

const route = useRoute();

const pageTitle = computed(() => {
    if (route.path === "/login") {
        return "Fazer Login";
    } else if (route.path === "/register") {
        return "Criar Conta";
    }
    return "";
});
</script>
