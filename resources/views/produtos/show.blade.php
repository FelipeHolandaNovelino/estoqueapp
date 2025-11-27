<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-extrabold text-2xl text-gray-500 leading-tight flex items-center">
                <a href="{{ route('produtos.index') }}" class="mr-4 text-gray-400 hover:text-blue-700 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                Detalhes do Produto
            </h2>
            
            <div class="flex space-x-3">
                @can('update-produto', $produto)
                    <a href="{{ route('produtos.edit', $produto) }}" class="flex items-center bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-lg shadow-md transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 00 2 2h11a2 2 0 00 2-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        Editar
                    </a>
                    
                    <form method="POST" action="{{ route('produtos.destroy', $produto) }}" onsubmit="return confirm('Tem certeza?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="flex items-center bg-white border border-gray-300 text-red-600 hover:bg-red-50 font-bold py-2 px-4 rounded-lg shadow-sm transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Excluir
                        </button>
                    </form>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl border border-gray-200">
                
                <div class="px-8 py-6 border-b border-gray-200 bg-gray-50 flex justify-between items-start">
                    <div>
                        <h1 class="text-3xl font-extrabold text-black">{{ $produto->nome }}</h1>
                        <p class="text-sm text-gray-600 mt-1 font-mono font-bold">ID: {{ $produto->id }}</p>
                    </div>
                    <span class="px-4 py-2 rounded-lg text-sm font-bold {{ $produto->ativo ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800' }}">
                        {{ $produto->ativo ? 'Ativo' : 'Inativo' }}
                    </span>
                </div>

                <div class="p-8 grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="md:col-span-2 space-y-6">
                        <div>
                            <h3 class="text-sm font-bold text-blue-900 uppercase tracking-wider mb-2">Sobre o Produto</h3>
                            <div class="bg-blue-50 rounded-xl p-5 text-black font-medium leading-relaxed border border-blue-100">
                                {{ $produto->descricao ?: 'Sem descrição disponível.' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Criado em</h3>
                                <p class="text-black font-bold">{{ $produto->created_at->format('d/m/Y \à\s H:i') }}</p>
                            </div>
                            <div>
                                <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Última Atualização</h3>
                                <p class="text-black font-bold">{{ $produto->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-blue-900 rounded-xl p-6 text-center shadow-md">
                            <h3 class="text-blue-200 font-bold text-sm uppercase mb-2">Preço Unitário</h3>
                            <p class="text-4xl font-extrabold text-white">
                                R$ {{ number_format($produto->preco, 2, ',', '.') }}
                            </p>
                        </div>
                        <div class="bg-white rounded-xl p-6 border-2 border-gray-100 text-center">
                            <h3 class="text-gray-600 font-bold text-sm uppercase mb-2">Em Estoque</h3>
                            <p class="text-3xl font-extrabold text-black">{{ $produto->quantidade_estoque }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>