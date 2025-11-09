<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="icon" href="{{ asset('images/logo-sem-nome.png') }}" type="image/png">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>


    <body class="font-sans antialiased bg-gray-100 min-h-screen flex flex-col">
        
        @include('layouts.navigation')

        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header ?? '' }} 
                </div>
            </header>
        @endisset

        <main class="flex-grow">
            {{ $slot }}
        </main>

            <footer class="w-full py-8 bg-[#005da9] text-white border-t border-gray-600">
                <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between gap-10 text-sm">

                    <div class="flex items-center space-x-3">
                        <x-application-logo class="h-10 w-auto fill-current text-white" />
                        <div>
                            <h1 class="font-bold text-white">SEFAZ</h1>
                            <h2 class="font-semibold text-white text-xs">Secretaria de Estado da Fazenda de Alagoas</h2>
                        </div>
                    </div>

                    <div>
                        <p class="font-semibold">Links SEFAZ AL</p>
                        <ul class="mt-2 space-y-1">
                            <li><a href="https://sefaz.al.gov.br" target="_blank" class="underline">Site Oficial</a></li>
                            <li><a href="https://sefaz.al.gov.br/ipva" target="_blank" class="underline">Consulta IPVA</a></li>
                            <li><a href="https://sefaz.al.gov.br/servicos" target="_blank" class="underline">Serviços Online</a></li>
                            <li><a href="https://sefaz.al.gov.br/nfe" target="_blank" class="underline">NF-e</a></li>
                        </ul>
                    </div>

                    <div>
                        <p class="font-semibold">Governo de Alagoas</p>
                        <ul class="mt-2 space-y-1">
                            <li><a href="https://alagoas.al.gov.br" target="_blank" class="underline">Portal Oficial AL</a></li>
                            <li><a href="https://transparencia.al.gov.br" target="_blank" class="underline">Transparência</a></li>
                            <li><a href="https://ouvidoria.al.gov.br" target="_blank" class="underline">Ouvidoria</a></li>
                        </ul>
                    </div>

                    <div>
                        <p class="font-semibold">Sistema Interno</p>
                        <ul class="mt-2 space-y-1">
                            <li><a href="{{ route('dashboard') }}" class="underline">Dashboard</a></li>
                            <li><a href="{{ route('profile.edit') }}" class="underline">Perfil</a></li>
                            <li>
                                <a href="{{ route('logout') }}" class="underline"
                                onclick="event.preventDefault(); document.getElementById('logout-form-footer').submit();">
                                    Sair
                                </a>
                            </li>
                        </ul>
                        <form id="logout-form-footer" method="POST" action="{{ route('logout') }}" class="hidden">@csrf</form>
                    </div>

                </div>

                <div class="text-center text-xs text-white mt-6 opacity-80">
                    © {{ date('Y') }} SEFAZ AL - DESAFIO SEFAZ É MASSA
                </div>
            </footer>


    </body>
</html>
