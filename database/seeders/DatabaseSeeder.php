<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Certifique-se de que esta linha está no topo

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. CRIAÇÃO DO SEU USUÁRIO (Proprietário dos Produtos)
        User::factory()->create([
            'name' => 'Holanda Warrior',
            'email' => 'holandawarrior@gmail.com', // SEU EMAIL
            'password' => bcrypt('12345678'), // USE UMA SENHA FÁCIL PARA TESTE
        ]);

        // 2. Criação do Usuário de Teste Padrão (ID 2)
        User::factory()->create([
            'name' => 'Teste Padrão',
            'email' => 'test@example.com',
        ]);
        
        // 3. Executa o Seeder de Produtos
        $this->call(ProdutoSeeder::class);
        // Note que o ProdutoSeeder usará o ID 1, que agora é o seu.
    }
}