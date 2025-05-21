@extends('layouts.app')

@section('content')
<h1>Alimentos com validade próxima (até 7 dias)</h1>

<ul>
@forelse($alimentos as $alimento)
    <li>{{ $alimento->nome }} - Validade: {{ $alimento->validade }}</li>
@empty
    <li>Nenhum alimento com validade próxima.</li>
@endforelse
</ul>
@endsection
