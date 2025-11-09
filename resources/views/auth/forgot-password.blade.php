<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Esqueceu sua senha? Sem problema. Informe seu endereço de e-mail e enviaremos um link para redefinir sua senha e escolher uma nova.') }}
    </div>

    <!-- Status da Sessão -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Endereço de E-mail -->
        <div>
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />

            @if ($errors->has('email'))
                <p class="text-red-600 text-sm mt-2">
                    {{ $errors->first('email') == 'passwords.user' ? 'Este e-mail não está cadastrado' : $errors->first('email') }}
                </p>
            @endif

        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Enviar link para redefinir senha') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
