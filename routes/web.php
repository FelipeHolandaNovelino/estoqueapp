<?php

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProdutoXmlController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Necessário para lógica do Dashboard
use Carbon\Carbon;

// --- ROTA RAIZ (PÁGINA INICIAL) ---
Route::get('/', function () {
    // Redireciona usuários logados para o dashboard, senão para o login.
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login'); 
});

// --- ROTA DASHBOARD (COM DADOS PARA GRÁFICOS) ---
Route::get('/dashboard', function () {
    $totalProdutos = App\Models\Produto::count();
    $valorTotalEstoque = App\Models\Produto::sum(DB::raw('preco * quantidade_estoque'));
    $produtosAtivos = App\Models\Produto::where('ativo', true)->count();
    
    // Lógica para dados do gráfico (últimos 6 meses)
    $graficoDados = App\Models\Produto::select(
            DB::raw('strftime("%m", created_at) as mes'),
            DB::raw('count(*) as total')
        )
        ->where('created_at', '>=', Carbon::now()->subMonths(6))
        ->groupBy('mes')
        ->orderBy('mes')
        ->pluck('total', 'mes');

    $labels = $graficoDados->keys()->map(fn($mes) => Carbon::createFromFormat('m', $mes)->format('F'));
    $data = $graficoDados->values();
    $ultimosProdutos = App\Models\Produto::latest()->take(5)->get();


    return view('dashboard', compact(
        'totalProdutos', 'valorTotalEstoque', 'produtosAtivos', 'ultimosProdutos',
        'labels', 'data'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

// --- GRUPO DE ROTAS PROTEGIDAS (AUTH) ---
Route::middleware(['auth'])->group(function () {
    
    // FUNCIONALIDADE AVANÇADA: Rota XML DEVE SER A PRIMEIRA para evitar conflito com o resource {id}
    Route::get('produtos/xml', [ProdutoXmlController::class, 'gerarXml'])
        ->name('produtos.xml');

    // CRUD: Rotas de Recurso (index, store, update, destroy, etc.)
    Route::resource('produtos', ProdutoController::class);

    // Rotas Padrão de Perfil do Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';