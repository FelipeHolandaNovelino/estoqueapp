<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<estoque versao="1.1" app="EstoqueApp">
    <cabecalho>
        <data_geracao>{{ now()->toIso8601String() }}</data_geracao>
        <total_produtos>{{ $produtos->count() }}</total_produtos>
    </cabecalho>
    
    <produtos>
    @foreach ($produtos as $produto)
        <produto uuid="{{ $produto->id }}">
            <nome>{{ $produto->nome }}</nome>
            <descricao>{{ $produto->descricao }}</descricao>
            
            <preco moeda="BRL">{{ number_format($produto->preco, 2, '.', '') }}</preco>
            
            <quantidade>
                <valor>{{ $produto->quantidade_estoque }}</valor>
                @if ($produto->quantidade_estoque < 10)
                    <alerta>REPOR_ESTOQUE</alerta>
                @endif
            </quantidade>
            
            <criador>
                <user_id>{{ $produto->user_id }}</user_id>
                <nome>{{ optional($produto->user)->name ?: 'Usuário Deletado' }}</nome>
            </criador>
            
            <status>
                <ativo>{{ $produto->ativo ? 'SIM' : 'NAO' }}</ativo>
                <data_criacao>{{ $produto->created_at->toIso8601String() }}</data_criacao>
                <data_atualizacao>{{ $produto->updated_at->toIso8601String() }}</data_atualizacao>
            </status>
        </produto>
    @endforeach
    </produtos>
</estoque>