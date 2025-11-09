<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased flex">

        <div class="min-h-screen flex flex-col items-center pt-28 bg-[#005da9] w-1/2">
            
            <div>
                <a href="/">
                    <x-application-logo-large class="fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

                @if(request()->routeIs('login'))
                    <h2 class="text-black text-xl font-semibold mb-5 text-center mt-4">Fazer login</h2>
                @endif

                @if(request()->routeIs('register'))
                    <h2 class="text-black text-xl font-semibold mb-5 text-center mt-4">Crie sua conta</h2>
                @endif

                {{ $slot }}
            </div>

        </div>

        <div class="relative w-1/2 h-screen">
            <img src="{{ asset('images/login-imagem.png') }}" class="w-full h-full object-cover" alt="">
        </div>

    </body>
</html>
