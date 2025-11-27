<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ProdutoController extends Controller
{
    // --- LISTAGEM COM PESQUISA (READ) ---
    public function index(Request $request)
    {
        $query = Produto::query();

        if ($request->filled('search')) {
            $termo = $request->search;
            $query->where(function($q) use ($termo) {
                $q->where('nome', 'like', '%' . $termo . '%')
                  ->orWhere('descricao', 'like', '%' . $termo . '%');
            });
        }

        $produtos = $query->latest()->get();
        return view('produtos.index', compact('produtos')); 
    }

    // --- CRIAÇÃO (CREATE) ---
    public function create()
    {
        // Retorna a View sem a variável $categorias
        return view('produtos.create'); 
    }

    public function store(Request $request)
    {
        // 1. Sanitização Prévia
        $request->merge([
            'nome' => Str::title(trim($request->nome)),
            'descricao' => ucfirst(trim($request->descricao ?? '')),
        ]);

        // 2. Validação (Sem category_id)
        $validatedData = $request->validate([
            'nome' => [
                'required', 'string', 'max:150',
                Rule::unique('produtos')->where(function ($query) {
                    return $query->where('user_id', auth()->id());
                }),
            ],
            'descricao'          => 'nullable|string',
            'preco'              => 'required|numeric|min:0.01',
            'quantidade_estoque' => 'required|integer|min:0',
            'data_fabricacao'    => 'nullable|date',
        ]);

        $validatedData['ativo'] = $request->has('ativo');
        $validatedData['user_id'] = auth()->id(); 
        
        Produto::create($validatedData);
        
        return redirect()->route('produtos.index')->with('status', 'Produto criado com sucesso!');
    }

    // --- DETALHES (READ SINGLE) ---
    public function show(Produto $produto)
    {
        return view('produtos.show', compact('produto'));
    }

    // --- EDIÇÃO (UPDATE) ---
    public function edit(Produto $produto)
    {
        if (Gate::denies('update-produto', $produto)) {
            abort(403, 'Você não tem permissão para editar este produto.');
        }
        // Retorna a View sem a variável $categorias
        return view('produtos.edit', compact('produto'));
    }

    public function update(Request $request, Produto $produto)
    {
        if (Gate::denies('update-produto', $produto)) {
            abort(403, 'Você não tem permissão para atualizar este produto.');
        }

        // 1. Sanitização
        $request->merge([
            'nome' => Str::title(trim($request->nome)),
            'descricao' => ucfirst(trim($request->descricao ?? '')),
        ]);

        // 2. Validação (Sem category_id)
        $validatedData = $request->validate([
            'nome' => [
                'required', 'string', 'max:150',
                Rule::unique('produtos')->ignore($produto->id)->where(function ($query) {
                    return $query->where('user_id', auth()->id());
                }),
            ],
            'descricao'          => 'nullable|string',
            'preco'              => 'required|numeric|min:0.01',
            'adicionar_estoque'  => 'nullable|integer|min:0', 
            'data_fabricacao'    => 'nullable|date',
        ]);

        // 3. Lógica de SOMA DE ESTOQUE
        $valorAdicional = $request->input('adicionar_estoque', 0);
        $novoEstoque = $produto->quantidade_estoque + $valorAdicional;
        
        $validatedData['quantidade_estoque'] = $novoEstoque;
        unset($validatedData['adicionar_estoque']); 

        // 4. Outros campos
        $validatedData['ativo'] = $request->has('ativo');
        
        $produto->update($validatedData);
        
        return redirect()->route('produtos.index')->with('status', 'Produto atualizado! Estoque ajustado para: ' . $novoEstoque);
    }

    // --- EXCLUSÃO (DELETE) ---
    public function destroy(Produto $produto)
    {
        if (Gate::denies('update-produto', $produto)) {
            abort(403, 'Você não tem permissão para excluir este produto.');
        }

        $produto->delete();
        
        return redirect()->route('produtos.index')->with('status', 'Produto excluído permanentemente.');
    }
}