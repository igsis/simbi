<?php

namespace Simbi\Http\Controllers;

use Illuminate\Http\Request;
use response;

use Simbi\Models\Acessibilidade;
use Simbi\Models\AcessibilidadeArquitetonica;
use Simbi\Models\ContratoUso;
use Simbi\Models\Distrito;
use Simbi\Models\Endereco;
use Simbi\Models\Equipamento;
use Simbi\Models\EquipamentoPadrao;
use Simbi\Models\EquipamentoPorte;
use Simbi\Models\EquipamentoSigla;
use Simbi\Models\EquipamentoUtilizacao;
use Simbi\Models\Funcionamento;
use Simbi\Models\PracaClassificacao;
use Simbi\Models\PrefeituraRegional;
use Simbi\Models\TipoServico;
use Simbi\Models\SubordinacaoAdministrativa;
use Simbi\Models\Secretaria;
use Simbi\Models\Macrorregiao;
use Simbi\Models\Regiao;
use Simbi\Models\Regional;
use Simbi\Models\Status;
use Simbi\Models\EquipamentoOcorrencia;
use Auth;


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
    public function index(Request $types)
    {
        $type = $types->type;
        $equipamentos = Equipamento::where('publicado', '=', $types->type)->orderBy('nome')->paginate(10);
        $siglas = EquipamentoSigla::all();
        return view('equipamentos.index', compact('siglas', 'equipamentos', 'type'));
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
        $prefeituraRegionais = PrefeituraRegional::orderBy('descricao')->get();
        $distritos = Distrito::orderBy('descricao')->get();
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
                'prefeituraRegionais',
                'distritos',
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
                        'descricao'=>'required|unique:tipo_servicos'
                    ]);

            TipoServico::create($data);
            $data = TipoServico::orderBy('descricao')->get();
            return response()->json($data);
            // return redirect()->route('equipamentos.cadastro')->with('flash_message',
            //  'Tipo de serviço inserido com sucesso!');
        }

        elseif ($request->has('novaSigla')){
            $data = $this->validate($request, [
                        'sigla'=>'required|max:6|unique:equipamento_siglas',
                        'descricao'=>'required',
                        'roteiro'=>'nullable'
                    ]);

            EquipamentoSigla::create($data);
            $data = EquipamentoSigla::orderBy('descricao')->get();
            return response()->json($data);

            // return redirect()->route('equipamentos.cadastro')->with('flash_message',
            //  'Sigla do Equipamento inserida com sucesso!');
        }

        elseif ($request->has('novaSecretaria')) {
                $data = $this->validate($request, [
                            'sigla'=>'required|max:6|unique:secretarias',
                            'descricao'=>'required'
                        ]);

            Secretaria::create($data);
            $data = Secretaria::orderBy('descricao')->get();
            return response()->json($data);

            // return redirect()->route('equipamentos.cadastro')->with('flash_message',
            //     'Secretaria inserida com sucesso');
        }

        elseif ($request->has('novaSubordinacaoAdministrativa')) {
                $data = $this->validate($request, [
                        'descricao'=>'required|unique:subordinacao_administrativas'
                    ]);

            SubordinacaoAdministrativa::create($data);
            $data = SubordinacaoAdministrativa::orderBy('descricao')->get();
            return response()->json($data);

            // return redirect()->route('equipamentos.cadastro')->with('flash_message',
            //     'Subordinacao Administrativa inserida com sucesso');
        }

        elseif($request->has('novaPrefeituraRegional')){
            $data = $this->validate($request, [
                'descricao'=>'required'
            ]);

            PrefeituraRegional::create($data);
            $data = PrefeituraRegional::orderBy('descricao')->get();
            return response()->json($data);

            // return redirect()->route('equipamentos.cadastro')->with('flash_message',
            //     'Prefeitura Regional inserida com sucesso!');
        }

        elseif($request->has('novoDistrito')){
            $data = $this->validate($request, [
                'descricao'=>'required|unique:distritos'
            ]);

            Distrito::create($data);

            $data = Distrito::orderBy('descricao')->get();
            return response()->json($data);

            // return redirect()->route('equipamentos.cadastro')->with('flash_message',
            //     'Distrito inserido com sucesso!');
        }

        else{
            // Metodo que grava o novo equipamento
            $this->validate($request, [
                //Para Tabela Equipamento
                'nome'=>'required|unique:equipamentos', 
                'tipoServico'=>'required',
                'equipamentoSigla'=>'required',
                'identificacaoSecretaria'=>'required',
                'subordinacaoAdministrativa'=>'required',
                'tematico'=>'nullable',
                'nome_tematica'=>'nullable',
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
                'prefeituraRegional'=>'required',
                'distrito'=>'required',
                'macrorregiao'=>'required',
                'regiao'=>'required',
                'regional'=>'required',
                'observacao' => 'nullable'
            ]);

            $endereco = new Endereco();
            $id = $endereco->create([
                        'cep' => $request->cep,
                        'logradouro' => $request->logradouro,
                        'numero' => $request->numero,
                        'complemento' => $request->complemento,
                        'bairro' => $request->bairro,
                        'cidade' => $request->cidade,
                        'estado' => $request->uf,
                        'prefeitura_regional_id' => $request->prefeituraRegional,
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
                'nome_tematica' => $request->nome_tematica,
                'telefone' => $request->telefone,
                'telecentro' => $request->telecentro,
                'acervo_especializado' => $request->acervoespecializado,
                'nucleo_braile' => $request->nucleobraile,
                'status_id' => $request->status,
                'observacao' => $request->observacao
                ])->id;

            $funcionamento = new Funcionamento();
            foreach ($request->input('funcionamento') as $key => $value)
            $funcionamento->create([
                'domingo' => $request->input("domingo.{$key}", '0'),
                'segunda' => $request->input("segunda.{$key}", '0'),
                'terca' => $request->input("terca.{$key}", '0'),
                'quarta' => $request->input("quarta.{$key}", '0'),
                'quinta' => $request->input("quinta.{$key}", '0'),
                'sexta' => $request->input("sexta.{$key}", '0'),
                'sabado' => $request->input("sabado.{$key}", '0'),
                'hora_inicial' => $request->input("horarioAbertura.{$key}"),
                'hora_final' => $request->input("horarioFechamento.{$key}"),
                'equipamento_id' => $id
            ]);
        }
        return redirect()->route('equipamentos.criaDetalhes', $id)->with('flash_message',
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
        /*TODO: Há a necessidade desta linha?*/
        /*$equipamento = Equipamento::findOrFail($id)->with('ocorrencias')->get();
        $equipamento = $equipamento[0];*/

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
        $prefeituraRegionais = PrefeituraRegional::orderBy('descricao')->get();
        $distritos = Distrito::orderBy('descricao')->get();
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
            'prefeituraRegionais',
            'distritos',
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
            'nome_tematica'=>'nullable',
            'telefone'=>'nullable|max:15',
            'telecentro'=>'required',
            'acervoespecializado'=>'required',
            'nucleobraile'=>'required',
            'status'=>'required',
            'observacao' => 'nullable',

            //Para Tabela Endereço
            'cep'=>'required',
            'logradouro'=>'nullable',
            'bairro'=>'nullable',
            'numero'=>'required|numeric',
            'complemento'=>'nullable',
            'cidade'=>'nullable',
            'uf'=>'nullable|max:2',
            'prefeituraRegional'=>'nullable',
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
                'nome_tematica' => $request->nome_tematica,
                'telefone' => $request->telefone,
                'telecentro' => $request->telecentro,
                'acervo_especializado' => $request->acervoespecializado,
                'nucleo_braile' => $request->nucleobraile,
                'status_id' => $request->status,
                'observacao' => $request->observacao
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
            'prefeitura_regional_id' => $request->prefeituraRegional,
            'distrito_id' => $request->distrito,
            'macrorregiao_id' => $request->macrorregiao,
            'regiao_id' => $request->regiao,
            'regional_id' => $request->regional            
            ]);

        /*TODO: Atualização do horario de funcionamento*/

        return redirect()->back()->with('flash_message',
                'Equipamento Editado com Sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $types)
    {
        $type = $types->type;

        Equipamento::findOrFail($id)
            ->update(['publicado' => 0]);

        return redirect()->route('equipamentos.index', ['type' => $type])
            ->with('flash_message',
             'Equipamento Excluido com Sucesso.');
    }

    public function criaDetalhes($id)
    {
        $equipamento = Equipamento::find($id);

        $contratos = ContratoUso::all();
        $utilizacoes = EquipamentoUtilizacao::all();
        $portes = EquipamentoPorte::all();
        $padroes = EquipamentoPadrao::all();
        $arquitetonicas = AcessibilidadeArquitetonica::all();
        $pracaClassificacoes = PracaClassificacao::all();

        return view('equipamentos.detalhestecnicos', compact(
            'equipamento',
            'contratos',
            'utilizacoes',
            'portes',
            'padroes',
            'arquitetonicas',
            'pracaClassificacoes'
        ));
    }

    public function gravaDetalhes(Request $request, $id)
    {
        $equipamento = Equipamento::find($id);

        $detalhes = $this->validate($request, [
            'contratoUso' => 'required',
            'utilizacao' => 'required',
            'porte' => 'required',
            'padrao' => 'required',
            'pavimento' => 'required|numeric',
            'validade' => 'date'
        ]);

        $this->validate($request, [
            'acessibilidadeArquitetonica' => 'required',
            'qtdVagasAcessiveis' => 'nullable'
        ]);

        $acessibilidade = new Acessibilidade();

        $acessibilidade_id = $acessibilidade->create([
            'acessibilidade_arquitetonica_id' => $request->acessibilidadeArquitetonica,
            'banheiros_adaptados' => $request->banheiros,
            'rampas_acesso' => $request->rampas,
            'elevador' => $request->elevador,
            'piso_tatil' => $request->pisoTatil,
            'estacionamento_acessivel' => $request->estacionamentoAcessivel,
            'quantidade_vagas' => $request->qtdVagasAcessiveis
        ]);

        $equipamento->detalhe()->create([
            'contrato_uso_id' => $request->contratoUso,
            'equipamento_utilizacao_id' => $request->utilizacao,
            'equipamento_porte_id' => $request->porte,
            'equipamento_padrao_id' => $request->padrao,
            'pavimento' => $request->pavimento,
            'acessibilidade_id' => $acessibilidade_id->id,
            'validade_avcb' => $request->validade
        ]);

        return redirect()->route('equipamentos.show', $id)->with('flash_message', 'Detalhes Técnicos cadastrado com sucesso');
    }

    public function criaCapacidade($id)
    {
        $equipamento = Equipamento::find($id);

        $pracaClassificacoes = PracaClassificacao::all();

        return view('equipamentos.capacidade', compact(
            'equipamento',
            'pracaClassificacoes'
        ));
    }

    public function gravaCapacidade(Request $request, $id)
    {
        /*TODO: Utilizar findOrCreate para as tabelas adicionais*/

        $equipamento = Equipamento::find($id);

        $equipamento->capacidade()->create([
            'auditorio' => $request->auditorio,
            'teatro' => $request->teatro,
            'sala_multiuso' => $request->multiuso,
            'sala_estudo_grupo' => $request->estudoGrupo,
            'sala_estudo_individual' => $request->estudoIndividual,
            'sala_infantil' => $request->infantil,
            'estacionamento' => $request->estacionamentoPublico,
            'praca' => $request->praca
        ]);

        return redirect();
    }

    public function criaArea($id)
    {
        $equipamento = Equipamento::find($id);

        return view('equipamentos.area', compact('equipamento'));
    }

    public function gravaArea(Request $request, $id)
    {
        $equipamento = Equipamento::find($id);

        $this->validate($request, [
            'areaInterna' => 'required|numeric',
            'areaTotalConstruida' => 'required|numeric',
            'areaTotalTerreno' => 'required|numeric',
            'areaAuditorio' => 'nullable|numeric',
            'areaTeatro' => 'nullable|numeric'
        ]);

        $equipamento->area()->create([
            'interna' => $request->areaInterna,
            'auditorio' => $request->areaAuditorio,
            'teatro' => $request->areaTeatro,
            'total_construida' => $request->areaTotalConstruida,
            'total_terreno' => $request->areaTotalTerreno
        ]);

        return redirect()->route('equipamentos.show', $id)->with('flash_message', 'Área cadastrada com sucesso');
    }

    public function criaReforma($id)
    {
        $equipamento = Equipamento::find($id);

        return view('equipamentos.reforma', compact('equipamento'));
    }

    public function gravaReforma(Request $request, $id)
    {
        $equipamento = Equipamento::find($id);
        $user =  Auth::user();

        $data = $this->validate($request, [
            'inicioReforma' => 'required',
            'terminoReforma' => 'nullable|after:inicioReforma',
            'descricaoReforma' => 'required'
        ]);

        $equipamento->reformas()->create([
            'user_id' => $user->id,
            'inicio_reforma' => $request->inicioReforma,
            'termino_reforma' => $request->terminoReforma,
            'descricao' => $request->descricaoReforma
        ]);

        return redirect()->route('equipamentos.show', $id)->with('flash_message', 'Período de Reforma incluido com sucesso');
    }


    public function ativarEquipamento(Request $request)
    {
        Equipamento::findOrFail($request->id)
            ->update(['publicado' => 1]);

        return redirect()->route('equipamentos.index', ['type' => $request->type])
            ->with('flash_message',
             'Usuario Ativado com Sucesso.');
    }

    // Filtro de Equipamentos
    public function searchEquipamento(Request $request, Equipamento $equipamento)
    {
        $dataForm = $request->except('_token');

        $type = $request->types;

        $siglas = EquipamentoSigla::all();

        $equipamentos = $equipamento->search($dataForm)->orderBy('nome')->paginate(10);

        return view('equipamentos.index', compact('dataForm', 'equipamentos', 'siglas', 'type'));
    }

    public function equipamentoOcorrencia(Request $request)
    {
       
       $equipamento = Equipamento::findOrFail($request->idEquipamento);

       $data = $this->validate($request, 
                    [
                        'data'=> 'required',
                        'ocorrencia'=>'required',
                        'observacao'=>'required'

                    ]);
       
       $user =  Auth::user()->id;
       

       $ok = $equipamento->ocorrencias()->create([
            'user_id' => $user,
            'data' => $request->data,
            'ocorrencia' => $request->ocorrencia,
            'observacao' => $request->observacao
        ]);

       return response()->json($ok);

    }

    public function countOcorrencias($id)
    {
        $count = EquipamentoOcorrencia::where('equipamento_id',$id)->get()->count();

        return response()->json($count);

        // dd($count);
    }

}
