@php

    function friendlyError($key) {
        $map = [
            'current_password' => 'A senha atual está incorreta.',
            'password' => 'A nova senha é obrigatória e deve ter pelo menos 8 caracteres.',
            'password_confirmation' => 'A confirmação da senha não confere.',
            'validation.required' => 'O campo é obrigatório.',
            'validation.min.string' => 'O campo precisa ter mais caracteres.',
            'validation.confirmed' => 'Os campos não conferem.'
        ];

        return $map[$key] ?? $key; 
    }
@endphp

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Atualizar Senha
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Certifique-se de usar uma senha longa e segura para proteger sua conta.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        @php $bag = $errors->updatePassword ?? collect(); @endphp

        <!-- Senha Atual -->
        <div>
            <x-input-label for="update_password_current_password" value="Senha atual" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            @if ($bag->has('current_password'))
                <p class="mt-2 text-red-600 text-sm">
                    {{ friendlyError('current_password') }}
                </p>
            @endif
        </div>

        <div>
            <x-input-label for="update_password_password" value="Nova senha" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            @if ($bag->has('password'))
                <p class="mt-2 text-red-600 text-sm">
                    {{ friendlyError('password') }}
                </p>
            @endif
        </div>

 
        <div>
            <x-input-label for="update_password_password_confirmation" value="Confirmar nova senha" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            @if ($bag->has('password_confirmation'))
                <p class="mt-2 text-red-600 text-sm">
                    {{ friendlyError('password_confirmation') }}
                </p>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Salvar</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >Salvo.</p>
            @endif
        </div>
    </form>
</section>
