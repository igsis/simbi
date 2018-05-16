<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;

use Simbi\Macrorregiao;
use Simbi\Regiao;
use Simbi\Regional;
use Simbi\Equipamento;
use Simbi\EquipamentoSigla;
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
        $equipamentos = Equipamento::where('idStatus', '=', 1)->orderBy('nome')->paginate(10);
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
        $siglas = EquipamentoSigla::orderBy('sigla')->get();
        $subordinacoesAdministrativas = SubordinacaoAdministrativa::orderBy('descricao')->get();
        return view('equipamentos.cadastro', 
            compact(
                'macrorregioes',
                'regioes',
                'regionais',
                'tipoServicos',
                'subordinacoesAdministrativas',
                'siglas'
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
        if($request->has('novoServico')){
            $this->validate($request, ['descricao']);
            
            $tipoServico = new TipoServico;
            $tipoServico->descricao = $request->descricao;
            $tipoServico->save();

            return redirect()->route('equipamentos.cadastro')->with('flash_message',
             'Tipo de serviço inserido com sucesso!');
        }
        
        elseif ($request->has('novaSigla')){
            $this->validate($request, [
                'sigla'=>'max:6',
                'descricao',
                'roteiro'
            ]);

            $sigla = new EquipamentoSigla;
            $sigla->fill($request->only(['sigla', 'descricao', 'roteiro']));
            $sigla->save();

            return redirect()->route('equipamentos.cadastro')->with('flash_message',
             'Sigla do Equipamento inserida com sucesso!');
        }

        elseif ($request->has('novaSecretaria')) {
            $this->validate($request, [
                'sigla'=>'max:6',
                'descricao'
            ]);

            $secretaria = new Secretaria;
            $secretaria->sigla = $request->sigla;
            $secretaria->descricao = $request->descricao;
            $secretaria->save();

            return redirect()->route('equipamento.cadastro')->with('flash_message',
                'Secretaria inserida com sucesso');
        }

        elseif ($request->has('novaSubordinacaoAdministrativa')) {
            $this->validate($request, ['descricao']);

            $subAdministrativa = new SubordinacaoAdministrativa;
            $subAdministrativa->descricao = $request->descricao;
            $subAdministrativa->save();

            return redirect()->route('equipamento.cadastro')->with('flash_message', 
                'Subordinacao Administrativa inserida com sucesso');
        }

        else{
            // Metodo que grava o novo equipamento
            $this->validate($request, [
                'nome'=>'required',
                'tipoServico'=>'required',
                'equipamentoSigla'=>'required',
                'identificacaoSecretaria'=>'required',
                'subordinaçãoAdministrativa'=>'required',
                'tematico',
                'nomeTematica',
                // 'endereco',
                'telefone'=>'nullable|max:15',
                'subprefeitura'=>'required',
                'distrito'=>'required',
                'macrorregiao'=>'required',
                'regiao'=>'required',
                'regional'=>'required',
                // 'funcionamento',
                'telecentro'=>'required',
                'nucleobraile'=>'required',
                'acervoespecializado'=>'required'
            ]);
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
