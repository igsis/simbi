<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;

use Simbi\Equipamento;
use Simbi\EquipamentoSigla;
use Simbi\TipoServico;
use Simbi\SubordinacaoAdministrativa;
use Simbi\Secretaria;

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
        return view('equipamentos.cadastro', 
            compact(
                'tipoServicos',
                'siglas',
                'secretarias',
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
        $equipamento = new Equipamento;

        if($request->has('novoServico')){
            $this->validate($request, [
                'descricao'=>'required'
            ]);
            
            $tipoServico = new TipoServico;
            $tipoServico->descricao = $request->descricao;
            $tipoServico->save();

            return redirect()->route('equipamentos.cadastro')->with('flash_message',
             'Tipo de serviço inserido com sucesso!');
        }
        
        elseif ($request->has('novaSigla')){
            $this->validate($request, [
                'sigla'=>'required|max:6',
                'descricao'=>'required',
                'roteiro'=>'required'
            ]);

            $sigla = new EquipamentoSigla;
            $sigla->fill($request->only(['sigla', 'descricao', 'roteiro']));
            $sigla->save();

            return redirect()->route('equipamentos.cadastro')->with('flash_message',
             'Sigla do Equipamento inserida com sucesso!');
        }

        elseif ($request->has('novaSecretaria')) {
            $this->validate($request, [
                'sigla'=>'required|max:6',
                'descricao'=>'required'
            ]);

            $secretaria = new Secretaria;
            $secretaria->sigla = $request->sigla;
            $secretaria->descricao = $request->descricao;
            $secretaria->save();

            return redirect()->route('equipamentos.cadastro')->with('flash_message',
                'Secretaria inserida com sucesso');
        }

        elseif ($request->has('novaSubordinacaoAdministrativa')) {
            $this->validate($request, [
                'descricao'=>'required'
            ]);

            $subAdministrativa = new SubordinacaoAdministrativa;
            $subAdministrativa->descricao = $request->descricao;
            $subAdministrativa->save();

            return redirect()->route('equipamentos.cadastro')->with('flash_message', 
                'Subordinacao Administrativa inserida com sucesso');
        }

        else{
            // Metodo que grava o novo equipamento
            $this->validate($request, [
                'nome'=>'required',
                'tipoServico'=>'required',
                'equipamentoSigla'=>'required',
                'identificacaoSecretaria'=>'required',
                'subordinacaoAdministrativa'=>'required',
                'tematico'=>'nullable',
                'nomeTematica'=>'nullable',
                // 'endereco',
                'telefone'=>'nullable|max:15',
                // 'funcionamento',
                'telecentro'=>'required',
                'nucleobraile'=>'required',
                'acervoespecializado'=>'required'
            ]);

            $equipamento->nome = $request->nome;
            $equipamento->idTipoServico = $request->tipoServico;
            $equipamento->idSigla = $request->equipamentoSigla;
            $equipamento->idSecretaria = $request->identificacaoSecretaria;
            $equipamento->idSubordinacaoAdministrativa = $request->subordinacaoAdministrativa;
            $equipamento->tematico = $request->tematico;
            $equipamento->nomeTematica = $request->nomeTematica;
            $equipamento->telefone = $request->telefone;
            $equipamento->telecentro = $request->telecentro;
            $equipamento->acervoEspecializado = $request->acervoespecializado;
            $equipamento->nucleoBraile = $request->nucleobraile;

            $equipamento->save();
        }
        return redirect()->route('endereco.cadastro');
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
