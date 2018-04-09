<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;

use Simbi\Macrorregiao;
use Simbi\Regiao;
use Simbi\Regional;
use Simbi\Equipamento;
use Simbi\TipoServico;
use Simbi\SubordinacaoAdministrativa;

class EquipamentoController extends Controller
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
        $equipamentos = Equipamento::where('idStatusEquipamento', '=', 1)->orderBy('nome')->paginate(10);
        return view('equipamentos.index')->with('equipamentos', $equipamentos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $macrorregioes = Macrorregiao::orderBy('descricao')->get();
        $regioes = Regiao::orderBy('descricao')->get();
        $regionais = Regional::orderBy('descricao')->get();
        $tipoServicos = TipoServico::orderBy('descricao')->get();
        $subordinacoesAdministrativas = SubordinacaoAdministrativa::orderBy('descricao')->get();
        return view('equipamentos.cadastro', 
            compact(
                'macrorregioes',
                'regioes',
                'regionais',
                'tipoServicos',
                'subordinacoesAdministrativas'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if(Input::get('servico')){
            $this->validade($request, [
                'descricaoServico']);
            TipoServico::create()
        }
        
        elseif (Input::get('sigla')){
            // Metodo para adicinaro uma nova sigla do equipamento
        }

        elseif (Input::get('secretaria')) {
            // Metodo para adicionar uma nova Identificação da Secretaria
        }

        elseif (Input::get('subordinacaoAdministrativa')) {
            // Metodo para adicionar uma nova Subordinação Administrativa
        }

        else{
            // Metodo que grava o novo equipamento
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('equipamentos.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
