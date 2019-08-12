<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use phpDocumentor\Reflection\Types\Compound;
use Simbi\Http\Controllers\Controller;
use Simbi\Models\ContratacaoForma;
use Simbi\Models\Equipamento;
use Simbi\Models\Evento;
use Simbi\Models\EventoOcorrencia;
use Simbi\Models\EventosIgsis;
use Auth;
use Simbi\Models\Frequencia;
use Simbi\Models\OcorrenciasIgsis;
use Simbi\Models\ProjetoEspecial;
use Simbi\Models\TipoEvento;

class FrequenciaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isFunc']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = 1;
        $equipamentos = Equipamento::where('publicado', '=', '1')->orderBy('nome')->get();
        return view('frequencia.index', compact('equipamentos', 'type'));

    }

    public function cadastrarEvento($id)
    {
        $equipamento = Equipamento::where('igsis_id', $id)->firstOrFail();
        $projetoEspecial = ProjetoEspecial::where('publicado', 1)->orderBy('projetoEspecial')->get();
        $tipoEvento = TipoEvento::where('publicado', 1)->orderBy('tipo_evento')->get();
        $contratacao = ContratacaoForma::orderBy('forma_contratacao')->get();

        $igsis_evento_id = Evento::all()->pluck('igsis_evento_id')->last();

        return view('frequencia.cadastroEvento', compact('equipamento', 'projetoEspecial', 'tipoEvento', 'contratacao', 'igsis_evento_id'));
    }

    public function gravarEvento(Request $request, $igsis_id)
    {
        $this->validate($request, [
            'nome' => 'required',
            'tipoEvento' => 'required',
            'projetoEspecial' => 'required',
            'contratacao' => 'required'
        ]);

        Evento::create([
            'igsis_evento_id' => $request->igsis_evento_id,
            'nome_evento' => $request->nome,
            'tipo_evento_id' => $request->tipoEvento,
            'projeto_especial_id' => $request->projetoEspecial,
            'contratacao_forma_id' => $request->contratacao
        ]);

        $evento_igsis = $request->igsis_evento_id;

        return redirect()->route('eventos.cadastro.ocorrencia', ['equipamento_igsis' => $igsis_id, 'evento_igsis' => $evento_igsis]);
    }

    public function cadastrarOcorrencia($igsis_id, $igsis_evento_id)
    {
        $equipamento = Equipamento::where('igsis_id', $igsis_id)->firstOrFail();
        $evento = Evento::where('igsis_evento_id', $igsis_evento_id)->firstOrFail();

        return view('frequencia.cadastroOcorrencia', compact('equipamento', 'evento'));
    }

    public function gravaOcorrencia($igsis_id, $igsis_evento_id, Request $request)
    {
        $this->validate($request, [
            'data' => 'required',
            'hora' => 'required'
        ]);

        $dataFormulario= $request->data;
        $dtFormat = explode('/', $dataFormulario);
        $data = $dtFormat[2].'-'.$dtFormat[1].'-'.$dtFormat[0];

        EventoOcorrencia::create([
            'igsis_evento_id' => $igsis_evento_id,
            'igsis_id' => $igsis_id,
            'data' => $data,
            'horario' => $request->hora
        ]);

        return redirect()->route('frequencia.ocorrencias', [$igsis_id,1])->with('flash_message',
            'Ocorrência Inserida Com Sucesso!');
    }

    public function listarOcorrencias($igsis_id, $type)
    {
        $eventos = Evento::join('evento_ocorrencias', 'evento_ocorrencias.igsis_evento_id', 'eventos.igsis_evento_id', '')
            ->where([
                ['evento_ocorrencias.igsis_id', $igsis_id],
                ['evento_ocorrencias.publicado', $type]
            ])
            ->distinct('eventos.igsis_evento_id')
            ->orderBy('evento_ocorrencias.data', 'desc')
            ->get();


        $frequenciasCadastradas = Frequencia::all()->pluck('evento_ocorrencia_id')->toArray();

        $equipamento = Equipamento::where('igsis_id', $igsis_id)->firstOrFail();

        return view('frequencia.ocorrencias', compact('eventos', 'frequenciasCadastradas', 'equipamento', 'frequenciasCadastradas', 'type'));
    }

    public function editarOcorrencia($id)
    {
        $ocorrencia = EventoOcorrencia::findOrFail($id);

        $evento = Evento::where('igsis_evento_id', $ocorrencia->igsis_evento_id)->firstOrFail();

        return view('frequencia.editarOcorrencia', compact('ocorrencia', 'evento'));
    }

    public function listaEventos($igisis_id)
    {
        $eventosIgsis = EventosIgsis::where([
            ['publicado',1],
            ['idInstituicao',14],
            ['dataEnvio','>=','2019-06-01']
        ])->orderBy('nomeEvento')->get();
        $eventos = Evento::where('publicado', 1)->orderBy('nome_evento')->get();

        $equipamento = Equipamento::where('igsis_id', $igisis_id)->firstOrFail();

        return view('frequencia.listaEventos', compact('eventos', 'equipamento','eventosIgsis'));
    }

    public function uploadOcorrencia(Request $request, $id)
    {

        $ocorrencia = EventoOcorrencia::findOrFail($id);

        $this->validate($request, [
            'data' => 'required',
            'hora' => 'required'
        ]);
        $data = $request->data;
        $dt = explode('/', $data);
        $data = $dt[2].'-'.$dt[1].'-'.$dt[0];

        $ocorrencia->update([
            'data' => $data,
           'horario' => $request->hora
        ]);

       return redirect()->route('frequencia.ocorrencias', [$ocorrencia->igsis_id,1])
            ->with('flash_message', 'Ocorrência do Evento editada com sucesso!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $ocorrencia = EventoOcorrencia::findOrFail($id);

        $evento = Evento::where('igsis_evento_id', $ocorrencia->igsis_evento_id)->firstOrFail();

        $equipamento = Equipamento::where('igsis_id', $ocorrencia->igsis_id)->firstOrFail();

        $projetoEspecial = ProjetoEspecial::where('idProjetoEspecial', $evento->projeto_especial_id)->firstOrFail();

        return view('frequencia.cadastro', compact('equipamento', 'ocorrencia', 'evento', 'projetoEspecial'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'evento_ocorrencia_id' => 'required',
            'crianca' => 'required|integer|between: 0, 9999',
            'jovem' => 'required|integer|between: 0, 9999',
            'adulto' => 'required|integer|between: 0, 9999',
            'idoso' => 'required|integer|between: 0, 9999',
            'total' => 'required|integer|between: 0, 99999'
        ]);

        $user = Auth::user();

        $ocorrencia = EventoOcorrencia::findOrFail($request->evento_ocorrencia_id);

        $user->frequencias()->create([
            'evento_ocorrencia_id' => $request->evento_ocorrencia_id,
            'crianca' => $request->crianca,
            'jovem' => $request->jovem,
            'adulto' => $request->adulto,
            'idoso' => $request->idoso,
            'total' => $request->total,
            'observacao' => $request->observacao,
            'equipamento_id' => $id
        ]);

        return redirect()->route('frequencia.ocorrencias', $ocorrencia->igsis_id)->with('flash_message',
            'Frequência Inserida Com Sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function relatorio()
    {
        $type = 2;
        $equipamentos = Equipamento::where('publicado', '=', '1')->orderBy('nome')->get();
        return view('frequencia.index', compact('equipamentos', 'type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function listar($id)
    {
        $equipamento = Equipamento::findOrFail($id);

        $ocorrencia = EventoOcorrencia::where('igsis_id', $equipamento->igsis_id)->pluck('id', 'data', 'horario');

        return view('frequencia.listar', compact('equipamento', 'ocorrencia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function removeOcorrencia(Request $request)
    {
        $ocorrencia = EventoOcorrencia::findOrFail($request->input('id'));

        EventoOcorrencia::where('id', $request->input('id'))
            ->update([
                'publicado' => 0,
                'observacao' => $request->observacao
            ]);

        return redirect()->route('frequencia.ocorrencias', [$ocorrencia->igsis_id,1])
            ->with('flash_message',
                'Ocorrência do Evento Excluido com Sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function importarEventos()
    {
        $idEvento = 170;
        $eventos = EventosIgsis::where('idEvento', $idEvento);

        //$teste= EventosIgsis::all();

        dd($eventos);
    }

    public function editaFrequencia($id)
    {

//        $frequencia = Frequencia::where('evento_ocorrencia_id',$id)->get();
//        $ocorrencia = EventoOcorrencia::findOrFail($frequencia->evento_ocorrencia_id);
//
//        $evento = Evento::where('igsis_evento_id', $ocorrencia->igsis_evento_id)->firstOrFail();
//
//        $equipamento = Equipamento::where('igsis_id', $ocorrencia->igsis_id)->firstOrFail();

        $frequencia = ['categoriaEvento' => 'Contação de histórias', 'projetoEspecial' => 'Baú de Histórias', 'crianca' => '20', 'jovem' => '5', 'adulto' => '5', 'idoso' => '0', 'Observacao' => 'Teste'];

        return view('frequencia.editar', compact('frequencia'));

    }

    public function enviarFrequencia(Request $request)
    {

        $ocorrencia = EventoOcorrencia::findOrFail($request->input('id'));

        EventoOcorrencia::where('id', $request->input('id'))
            ->update([
                'publicado' => 2
            ]);

        return redirect()->route('frequencia.ocorrencias', $ocorrencia->igsis_id)
            ->with('flash_message',
                'Ocorrência do Enviada com Sucesso.');

    }

    public function frequenciasEnviadas(Request $types)
    {
        $type = $types->type;
        $equipamentos = Equipamento::where('publicado', '=', '1')->orderBy('nome')->get();
        return view('frequencia.listarEquipamentos', compact('equipamentos', 'type'));
    }

    public function listarFrequenciasEnviadas($id)
    {
        $frequencias = Frequencia::where('equipamento_id', $id)->get();
        return view('frequencia.listarFrequenciasEnviadas', compact('frequencias'));
    }

    public function listaEquipamentos()
    {
        $equipamentos = Equipamento::where('publicado', '=', '1')->orderBy('nome')->get();
        return view('frequencia.loteEquipamentos', compact('equipamentos'));
    }

}
