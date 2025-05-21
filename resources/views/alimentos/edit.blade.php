@extends('layouts.app')

@section('content')
<h1>Editar Alimento</h1>

<form action="{{ route('alimentos.update', $alimento) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="nome" value="{{ $alimento->nome }}" required>
    <input type="number" name="quantidade" value="{{ $alimento->quantidade }}" required>
    <input type="date" name="validade" value="{{ $alimento->validade }}">

    <select name="categoria_id">
        <option value="">Selecione uma categoria</option>
        @foreach($categorias as $categoria)
            <option value="{{ $categoria->id }}" {{ $alimento->categoria_id == $categoria->id ? 'selected' : '' }}>
                {{ $categoria->nome }}
            </option>
        @endforeach
    </select>

    <button type="submit">Atualizar</button>
</form>
@endsection
