<?php

namespace App\Providers;

use App\Models\Produto;
use App\Models\User;
use Illuminate\Support\Facades\Gate; // Importa a Facade Gate
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Define o Gate para a autorização (ACL).
        // Isso checa se o ID do usuário logado é igual ao user_id do produto.
        Gate::define('update-produto', function (User $user, Produto $produto) {
            // Retorna TRUE se o usuário logado for o criador do produto
            return $user->id === $produto->user_id;
        });
    }
}