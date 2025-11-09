<x-app-layout>
    <div class="max-w-xl mx-auto mt-14 bg-white shadow-lg p-8 rounded-xl">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-center">Editar Notícia</h1>
            <form method="POST" action="{{ route('programas.destroy', $programa->id) }}" class="flex justify-start mt-4">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg transition">
                    X
                </button>
         </form>



        </div>

        {{-- Form de update --}}
        <form method="POST" action="{{ route('programas.update', $programa->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-medium">Nome</label>
                <input type="text" name="nome" value="{{ $programa->nome }}" class="border w-full p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Descrição</label>
                <textarea name="descricao" class="border w-full p-2 rounded" required>{{ $programa->descricao }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Categoria</label>
                <input type="text" name="categoria" value="{{ $programa->categoria }}" class="border w-full p-2 rounded" required>
            </div>

            <div class="mb-8">
                <label class="block font-medium">Link Oficial</label>
                <input type="text" name="link_oficial" value="{{ $programa->link_oficial }}" class="border w-full p-2 rounded">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-gray-900 hover:bg-gray-800 text-white px-5 py-2 rounded-lg transition">
                    Salvar
                </button>
            </div>
        </form>


    </div>
</x-app-layout>
