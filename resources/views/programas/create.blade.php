<x-app-layout>
    <div class="max-w-xl mx-auto mt-10 bg-white shadow p-6 rounded">
        @php
            session()->forget('success');
            session()->forget('error');
        @endphp
        <h1 class="text-xl font-bold mb-4">Criar Notícias</h1>

        <form method="POST" action="{{ route('programas.store') }}">
            @csrf

            <div class="mb-3">
                <label class="block font-medium">Nome</label>
                <input type="text" name="nome" class="border w-full p-2 rounded" required>
            </div>

            <div class="mb-3">
                <label class="block font-medium">Descrição</label>
                <textarea name="descricao" class="border w-full p-2 rounded" required></textarea>
            </div>

            <div class="mb-3">
                <label class="block font-medium">Categoria</label>
                <input type="text" name="categoria" class="border w-full p-2 rounded" required>
            </div>

            <div class="mb-3">
                <label class="block font-medium">Link Oficial</label>
                <input type="text" name="link_oficial" class="border w-full p-2 rounded">
            </div>

            <div class="text-end mt-4">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Criar
                </button>
            </div>

        </form>
    </div>
</x-app-layout>
