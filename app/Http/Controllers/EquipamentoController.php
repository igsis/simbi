<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;

use Simbi\Models\Equipamento;
use Simbi\Models\EquipamentoSigla;
use Simbi\Models\TipoServico;
use Simbi\Models\SubordinacaoAdministrativa;
use Simbi\Models\Secretaria;
use Simbi\Models\Macrorregiao;
use Simbi\Models\Regiao;
use Simbi\Models\Regional;

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
        $tipoServicos = TipoServico::orderBy('descricao')->get();
        $siglas = EquipamentoSigla::orderBy('sigla')->get();
        $subordinacoesAdministrativas = SubordinacaoAdministrativa::orderBy('descricao')->get();
        $secretarias = Secretaria::orderBy('descricao')->get();
        $macrorregioes = Macrorregiao::orderBy('descricao')->get();
        $regioes = Regiao::orderBy('descricao')->get();
        $regionais = Regional::orderBy('descricao')->get();

        return view('equipamentos.cadastro',
            compact(
                'tipoServicos',
                'siglas',
                'secretarias',
                'subordinacoesAdministrativas',
                'macrorregioes',
                'regioes',
                'regionais'
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
        $equipamento = new Equipamento;

        if($request->has('novoServico')){
            $data = $this->validate($request, [
                        'descricao'=>'required'
                    ]);
            
            TipoServico::create($data);

            return redirect()->route('equipamentos.cadastro')->with('flash_message',
             'Tipo de serviço inserido com sucesso!');
        }
        
        elseif ($request->has('novaSigla')){
            $data = $this->validate($request, [
                        'sigla'=>'required|max:6',
                        'descricao'=>'required',
                        'roteiro'=>'required'
                    ]);

            EquipamentoSigla::create($data);

            return redirect()->route('equipamentos.cadastro')->with('flash_message',
             'Sigla do Equipamento inserida com sucesso!');
        }

        elseif ($request->has('novaSecretaria')) {
                $data = $this->validate($request, [
                            'sigla'=>'required|max:6',
                            'descricao'=>'required'
                        ]);

            Secretaria::create($data);

            return redirect()->route('equipamentos.cadastro')->with('flash_message',
                'Secretaria inserida com sucesso');
        }

        elseif ($request->has('novaSubordinacaoAdministrativa')) {
            $data = $this->validate($request, [
                        'descricao'=>'required'
                    ]);

            SubordinacaoAdministrativa::create($data);

            return redirect()->route('equipamentos.cadastro')->with('flash_message', 
                'Subordinacao Administrativa inserida com sucesso');
        }

        else{
            // Metodo que grava o novo equipamento
            $this->validate($request, [
                //Para Tabela Equipamento
                'nome'=>'required',
                'tipoServico'=>'required',
                'equipamentoSigla'=>'required',
                'identificacaoSecretaria'=>'required',
                'subordinacaoAdministrativa'=>'required',
                'tematico'=>'nullable',
                'nomeTematica'=>'nullable',
                'telefone'=>'nullable|max:15',
                'telecentro'=>'required',
                'nucleobraile'=>'required',
                'acervoespecializado'=>'required',

                //Para Tabela Endereço
                'cep'=>'required',
                'logradouro'=>'nullable',
                'bairro'=>'nullable',
                'numero'=>'required|numeric',
                'complemento'=>'nullable',
                'cidade'=>'nullable',
                'uf'=>'nullable|max:2'
            ]);

            $dataEquip = $request->only([
                            'nome',
                            'tipoServico',
                            'equipamentoSigla',
                            'identificacaoSecretaria',
                            'subordinacaoAdministrativa',
                            'tematico',
                            'nomeTematica',
                            'telefone',
                            'telecentro',
                            'nucleobraile',
                            'acervoespecializado'
                        ]);

            $dataEnd = $request->only([
                            'cep',
                            'logradouro',
                            'bairro',
                            'numero',
                            'complemento',
                            'cidade',
                            'uf'
                        ]);

            $equipamento->create($dataEquip);
            $equipamento->endereco()->create($dataEnd);

        }
        return redirect()->route('equipamentos.index')->with('flash_message',
            'Equipamento inserida com sucesso');
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
