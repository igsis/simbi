<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Simbi\Http\Controllers\Controller;
use Simbi\Models\Equipamento;

class ConsultaController extends Controller
{
    public function index(Request $type)
    {
        $type = $type->type;
        $equipamentos = Equipamento::where('publicado', '=', '1')->orderBy('nome')->get();
        return view('acervo.listarEquipamentos', compact('equipamentos', 'type'));
    }

    public function create($id) {
        $equipamento = Equipamento::findOrFail($id);
        return view('acervo.consulta.cadastroConsulta', compact('equipamento'));
    }
}
