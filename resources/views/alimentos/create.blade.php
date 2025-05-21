@extends('layouts.app')

@section('content')
<h1>Adicionar Alimento</h1>

<form action="{{ route('alimentos.store') }}" method="POST">
    @csrf
    <input type="text" name="nome" placeholder="Nome" required>
    <input type="number" name="quantidade" placeholder="Quantidade" required>
    <input type="date" name="validade">

    <select name="categoria_id">
        <option value="">Selecione uma categoria</option>
        @foreach($categorias as $categoria)
            <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
        @endforeach
    </select>

    <button type="submit">Salvar</button>
</form>
@endsection
