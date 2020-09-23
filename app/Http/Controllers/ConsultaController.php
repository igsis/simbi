<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Simbi\Http\Controllers\Controller;
use Simbi\Models\Consulta;
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

    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'data' => 'required',
            'audioVisual' => 'required',
            'jornal' => 'required',
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

        Consulta::create([
            'audio_visual' => $request->audioVisual,
            'jornal' => $request->jornal,
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

        return redirect()->route('consulta.relatorio', $id)
            ->with('flash_message', 'Registro de Consulta realizado com sucesso!');
    }

    public function show ($id){
        $equipamentos = Equipamento::findOrFail($id);
        $consultas =  Consulta::where([
            ['publicado', '=', '1'],
            ['equipamento_id', '=', $id]])->orderBy('data')->get();
        return view('acervo.consulta.index', compact('equipamentos', 'consultas'));
    }

    public function edit ($idEquipamento, $idConsulta)
    {
        $equipamento = Equipamento::findOrFail($idEquipamento);
        $consulta = Consulta::findOrFail($idConsulta);
        return view('acervo.consulta.editar', compact('equipamento', 'consulta'));
    }

    public function update(Request $request, $id, $idConsulta)
    {
        $this->validate($request, [
            'data' => 'required',
            'audioVisual' => 'required',
            'jornal' => 'required',
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

        Consulta::where('id', $idConsulta)
            ->update([
                'audio_visual' => $request->audioVisual,
                'jornal' => $request->jornal,
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

        return redirect()->route('consulta.relatorio', $id)
            ->with('flash_message', 'Registro de Consulta alterado com sucesso!');
    }

    public function destroy ($id, $idConsulta)
    {
        Consulta::where('id', $idConsulta)
            ->update([
                'publicado' => 0
            ]);

        return redirect()->route('consulta.relatorio', $id)
            ->with('flash_message', 'Registro de Consulta excluído com sucesso!');
    }

    public function relatorio ($id)
    {
        $equipamento = Equipamento::findOrFail($id);

        return view('acervo.consulta.relatorio', compact('equipamento'));
    }
}
