<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Simbi\Http\Controllers\Controller;
use Simbi\Models\Equipamento;
use Simbi\Models\Matricula;

class MatriculaController extends Controller
{
    public function index(Request $type)
    {
        $type = $type->type;
        $equipamentos = Equipamento::where('publicado', '=', '1')->orderBy('nome')->get();
        return view('acervo.listarEquipamentos', compact('equipamentos', 'type'));
    }

    public function create($id) {
        $equipamento = Equipamento::findOrFail($id);
        return view('acervo.matricula.cadastro', compact('equipamento'));
    }

    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'data' => 'required',
            'periodo' => 'required',
            'nova' => 'required',
            'renovacao' => 'required'
        ]);

        $data = $request->data;
        $dt = explode('/', $data);
        $data = $dt[1].'-'.$dt[0].'-01'; //Dia 01 como default

        $dataAtual = date("Y-m-d"); //data de envio

        Matricula::create([
            'nova' => $request->nova,
            'renovacao' => $request->renovacao,
            'total' => $request->total,
            'periodo' => $request->periodo,
            'data' => $data,
            'data_envio' => $dataAtual,
            'equipamento_id' => $id
        ]);

        return redirect()->route('matricula.relatorio', $id)
            ->with('flash_message', 'Registro de Matrícula realizado com sucesso!');
    }

    public function show ($id){
        $equipamentos = Equipamento::findOrFail($id);
        $matriculas =  Matricula::where([
            ['publicado', '=', '1'],
            ['equipamento_id', '=', $id]])->orderBy('data')->get();
        return view('acervo.matricula.index', compact('equipamentos', 'matriculas'));
    }

    public function edit ($idEquipamento, $idMatriucla)
    {
        $equipamento = Equipamento::findOrFail($idEquipamento);
        $matricula = Matricula::findOrFail($idMatriucla);
        return view('acervo.matricula.editar', compact('equipamento', 'matricula'));
    }

    public function update(Request $request, $id, $idMatricula)
    {
        $this->validate($request, [
            'data' => 'required',
            'nova' => 'required',
            'renovacao' => 'required'
        ]);

        $data = $request->data;
        $dt = explode('/', $data);
        $data = $dt[1].'-'.$dt[0].'-01'; //Dia 01 como default

        $dataAtual = date("Y-m-d"); //data de envio

        Matricula::where('id', $idMatricula)
            ->update([
                'nova' => $request->nova,
                'renovacao' => $request->renovacao,
                'total' => $request->total,
                'periodo' => $request->periodo,
                'data' => $data,
                'data_envio' => $dataAtual,
                'equipamento_id' => $id
            ]);

        return redirect()->route('matricula.relatorio', $id)
            ->with('flash_message', 'Registro de Matrícula alterado com sucesso!');
    }

    public function destroy ($id, $idMatricula)
    {
        Matricula::where('id', $idMatricula)
            ->update([
                'publicado' => 0
            ]);

        return redirect()->route('matricula.relatorio', $id)
            ->with('flash_message', 'Registro de Matrícula excluído com sucesso!');
    }

    public function relatorio ($id)
    {
        $equipamento = Equipamento::findOrFail($id);

        return view('acervo.matricula.relatorio', compact('equipamento'));
    }
}
