<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-gray-500 leading-tight flex items-center">
            <a href="{{ route('produtos.index') }}" class="mr-4 text-gray-400 hover:text-blue-700 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            Novo Produto
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('produtos.store') }}">
                @csrf
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl border border-gray-200">
                    
                    <div class="px-8 py-6 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
                        <h3 class="text-black font-extrabold text-lg">Preencha os Dados</h3>
                    </div>

                    <div class="p-8 space-y-6">
                        <div>
                            <x-input-label for="nome" :value="__('Nome do Produto')" class="font-extrabold !text-black text-base" />
                            <x-text-input id="nome" name="nome" type="text" class="mt-2 block w-full border-gray-300 focus:border-blue-600 focus:ring-blue-600 rounded-lg shadow-sm text-black font-medium" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('nome')" />
                        </div>

                        <div>
                            <x-input-label for="descricao" :value="__('Descrição')" class="font-extrabold !text-black text-base" />
                            <textarea id="descricao" name="descricao" rows="3" class="mt-2 block w-full border-gray-300 focus:border-blue-600 focus:ring-blue-600 rounded-lg shadow-sm text-black font-medium"></textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('descricao')" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 border-t border-gray-100 pt-6">
                            <div>
                                <x-input-label for="preco" :value="__('Preço (R$)')" class="font-extrabold !text-black text-base" />
                                <x-text-input id="preco" name="preco" type="number" step="0.01" class="mt-2 block w-full rounded-lg text-black font-medium" required />
                                <x-input-error class="mt-2" :messages="$errors->get('preco')" />
                            </div>
                            <div>
                                <x-input-label for="quantidade_estoque" :value="__('Quantidade')" class="font-extrabold !text-black text-base" />
                                <x-text-input id="quantidade_estoque" name="quantidade_estoque" type="number" class="mt-2 block w-full rounded-lg text-black font-medium" required />
                                <x-input-error class="mt-2" :messages="$errors->get('quantidade_estoque')" />
                            </div>
                            <div>
                                <x-input-label for="data_fabricacao" :value="__('Data')" class="font-extrabold !text-black text-base" />
                                <x-text-input id="data_fabricacao" name="data_fabricacao" type="date" class="mt-2 block w-full rounded-lg text-black font-medium" />
                                <x-input-error class="mt-2" :messages="$errors->get('data_fabricacao')" />
                            </div>
                        </div>

                        <div class="flex items-center bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <input id="ativo" name="ativo" type="checkbox" checked class="rounded border-gray-300 text-blue-700 shadow-sm focus:ring-blue-600 h-5 w-5">
                            <label for="ativo" class="ml-3 text-sm font-extrabold !text-black">Produto Ativo no Sistema</label>
                        </div>
                    </div>

                    <div class="px-8 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-end space-x-3">
                        <a href="{{ route('produtos.index') }}" class="text-gray-600 hover:text-black font-bold px-4 py-2 transition">Cancelar</a>
                        <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-6 rounded-lg shadow-md transition transform hover:scale-105">
                            Salvar Produto
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>