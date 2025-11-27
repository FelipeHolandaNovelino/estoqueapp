<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Support\Facades\Response; 
use Illuminate\Database\Eloquent\Collection; // Necessário para a tipagem de Collection, opcionalmente

class ProdutoXmlController extends Controller
{
    /**
     * Gera e retorna os dados de todos os produtos no formato XML.
     *
     * @return \Illuminate\Http\Response
     */
    public function gerarXml()
    {
        // Otimização: Carrega os produtos e os dados do criador (User) em uma única consulta (Eager Loading)
        $produtos = Produto::with('user')->get();
        
        // 1. Renderiza a View Blade (que contém a estrutura XML)
        $view = view('produtos.xml', compact('produtos'))->render();
        
        // 2. Retorna a resposta HTTP, definindo o Content-Type como XML
        return Response::make($view, 200, [
            'Content-Type' => 'application/xml'
        ]);
    }
}