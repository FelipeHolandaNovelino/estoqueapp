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
    Schema::create('produtos', function (Blueprint $table) {
        // Requisito: Chave Primária Universal (UUID)
        $table->uuid('id')->primary(); 
        
        // Requisito: 5+ Campos e 3+ Tipos de Dados
        $table->string('nome', 150); 
        $table->text('descricao')->nullable(); 
        $table->decimal('preco', 10, 2); 
        $table->integer('quantidade_estoque'); 
        $table->date('data_fabricacao'); 
        $table->boolean('ativo')->default(true); 
        
        // Campos Padrão
        $table->timestamps(); 
    });
}
};
