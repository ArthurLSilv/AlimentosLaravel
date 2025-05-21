@extends('layouts.app')

@section('content')
<h1>Lista de Alimentos</h1>

@if(session('sucesso'))
<p style="color: green;">{{ session('sucesso') }}</p>
@endif

@if($estoqueBaixo->count())
<div style="color: red;">
    <strong>Atenção! Alimentos com estoque baixo:</strong>
    <ul>
        @foreach($estoqueBaixo as $item)
            <li>{{ $item->nome }} - Quantidade: {{ $item->quantidade }}</li>
        @endforeach
    </ul>
</div>
@endif

<a href="{{ route('alimentos.create') }}">Adicionar Novo Alimento</a>
<a href="{{ route('alimentos.validade_proxima') }}">Ver Validade Próxima</a>

<ul>
@foreach($alimentos as $alimento)
    <li>
        <strong>{{ $alimento->nome }}</strong> - 
        Quantidade: {{ $alimento->quantidade }} - 
        Validade: {{ $alimento->validade ?? 'Sem validade' }} - 
        Categoria: {{ $alimento->categoria->nome ?? 'Sem categoria' }}

        <a href="{{ route('alimentos.edit', $alimento) }}">Editar</a>

        <form action="{{ route('alimentos.destroy', $alimento) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Excluir</button>
        </form>
    </li>
@endforeach
</ul>
@endsection
