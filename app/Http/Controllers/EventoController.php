<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use Simbi\Http\Controllers\Controller;
use Simbi\Models\ContratacaoForma;
use Simbi\Models\Equipamento;
use Simbi\Models\Evento;
use Simbi\Models\EventosIgsis;
use Simbi\Models\ProjetoEspecial;
use Simbi\Models\TipoEvento;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($equipamento_id)
    {
        $eventosIgsis = EventosIgsis::where([
            ['publicado', 1],
            ['idInstituicao', 14],
            ['dataEnvio', '>=', '2019-06-01']
        ])->orderBy('nomeEvento')->get();
        $eventos = Evento::where('publicado', 1)->orderBy('nome_evento')->get();

        $equipamento = Equipamento::where('id', $equipamento_id)->firstOrFail();

        return view('evento.listaEventos', compact('eventos', 'equipamento', 'eventosIgsis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($equipamento_id)
    {
        $equipamento = Equipamento::where('id', $equipamento_id)->firstOrFail();
        $projetoEspecial = ProjetoEspecial::where('publicado', 1)->orderBy('projetoEspecial')->get();
        $tipoEvento = TipoEvento::where('publicado', 1)->orderBy('tipo_evento')->get();
        $contratacao = ContratacaoForma::orderBy('forma_contratacao')->get();

        $igsis_evento_id = Evento::all()->pluck('igsis_evento_id')->last();

        return view('evento.cadastroEvento', compact('equipamento', 'projetoEspecial', 'tipoEvento', 'contratacao', 'igsis_evento_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $igsis_id)
    {

        $this->validate($request, [
            'nome' => 'required',
            'tipoEvento' => 'required',
            'projetoEspecial' => 'required',
            'contratacao' => 'required'
        ]);

        $evento = Evento::create([
            'igsis_evento_id' => $request->igsis_evento_id,
            'nome_evento' => $request->nome,
            'tipo_evento_id' => $request->tipoEvento,
            'projeto_especial_id' => $request->projetoEspecial,
            'contratacao_forma_id' => $request->contratacao
        ]);
        return redirect()->route('eventos.cadastro.ocorrencia', ['equipamento_igsis' => $igsis_id, 'evento_igsis' => $evento->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit ($equipamento_id, $id)
    {
        $eventos = Evento::FindOrFail($id);
        $equipamento = Equipamento::where('id', $equipamento_id)->firstOrFail();
        $projetoEspecial = ProjetoEspecial::orderBy('projetoEspecial')->get();
        $tipoEvento = TipoEvento::orderBy('tipo_evento')->get();
        $contratacao = ContratacaoForma::orderBy('forma_contratacao')->get();
        $igsis_evento_id = Evento::all()->pluck('igsis_evento_id')->last();


        return view('evento.editarEvento', compact( 'eventos','equipamento', 'projetoEspecial', 'tipoEvento', 'contratacao', 'igsis_evento_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, $equipamento_id, $id)
    {

        $this->validate($request, [
            'nome' => 'required',
            'tipoEvento' => 'required',
            'projetoEspecial' => 'required',
            'contratacao' => 'required'

        ]);

        $evento = Evento::findOrFail($id);

        $evento->update([
            'igsis_evento_id' => $request->igsis_evento_id,
            'nome_evento' => $request->nome,
            'tipo_evento_id' => $request->tipoEvento,
            'projeto_especial_id' => $request->projetoEspecial,
            'contratacao_forma_id' => $request->contratacao
        ]);

        return redirect()->route('eventos.listar', compact('equipamento_id'))->with('flash_message', 'Evento Editado com Sucesso!');
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

    public function importarIgsis($idEquipamento)
    {

        $eventos = EventosIgsis::where([
            ['publicado', 1],
            ['idInstituicao', 14],
            ['nomeEvento', 'not like', '%[CANCELADO]%'],
        ])
            ->whereYear('dataEnvio', '>=', '2019')
            ->orderBy('nomeEvento', 'desc')
            ->get();

        $cadastrados = Evento::all()->pluck('igsis_evento_id')->toArray();

        return view('evento.importarIgsis', compact('eventos', 'cadastrados', 'idEquipamento'));
    }

    public function cadastroImportacao($equipamento_igsis, $igsis_id)
    {
        $evento = EventosIgsis::findOrFail($igsis_id);
        $projetoEspecial = ProjetoEspecial::where('publicado', 1)->orderBy('projetoEspecial')->get();
        $tipoEvento = TipoEvento::where('publicado', 1)->orderBy('tipo_evento')->get();
        $contratacao = ContratacaoForma::orderBy('forma_contratacao')->get();

        return view('evento.cadastroEventoIgsis', compact(
            'evento',
            'projetoEspecial',
            'tipoEvento',
            'contratacao',
            'equipamento_igsis'
        ));
    }

    public function gravarImportacao(Request $request, $igsis_id)
    {
        $this->validate($request, [
            'nome' => 'required',
            'tipoEvento' => 'required',
            'projetoEspecial' => 'required',
            'contratacao' => 'required'
        ]);

        $evento = Evento::create([
            'igsis_evento_id' => $request->igsis_evento_id,
            'nome_evento' => $request->nome,
            'tipo_evento_id' => $request->tipoEvento,
            'projeto_especial_id' => $request->projetoEspecial,
            'contratacao_forma_id' => $request->contratacao
        ]);
        return redirect()->route('eventos.cadastro.ocorrencia', ['equipamento_igsis' => $igsis_id, 'evento_igsis' => $evento->id]);
    }
}
