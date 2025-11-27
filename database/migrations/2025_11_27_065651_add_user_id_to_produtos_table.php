<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //  Schema::table para modificar uma tabela existente.
        Schema::table('produtos', function (Blueprint $table) {
            // 1. Adiciona a coluna 'user_id' como chave estrangeira.
            // foreignId cria uma coluna UNSIGNED BIGINT.
            $table->foreignId('user_id')
                  ->nullable() // Permite que o campo seja nulo temporariamente (se necessário)
                  ->constrained() // Cria a restrição de chave estrangeira com a tabela 'users'
                  ->after('id') // define a posição da coluna (depois do 'id')
                  ->onDelete('cascade'); // Se o usuário for deletado, os produtos dele também serão.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Em caso de rollback, removemos a chave estrangeira e, em seguida, a coluna.
        Schema::table('produtos', function (Blueprint $table) {
            // 1. Remove a restrição de chave estrangeira (necessário antes de remover a coluna)
            $table->dropConstrainedForeignId('user_id'); 
            
            // 2. Remove a coluna 'user_id'
            $table->dropColumn('user_id');
        });
    }
};