<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alimento;
use App\Models\Categoria;

class AlimentoController extends Controller
{
    public function index()
    {
        $alimentos = Alimento::with('categoria')->get();
        $estoqueBaixo = Alimento::where('quantidade', '<', 5)->get();

        return view('alimentos.index', compact('alimentos', 'estoqueBaixo'));
    }

    public function validadeProxima()
    {
        $hoje = now();
        $limite = now()->addDays(7);

        $alimentos = Alimento::whereBetween('validade', [$hoje, $limite])->get();

        return view('alimentos.validade_proxima', compact('alimentos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('alimentos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'quantidade' => 'required|integer',
            'validade' => 'nullable|date',
            'categoria_id' => 'nullable|exists:categorias,id',
        ]);

        Alimento::create($request->all());

        return redirect()->route('alimentos.index')->with('sucesso', 'Alimento adicionado!');
    }

    public function edit(Alimento $alimento)
    {
        $categorias = Categoria::all();
        return view('alimentos.edit', compact('alimento', 'categorias'));
    }

    public function update(Request $request, Alimento $alimento)
    {
        $request->validate([
            'nome' => 'required',
            'quantidade' => 'required|integer',
            'validade' => 'nullable|date',
            'categoria_id' => 'nullable|exists:categorias,id',
        ]);

        $alimento->update($request->all());

        return redirect()->route('alimentos.index')->with('sucesso', 'Alimento atualizado!');
    }

    public function destroy(Alimento $alimento)
    {
        $alimento->delete();

        return redirect()->route('alimentos.index')->with('sucesso', 'Alimento removido!');
    }
}
