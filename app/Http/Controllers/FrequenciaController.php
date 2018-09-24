<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Compound;
use Simbi\Http\Controllers\Controller;
use Simbi\Models\Equipamento;
use Simbi\Models\Evento;
use Simbi\Models\EventoOcorrencia;
use Simbi\Models\EventosIgsis;
use Auth;
use Simbi\Models\Frequencia;
use Simbi\Models\OcorrenciasIgsis;

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
        $equipamentos = Equipamento::where('publicado', '=', '1')->orderBy('nome')->paginate(10);
        return view('frequencia.index', compact('equipamentos', 'type'));

    }

    public function listarEventos($igsis_id)
    {
        $eventos = Evento::join('evento_ocorrencias', 'evento_ocorrencias.igsis_evento_id', 'eventos.igsis_evento_id')
            ->where('evento_ocorrencias.igsis_id', $igsis_id)
            ->distinct('eventos.igsis_evento_id')
            ->orderBy('evento_ocorrencias.data')
            ->paginate(10);

        $frequenciasCadastradas = Frequencia::all()->pluck('evento_ocorrencia_id')->toArray();

        return view('frequencia.eventos', compact('eventos', 'frequenciasCadastradas'));
    }

    public function editarEvento($id)
    {
        $ocorrencia = EventoOcorrencia::findOrFail($id);

        return view('frequencia.editar', compact('ocorrencia'));
    }

    public function uploadOcorrencia(Request $request, $id)
    {
        $ocorrencia = EventoOcorrencia::findOrFail($id);

        $this->validate($request, [
            'data'=>'required',
            'hora'=>'required'
        ]);

        $ocorrencia->update([
            'data' => $request->data,
            'horario' => $request->hora
        ]);

        return redirect()->route('frequencia.eventos', $ocorrencia->igsis_id)
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

//        $ocorrenciaIgsis = OcorrenciasIgsis::where([
//            ['local', ' = ', $equipamento->igsis_id],
//            ['publicado', ' = ', 1],
//        ]);
//
//        $eventoIgsis = EventosIgsis::where([
//            ['publicado', ' = ', 1],
//            ['idEvento', ' = ', $ocorrenciaIgsis->idEvento],
//        ]);

        return view('frequencia.cadastro', compact('equipamento', 'ocorrencia', 'evento'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'evento_ocorrencia_id'  => 'required',
            'crianca'       =>  'required|integer|between: 0, 9999',
            'jovem'         =>  'required|integer|between: 0, 9999',
            'adulto'        =>  'required|integer|between: 0, 9999',
            'idoso'         =>  'required|integer|between: 0, 9999',
            'total'         =>  'required|integer|between: 0, 99999'
        ]);

        $user =  Auth::user();

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

        return redirect()->route('frequencia.index')->with('flash_message',
            'Frequência Inserida Com Sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function relatorio()
    {
        $type = 2;
        $equipamentos = Equipamento::where('publicado', '=', '1')->orderBy('nome')->paginate(10);
        return view('frequencia.index', compact('equipamentos', 'type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function listar($id)
    {
        $equipamento = Equipamento::findOrFail($id);

        $ocorrencia = EventoOcorrencia::where('igsis_id', $equipamento->igsis_id)->pluck('data', 'horario');

        return view('frequencia.listar', compact('equipamento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function removeOcorrencia($id)
    {
        $ocorrencia = EventoOcorrencia::findOrFail($id);

        EventoOcorrencia::findOrFail($id)
            ->update(['publicado' => 0]);

        return redirect()->route('frequencia.eventos', $ocorrencia->igsis_id)
            ->with('flash_message',
                'Ocorrencia do Evento Excluido com Sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
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
}
