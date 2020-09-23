<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Simbi\Http\Controllers\Controller;
use Simbi\Models\Emprestimo;
use Simbi\Models\Equipamento;

class EmprestimoController extends Controller
{
    public function index(Request $type)
    {
        $type = $type->type;
        $equipamentos = Equipamento::where('publicado', '=', '1')->orderBy('nome')->get();
        return view('acervo.listarEquipamentos', compact('equipamentos', 'type'));
    }

    public function create ($id)
    {
        $equipamento = Equipamento::findOrFail($id);
        return view('acervo.emprestimo.cadastro', compact('equipamento'));
    }

    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'data' => 'required',
            'audioVisual' => 'required',
            'livro' => 'required',
            'manga' => 'required',
            'revista' => 'required',
            'suportes' => 'required',
            'total' => 'required',
            'periodo' => 'required'
        ]);

        $data = $request->data;
        $dt = explode('/', $data);
        $data = $dt[1].'-'.$dt[0].'-01'; //Dia 01 como default

        $dataAtual = date("Y-m-d"); //data de envio

        Emprestimo::create([
            'audio_visual' => $request->audioVisual,
            'livro' => $request->livro,
            'manga' => $request->manga,
            'revista' => $request->revista,
            'suportes' => $request->suportes,
            'total' => $request->total,
            'periodo' => $request->periodo,
            'data' => $data,
            'data_envio' => $dataAtual,
            'equipamento_id' => $id
        ]);

        return redirect()->route('emprestimo.relatorio', $id)
            ->with('flash_message', 'Registro de Empréstimo realizado com sucesso!');
    }

    public function edit ($idEquipamento, $idEmprestimo)
    {
        $equipamento = Equipamento::findOrFail($idEquipamento);
        $emprestimo = Emprestimo::findOrFail($idEmprestimo);
        return view('acervo.emprestimo.editar', compact('equipamento', 'emprestimo'));
    }

    public function update(Request $request, $id, $idEmprestimo)
    {
        $this->validate($request, [
            'data' => 'required',
            'audioVisual' => 'required',
            'livro' => 'required',
            'manga' => 'required',
            'revista' => 'required',
            'suportes' => 'required',
            'total' => 'required',
            'periodo' => 'required'
        ]);

        $data = $request->data;
        $dt = explode('/', $data);
        $data = $dt[1].'-'.$dt[0].'-01'; //Dia 01 como default

        $dataAtual = date("Y-m-d"); //data de envio

        Emprestimo::where('id', $idEmprestimo)
            ->update([
                'audio_visual' => $request->audioVisual,
                'livro' => $request->livro,
                'manga' => $request->manga,
                'revista' => $request->revista,
                'suportes' => $request->suportes,
                'total' => $request->total,
                'periodo' => $request->periodo,
                'data' => $data,
                'data_envio' => $dataAtual,
                'equipamento_id' => $id
            ]);

        return redirect()->route('emprestimo.relatorio', $id)
            ->with('flash_message', 'Registro de Empréstimo alterado com sucesso!');
    }

    public function show ($id){
        $equipamentos = Equipamento::findOrFail($id);
        $emprestimos =  Emprestimo::where([
            ['publicado', '=', '1'],
            ['equipamento_id', '=', $id]])->orderBy('data')->get();
        return view('acervo.emprestimo.index', compact('equipamentos', 'emprestimos'));
    }

    public function destroy ($id, $idEmprestimo)
    {
        Emprestimo::where('id', $idEmprestimo)
            ->update([
                'publicado' => 0
            ]);

        return redirect()->route('emprestimo.relatorio', $id)
            ->with('flash_message', 'Registro de Empréstimo excluído com sucesso!');
    }

    public function relatorio ($id)
    {
        $equipamento = Equipamento::findOrFail($id);

        return view('acervo.emprestimo.relatorio', compact('equipamento'));
    }
}
