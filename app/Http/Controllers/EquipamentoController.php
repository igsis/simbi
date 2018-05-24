<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;

use Simbi\Models\Endereco;
use Simbi\Models\Equipamento;
use Simbi\Models\EquipamentoSigla;
use Simbi\Models\TipoServico;
use Simbi\Models\SubordinacaoAdministrativa;
use Simbi\Models\Secretaria;
use Simbi\Models\Macrorregiao;
use Simbi\Models\Regiao;
use Simbi\Models\Regional;
use Simbi\Models\Status;

class EquipamentoController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'isCoord'])->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipamentos = Equipamento::where('publicado', '=', 1)->orderBy('nome')->paginate(10);
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
        $status = Status::orderBy('descricao')->get();

        return view('equipamentos.cadastro',
            compact(
                'tipoServicos',
                'siglas',
                'secretarias',
                'subordinacoesAdministrativas',
                'macrorregioes',
                'regioes',
                'regionais',
                'status'
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
                        'roteiro'=>'nullable'
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
                'acervoespecializado'=>'required',
                'nucleobraile'=>'required',
                'status'=>'required',

                //Para Tabela Endereço
                'cep'=>'required',
                'logradouro'=>'nullable',
                'bairro'=>'nullable',
                'numero'=>'required|numeric',
                'complemento'=>'nullable',
                'cidade'=>'nullable',
                'uf'=>'nullable|max:2',
                'subprefeitura'=>'nullable',
                'distrito'=>'nullable',
                'macrorregiao'=>'nullable',
                'regiao'=>'nullable',
                'regional'=>'nullable'
            ]);

            $endereco = new Endereco();
            $endereco->create([
                        'cep' => $request->cep,
                        'logradouro' => $request->logradouro,
                        'numero' => $request->numero,
                        'complemento' => $request->complemento,
                        'bairro' => $request->bairro,
                        'cidade' => $request->cidade,
                        'estado' => $request->uf,
                        'subprefeitura_id' => $request->subprefeitura,
                        'distrito_id' => $request->distrito,
                        'macrorregiao_id' => $request->macrorregiao,
                        'regiao_id' => $request->regiao,
                        'regional_id' => $request->regional
                    ])
            ->equipamento()->create([
                'nome' => $request->nome,
                'tipo_servico_id' => $request->tipoServico,
                'equipamento_sigla_id' => $request->equipamentoSigla,
                'secretaria_id' => $request->identificacaoSecretaria,
                'subordinacao_administrativa_id' => $request->subordinacaoAdministrativa,
                'tematico' => $request->tematico,
                'nomeTematica' => $request->nomeTematica,
                'telefone' => $request->telefone,
                'telecentro' => $request->telecentro,
                'acervo_especializado' => $request->acervoespecializado,
                'nucleo_braile' => $request->nucleobraile,
                'status_id' => $request->status
            ]);
        }
        return redirect()->route('equipamentos.index')->with('flash_message',
            'Equipamento inserido com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $equipamento = Equipamento::findOrFail($id);
        return view('equipamentos.show', compact('equipamento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $equipamento = Equipamento::findOrFail($id);
        $tipoServicos = TipoServico::orderBy('descricao')->get();
        $siglas = EquipamentoSigla::orderBy('sigla')->get();
        $subordinacoesAdministrativas = SubordinacaoAdministrativa::orderBy('descricao')->get();
        $secretarias = Secretaria::orderBy('descricao')->get();
        $macrorregioes = Macrorregiao::orderBy('descricao')->get();
        $regioes = Regiao::orderBy('descricao')->get();
        $regionais = Regional::orderBy('descricao')->get();
        $status = Status::orderBy('descricao')->get();
        return view ('equipamentos.editar', compact(
            'equipamento',
            'tipoServicos',
            'siglas',
            'subordinacoesAdministrativas',
            'secretarias',
            'macrorregioes',
            'regioes',
            'regionais',
            'status'
        ));
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
        $equipamento = Equipamento::findOrFail($id);

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
            'acervoespecializado'=>'required',
            'nucleobraile'=>'required',
            'status'=>'required',

            //Para Tabela Endereço
            'cep'=>'required',
            'logradouro'=>'nullable',
            'bairro'=>'nullable',
            'numero'=>'required|numeric',
            'complemento'=>'nullable',
            'cidade'=>'nullable',
            'uf'=>'nullable|max:2',
            'subprefeitura'=>'nullable',
            'distrito'=>'nullable',
            'macrorregiao'=>'nullable',
            'regiao'=>'nullable',
            'regional'=>'nullable'
        ]);

        $equipamento->update([
                'nome' => $request->nome,
                'tipo_servico_id' => $request->tipoServico,
                'equipamento_sigla_id' => $request->equipamentoSigla,
                'secretaria_id' => $request->identificacaoSecretaria,
                'subordinacao_administrativa_id' => $request->subordinacaoAdministrativa,
                'tematico' => $request->tematico,
                'nomeTematica' => $request->nomeTematica,
                'telefone' => $request->telefone,
                'telecentro' => $request->telecentro,
                'acervo_especializado' => $request->acervoespecializado,
                'nucleo_braile' => $request->nucleobraile,
                'status_id' => $request->status
            ]);

        $equipamento->endereco
            ->update([
            'cep' => $request->cep,
            'logradouro' => $request->logradouro,
            'numero' => $request->numero,
            'complemento' => $request->complemento,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'estado' => $request->uf,
            'subprefeitura_id' => $request->subprefeitura,
            'distrito_id' => $request->distrito,
            'macrorregiao_id' => $request->macrorregiao,
            'regiao_id' => $request->regiao,
            'regional_id' => $request->regional
            ]);

        return redirect()->route('equipamentos.index')
            ->with('flash_message',
                'Equipamento Editado com Sucesso!');
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
