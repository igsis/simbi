<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Simbi\Http\Controllers\Controller;
use Simbi\Models\BibliotecasTematicas;
use Simbi\Models\Equipamento;

class BibliotecasTematicasController extends Controller
{
    public function index(Request $type)
    {
        $type = $type->type;
        $equipamentos = Equipamento::where('publicado', '=', '1')->orderBy('nome')->get();
        return view('acervo.listarEquipamentos', compact('equipamentos', 'type'));
    }

    public function create($id) {
        $equipamento = Equipamento::findOrFail($id);
        return view('acervo.bibliotecas_tematicas.cadastro', compact('equipamento'));
    }

    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'data' => 'required',
            'periodo' => 'required',
            'acervo' => 'required',
            'frequenciaSecao' => 'required',
            'consulta' => 'required',
            'emprestimo' => 'required'
        ]);

        $data = $request->data;
        $dt = explode('/', $data);
        $data = $dt[1].'-'.$dt[0].'-01'; //Dia 01 como default

        $dataAtual = date("Y-m-d"); //data de envio

        BibliotecasTematicas::create([
            'acervo' => $request->acervo,
            'frequencia_secao' => $request->frequenciaSecao,
            'consulta' => $request->consulta,
            'emprestimo' => $request->emprestimo,
            'total' => $request->total,
            'periodo' => $request->periodo,
            'data' => $data,
            'data_envio' => $dataAtual,
            'equipamento_id' => $id
        ]);

        return redirect()->route('consulta.relatorio', $id)
            ->with('flash_message', 'Registro de Biblioteca Temática realizado com sucesso!');
    }

    public function show ($id){
        $equipamentos = Equipamento::findOrFail($id);
        $bibliotecas =  DB::select('select  *, monthname(data)mes, year(data) ano from bibliotecas_tematicas where publicado <> 0');
        return view('acervo.bibliotecas_tematicas.index', compact('equipamentos', 'bibliotecas'));
    }

    public function edit ($idEquipamento, $idBiblioteca)
    {
        $equipamento = Equipamento::findOrFail($idEquipamento);
        $biblioteca = BibliotecasTematicas::findOrFail($idBiblioteca);
        return view('acervo.bibliotecas_tematicas.editar', compact('equipamento', 'biblioteca'));
    }

    public function update(Request $request, $id, $idBiblioteca)
    {
        $this->validate($request, [
            'data' => 'required',
            'periodo' => 'required',
            'acervo' => 'required',
            'frequenciaSecao' => 'required',
            'consulta' => 'required',
            'emprestimo' => 'required'
        ]);

        $data = $request->data;
        $dt = explode('/', $data);
        $data = $dt[1].'-'.$dt[0].'-01'; //Dia 01 como default

        $dataAtual = date("Y-m-d"); //data de envio

        BibliotecasTematicas::where('id', $idBiblioteca)
            ->update([
            'acervo' => $request->acervo,
            'frequencia_secao' => $request->frequenciaSecao,
            'consulta' => $request->consulta,
            'emprestimo' => $request->emprestimo,
            'total' => $request->total,
            'periodo' => $request->periodo,
            'data' => $data,
            'data_envio' => $dataAtual,
            'equipamento_id' => $id
        ]);

        return redirect()->route('consulta.relatorio', $id)
            ->with('flash_message', 'Registro de Bibliotecas Temáticas alterado com sucesso!');
    }

    public function destroy ($id, $idBiblioteca)
    {
        BibliotecasTematicas::where('id', $idBiblioteca)
            ->update([
                'publicado' => 0
            ]);

        return redirect()->route('consulta.relatorio', $id)
            ->with('flash_message', 'Registro de Bibliotecas Temáticas excluído com sucesso!');
    }
}
