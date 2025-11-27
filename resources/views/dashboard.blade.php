<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

 <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-500 leading-tight">
                🚀 Visão Geral do Estoque
            </h2>
            <span class="text-sm text-gray-500">Atualizado em: {{ now()->format('d/m/Y H:i') }}</span>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                
                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500 flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm font-medium uppercase">Total de Itens</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalProdutos }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500 flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm font-medium uppercase">Valor Estimado</p>
                        <p class="text-2xl font-bold text-gray-800">R$ {{ number_format($valorTotalEstoque, 0, ',', '.') }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-purple-500 flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm font-medium uppercase">Produtos Ativos</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $produtosAtivos }}</p>
                    </div>
                </div>

                <div class="bg-indigo-600 rounded-xl shadow-lg p-6 text-white flex flex-col justify-center items-center hover:bg-indigo-700 transition cursor-pointer" onclick="window.location='{{ route('produtos.create') }}'">
                    <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    <span class="font-bold text-lg">+ Novo Produto</span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="bg-white p-6 rounded-xl shadow-sm lg:col-span-2">
                    <h3 class="text-lg font-bold text-gray-700 mb-4">📈 Crescimento do Estoque (Últimos Meses)</h3>
                    <div class="relative h-64 w-full">
                        <canvas id="estoqueChart"></canvas>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-700">Recentes</h3>
                        <a href="{{ route('produtos.index') }}" class="text-indigo-600 text-xs font-bold hover:underline">Ver Todos</a>
                    </div>
                    <div class="overflow-y-auto max-h-64">
                        <table class="w-full text-left border-collapse">
                            <tbody>
                                @forelse($ultimosProdutos as $produto)
                                    <tr class="border-b last:border-0 hover:bg-gray-50 transition">
                                        <td class="py-3 pl-2">
                                            <p class="text-sm font-bold text-gray-800">{{ $produto->nome }}</p>
                                            <p class="text-xs text-gray-400">{{ $produto->created_at->diffForHumans() }}</p>
                                        </td>
                                        <td class="py-3 text-right pr-2 text-sm font-bold text-green-600">
                                            R$ {{ number_format($produto->preco, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td class="text-gray-400 text-center py-4">Vazio</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-6 pt-4 border-t">
                        <a href="{{ route('produtos.xml') }}" target="_blank" class="flex items-center justify-center w-full py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition font-bold text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            Baixar Relatório XML
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        const ctx = document.getElementById('estoqueChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line', // Tipo do gráfico (linha)
            data: {
                labels: {!! json_encode($labels) !!}, // Meses vindos do PHP
                datasets: [{
                    label: 'Novos Produtos',
                    data: {!! json_encode($data) !!}, // Quantidades vindas do PHP
                    backgroundColor: 'rgba(79, 70, 229, 0.2)', // Cor de fundo (Indigo)
                    borderColor: 'rgba(79, 70, 229, 1)', // Cor da linha
                    borderWidth: 2,
                    tension: 0.4, // Curvatura da linha visual 
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false } // Esconde legenda para ficar limpo
                },
                scales: {
                    y: { beginAtZero: true, grid: { display: false } },
                    x: { grid: { display: false } }
                }
            }
        });
    </script>
</x-app-layout>