<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
use Simbi\Models\FrequenciasPortaria;
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
        return view('frequencia.frequencia.index', compact('equipamentos', 'type'));

    }


    public function cadastrarOcorrencia($equipamento_id, $evento_id)
    {
        $equipamento = Equipamento::where('id', $equipamento_id)->firstOrFail();
        $evento = Evento::findOrFail($evento_id);

        return view('frequencia.frequencia.cadastroOcorrencia', compact('equipamento', 'evento'));
    }

    public function gravaOcorrencia($equipamento_id, $evento_id, Request $request)
    {

        $this->validate($request, [
            'data' => 'required',
            'hora' => 'required|date_format:H:i'
        ]);

        $dataFormulario= $request->data;
        $dtFormat = explode('/', $dataFormulario);
        $data = $dtFormat[2].'-'.$dtFormat[1].'-'.$dtFormat[0];


        //Obter período da ocorrência
        //1- Segunda à Sexta
        //2-Sábado
        //3-Domingo
        $unixTimestamp = strtotime($data);
        $dia = date("w", $unixTimestamp);
        if ($dia == 0)// domingo
            $periodo = 3;
        elseif ($dia == 6)//sabado
            $periodo = 2;
        else
            $periodo = 1;

        EventoOcorrencia::create([
            'igsis_evento_id' => $evento_id,
            'igsis_id' => $equipamento_id,
            'data' => $data,
            'horario' => $request->hora,
            'periodo' => $periodo
        ]);

        return redirect()->route('frequencia.ocorrencias', [$equipamento_id,1])->with('flash_message',
            'Ocorrência Inserida Com Sucesso!');
    }

    public function listarOcorrencias($igsis_id, $type)
    {

        $eventos = Evento::join('evento_ocorrencias', 'evento_ocorrencias.igsis_evento_id', 'eventos.id', '')
            ->where([
                ['evento_ocorrencias.igsis_id', $igsis_id],
                ['evento_ocorrencias.publicado', $type]
            ])
            ->distinct('eventos.igsis_evento_id')
            ->orderBy('evento_ocorrencias.data', 'desc')
            ->get();


        $frequenciasCadastradas = Frequencia::all()->pluck('evento_ocorrencia_id')->toArray();

        $equipamento = Equipamento::where('id', $igsis_id)->firstOrFail();

        return view('frequencia.frequencia.ocorrencias', compact('eventos', 'frequenciasCadastradas', 'equipamento', 'frequenciasCadastradas', 'type','igsis_id'));
    }

    public function listarOcorrenciasEnviadas($igsis_id, $type)
    {
        $eventos = Evento::join('evento_ocorrencias', 'evento_ocorrencias.igsis_evento_id', 'eventos.id', '')
            ->join('frequencias', 'frequencias.evento_ocorrencia_id', 'evento_ocorrencias.id', '')
            ->where([
                ['evento_ocorrencias.igsis_id', $igsis_id],
                ['evento_ocorrencias.publicado', $type]
            ])
            ->distinct('eventos.igsis_evento_id')
            ->orderBy('evento_ocorrencias.data', 'desc')
            ->get();

        $frequenciasCadastradas = Frequencia::all()->pluck('evento_ocorrencia_id')->toArray();

        $equipamento = Equipamento::where('id', $igsis_id)->firstOrFail();

        return view('frequencia.frequencia.ocorrenciasEnviadas', compact('eventos', 'frequenciasCadastradas', 'equipamento', 'frequenciasCadastradas', 'type','igsis_id'));
    }


    public function editarOcorrencia($id)
    {
        $ocorrencia = EventoOcorrencia::findOrFail($id);
        $evento = Evento::where('id', $ocorrencia->igsis_evento_id)->firstOrFail();

        return view('frequencia.frequencia.editarOcorrencia', compact('ocorrencia', 'evento'));
    }

    public function uploadOcorrencia(Request $request, $id)
    {

        $ocorrencia = EventoOcorrencia::findOrFail($id);

        $this->validate($request, [
            'data' => 'required',
            'hora' => 'required|date_format:H:i'
        ]);
        $data = $request->data;
        $dt = explode('/', $data);
        $data = $dt[2].'-'.$dt[1].'-'.$dt[0];

        //Obter período da ocorrência
        //1- Segunda à Sexta
        //2-Sábado
        //3-Domingo
        $dataFormatada = strtotime($data);
        $dia = date("w", $dataFormatada);
        if ($dia == 0)// domingo
            $periodo = 3;
        elseif ($dia == 6)//sabado
            $periodo = 2;
        else
            $periodo = 1;

        $ocorrencia->update([
            'data' => $data,
            'horario' => $request->hora,
            'periodo' => $periodo
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

        $projetoEspecial = ProjetoEspecial::where('id', $evento->projeto_especial_id)->firstOrFail();

        return view('frequencia.frequencia.cadastro', compact('equipamento', 'ocorrencia', 'evento', 'projetoEspecial'));
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

        $user->frequencias()->create
        ([
            'evento_ocorrencia_id' => $request->evento_ocorrencia_id,
            'crianca' => $request->crianca,
            'jovem' => $request->jovem,
            'adulto' => $request->adulto,
            'idoso' => $request->idoso,
            'total' => $request->total,
            'observacao' => $request->observacao,
            'equipamento_id' => $id
        ]);

        return redirect()->route('frequencia.ocorrencias', [$id, 1])->with('flash_message',
            'Frequência Inserida Com Sucesso!');
    }

    public function relatorio(){
     
      $type = 2;
      
      $equipamentos = 
      Equipamento::where('publicado', '=', '1')
      ->orderBy('nome')
      ->get();

      return view('frequencia.frequencia.index', 
        compact('equipamentos', 'type'));
    }

    public function listar($id){
        $equipamento = Equipamento::findOrFail($id);

        return view('frequencia.frequencia.listar', 
            compact('equipamento'));
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
                'Ocorrência do Evento Excluida com Sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     *
     */
    public function destroy($id)
    {

    }

    public function enviarFrequencia(Request $request)
    {
        $ocorrencia = EventoOcorrencia::findOrFail($request->input('id'));
        
        EventoOcorrencia::where('id', $request->input('id'))
            ->update([
                'data_envio' => date("Y-m-d"),
                'publicado' => 2
            ]);

        $equipamento_igsis = $request->equipamento_igsis;
        $type = $request->type;

        return redirect()->route('frequencia.ocorrencias', [$equipamento_igsis,$type])
            ->with('flash_message',
                'Ocorrência do Enviada com Sucesso.');
    }

    public function frequenciasEnviadas(Request $types)
    {
        $type = $types->type;
        $equipamentos = Equipamento::where('publicado', '=', '1')->orderBy('nome')->get();
        return view('frequencia.frequencia.listarEquipamentos', compact('equipamentos', 'type'));
    }

    public function listarFrequenciasEnviadas($id)
    {
        $frequencias = Frequencia::where('equipamento_id', $id)->get();
        return view('frequencia.frequencia.listarFrequenciasEnviadas', compact('frequencias'));
    }

}
