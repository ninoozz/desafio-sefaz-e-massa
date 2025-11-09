<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Programas
        </h2>
    </x-slot>
    
    <div class="py-6">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-4">
                

                @auth
                    <a href="{{ route('programas.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Criar Nova Notícia</a>
                @endauth

                <ul class="space-y-4 ">
                    @foreach($programas as $p)
                        <li class="border rounded p-4">
                            <div class="font-bold text-lg">{{ $p->nome }}</div>
                            <div>{{ $p->descricao }}</div>
                            <div class="text-sm text-gray-500">Categoria: {{ $p->categoria }}</div>
                            <div>
                                Link:
                                <a href="{{ $p->link_oficial }}" target="_blank" class="text-blue-500 underline">
                                    {{ $p->link_oficial }}
                                </a>
                            </div>

                            @auth
                                <form action="{{ route('programas.destroy', $p->id) }}" method="POST" class="inline-block mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded">Excluir</button>
                                </form>
                            @endauth
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
</x-app-layout>
