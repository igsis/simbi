<?php

namespace Simbi\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use response;
use Simbi\Models\Acessibilidade;
use Simbi\Models\AcessibilidadeArquitetonica;
use Simbi\Models\Classificacao;
use Simbi\Models\ContratoUso;
use Simbi\Models\Distrito;
use Simbi\Models\Elevador;
use Simbi\Models\Endereco;
use Simbi\Models\Equipamento;
use Simbi\Models\EquipamentoOcorrencia;
use Simbi\Models\EquipamentosCapacidade;
use Simbi\Models\EquipamentosIgsis;
use Simbi\Models\Evento;
use Simbi\Models\Funcionamento;
use Simbi\Models\Macrorregiao;
use Simbi\Models\Padrao;
use Simbi\Models\Porte;
use Simbi\Models\Praca;
use Simbi\Models\PrefeituraRegional;
use Simbi\Models\Regiao;
use Simbi\Models\Regional;
use Simbi\Models\Secretaria;
use Simbi\Models\Status;
use Simbi\Models\SubordinacaoAdministrativa;
use Simbi\Models\TipoServico;
use Simbi\Models\User;
use Simbi\Models\Utilizacao;


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
        $equipamentos = Equipamento::where('publicado', '=', $types->type)->orderBy('nome')->get();
        $count = count(Equipamento::where('portaria', 1)->get());
        return view('gerencial.equipamentos.index', compact( 'equipamentos', 'type','count'));
    }


    public function importarEquipamentos()
    {
        $equipamentos = EquipamentosIgsis::where([
            ['instituicao_id', '=', 4],
            ['publicado', '=', 1]
        ])
            ->orWhere('local', 'LIKE', 'Biblioteca%')
            ->orWhere('local', 'LIKE', 'Ônibus%')
            ->orWhere('local', 'LIKE', 'Ponto de Leitura%')
            ->orderBy('local')->get();

        $cadastrados = Equipamento::all()->pluck('igsis_id')->toArray();

        return view('gerencial.equipamentos.importarIgsis', compact('equipamentos', 'cadastrados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoServicos = TipoServico::orderBy('descricao')->get();
        $subordinacoesAdministrativas = SubordinacaoAdministrativa::orderBy('descricao')->get();
        $secretarias = Secretaria::where('publicado', 1)->orderBy('descricao')->get();
        $macrorregioes = Macrorregiao::orderBy('descricao')->get();
        $regioes = Regiao::orderBy('descricao')->get();
        $regionais = Regional::orderBy('descricao')->get();
        $prefeituraRegionais = PrefeituraRegional::where('publicado', 1)->orderBy('descricao')->get();
        $distritos = Distrito::where('publicado', 1)->orderBy('descricao')->get();
        $status = Status::orderBy('descricao')->get();

        return view('gerencial.equipamentos.cadastro',
            compact(
                'tipoServicos',
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

    public function createIgsis($igsis_id)
    {
        $equipamentoIgsis = EquipamentosIgsis::where('id', '=', $igsis_id)->first();
        $tipoServicos = TipoServico::where('publicado', 1)->orderBy('descricao')->get();
        $subordinacoesAdministrativas = SubordinacaoAdministrativa::where('publicado', 1)->orderBy('descricao')->get();
        $secretarias = Secretaria::orderBy('descricao')->get();
        $macrorregioes = Macrorregiao::orderBy('descricao')->get();
        $regioes = Regiao::orderBy('descricao')->get();
        $regionais = Regional::orderBy('descricao')->get();
        $prefeituraRegionais = PrefeituraRegional::where('publicado', 1)->orderBy('descricao')->get();
        $distritos = Distrito::where('publicado', 1)->orderBy('descricao')->get();
        $status = Status::orderBy('descricao')->get();

        return view('gerencial.equipamentos.cadastroIgsis',
            compact(
                'equipamentoIgsis',
                'tipoServicos',
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->has('novoServico')) {
            $data = $this->validate($request, [
                'descricao' => 'required|unique:tipo_servicos'
            ]);

            TipoServico::create($data);
            $data = TipoServico::where('publicado', 1)->orderBy('descricao')->get();
            return response()->json($data);
        } elseif ($request->has('novaSecretaria')) {
            $data = $this->validate($request, [
                'sigla' => 'required|max:6|unique:secretarias',
                'descricao' => 'required'
            ]);

            Secretaria::create($data);
            $data = Secretaria::orderBy('descricao')->get();
            return response()->json($data);
        } elseif ($request->has('novaSubordinacaoAdministrativa')) {
            $data = $this->validate($request, [
                'descricao' => 'required|unique:subordinacao_administrativas'
            ]);

            SubordinacaoAdministrativa::create($data);
            $data = SubordinacaoAdministrativa::orderBy('descricao')->get();
            return response()->json($data);
        } elseif ($request->has('novaPrefeituraRegional')) {
            $data = $this->validate($request, [
                'descricao' => 'required'
            ]);

            PrefeituraRegional::create($data);
            $data = PrefeituraRegional::orderBy('descricao')->get();
            return response()->json($data);
        } elseif ($request->has('novoDistrito')) {
            $data = $this->validate($request, [
                'descricao' => 'required|unique:distritos'
            ]);

            Distrito::create($data);

            $data = Distrito::orderBy('descricao')->get();
            return response()->json($data);
        } else {
            // Metodo que grava o novo equipamento
            $this->validate($request, [
                //Para Tabela Equipamento
                'nome' => 'required|unique:equipamentos',
                'igsis_id' => 'nullable',
                'tipoServico' => 'required',
                'equipamentoSigla' => 'required|max:6',
                'identificacaoSecretaria' => 'required',
                'subordinacaoAdministrativa' => 'required',
                'tematico' => 'nullable',
                'nome_tematica' => 'nullable',
                'telefone' => 'required|max:15',
                'telecentro' => 'required',
                'acervoespecializado' => 'required',
                'nucleobraile' => 'required',
                'status' => 'required',

                //Para Tabela Endereço
                'cep' => 'required',
                'logradouro' => 'nullable',
                'bairro' => 'nullable',
                'numero' => 'required|numeric',
                'complemento' => 'nullable',
                'cidade' => 'nullable',
                'uf' => 'nullable|max:2',
                'prefeituraRegional' => 'required',
                'distrito' => 'required',
                'macrorregiao' => 'required',
                'regiao' => 'required',
                'regional' => 'required',
                'observacao' => 'nullable',

                //Para a tabela funcionamento
                'horarioAbertura' => 'required',
                'horarioFechamento' => 'required'
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
                    'igsis_id' => $request->igsis_id,
                    'tipo_servico_id' => $request->tipoServico,
                    'equipamento_sigla' => $request->equipamentoSigla,
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
            foreach ($request->input('funcionamento') as $key => $value) {
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
        }
        return redirect()->route('equipamentos.criaDetalhes', $id)->with('flash_message',
            'Equipamento inserido com sucesso');
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $equipamento = Equipamento::findOrFail($id);

        $eventos = Evento::join('evento_ocorrencias', 'evento_ocorrencias.igsis_evento_id', 'eventos.id', '')
            ->join('frequencias', 'frequencias.evento_ocorrencia_id', 'evento_ocorrencias.id', '')
            ->where([
                ['evento_ocorrencias.igsis_id', $id],
                ['evento_ocorrencias.publicado', 2]
            ])
            ->distinct('eventos.igsis_evento_id')
            ->orderBy('evento_ocorrencias.data', 'desc')
            ->get();

        //soma da capacidade de público dos espaços da área interna
        $capacidadeTotal = 0;

        if (isset($equipamento->auditorio))
           $capacidadeTotal += $equipamento->auditorio->capacidade;

        if (isset($equipamento->salaComum))
            $capacidadeTotal += $equipamento->salaComum->quantidade;

        if (isset($equipamento->estudoGrupo))
            $capacidadeTotal += $equipamento->estudoGrupo->capacidade;

        if (isset($equipamento->estudoIndividual))
            $capacidadeTotal += $equipamento->estudoIndividual->quantidade;

        if (isset($equipamento->infantil))
            $capacidadeTotal += $equipamento->infantil->capacidade;

        if (isset($equipamento->multiuso))
            $capacidadeTotal += $equipamento->multiuso->capacidade;

        if (isset($equipamento->telecentroDiglab))
            $capacidadeTotal += $equipamento->telecentroDiglab->quantidade;

        if (isset($equipamento->teatro))
            $capacidadeTotal += $equipamento->teatro->capacidade;

        return view('gerencial.equipamentos.show', compact('equipamento', 'eventos', 'capacidadeTotal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $equipamento = Equipamento::findOrFail($id);
        $tipoServicos = TipoServico::orderBy('descricao')->get();
        $subordinacoesAdministrativas = SubordinacaoAdministrativa::orderBy('descricao')->get();
        $secretarias = Secretaria::orderBy('descricao')->get();
        $macrorregioes = Macrorregiao::orderBy('descricao')->get();
        $regioes = Regiao::orderBy('descricao')->get();
        $regionais = Regional::orderBy('descricao')->get();
        $prefeituraRegionais = PrefeituraRegional::orderBy('descricao')->get();
        $distritos = Distrito::orderBy('descricao')->get();
        $status = Status::orderBy('descricao')->get();
        return view('gerencial.equipamentos.editar', compact(
            'equipamento',
            'tipoServicos',
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
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $equipamento = Equipamento::findOrFail($id);

        $this->validate($request, [
            //Para Tabela Equipamento
            'nome' => 'required',
            'tipoServico' => 'required',
            'equipamentoSigla' => 'required',
            'identificacaoSecretaria' => 'required',
            'subordinacaoAdministrativa' => 'required',
            'tematico' => 'nullable',
            'nome_tematica' => 'nullable',
            'telefone' => 'required|max:15',
            'telecentro' => 'required',
            'acervoespecializado' => 'required',
            'nucleobraile' => 'required',
            'status' => 'required',
            'observacao' => 'nullable',

            //Para Tabela Endereço
            'cep' => 'required',
            'logradouro' => 'nullable',
            'bairro' => 'nullable',
            'numero' => 'required|numeric',
            'complemento' => 'nullable',
            'cidade' => 'nullable',
            'uf' => 'nullable|max:2',
            'prefeituraRegional' => 'nullable',
            'distrito' => 'nullable',
            'macrorregiao' => 'nullable',
            'regiao' => 'nullable',
            'regional' => 'nullable',

            //Para a tabela funcionamento
            'horarioAbertura' => 'required',
            'horarioFechamento' => 'required'
        ]);

        $equipamento->update([
            'nome' => $request->nome,
            'tipo_servico_id' => $request->tipoServico,
            'equipamento_sigla' => $request->equipamentoSigla,
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

        $funcionamento = new Funcionamento();
        foreach ($request->input('funcionamento') as $key => $value) {
            $funcionamento->updateOrCreate(['id' => $request->input("funcionamento.{$key}")], [
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

        return redirect()->back()->with('flash_message',
            'Equipamento editado com sucesso!');

        /*TODO: remover um funcionamento*/
    }

    public function removeFuncionamento($id)
    {
        Funcionamento::findOrFail($id)->update(['publicado' => 0]);

        return redirect()->back()->with('flash_message', 'Funcionamento excluído com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $types)
    {
        $type = $types->type;

        Equipamento::findOrFail($id)
            ->update(['publicado' => 0]);

        return redirect()->route('equipamentos.index', ['type' => $type])
            ->with('flash_message',
                'Equipamento excluido com sucesso.');
    }

    public function criaDetalhes($id)
    {
        $equipamento = Equipamento::find($id);

        $contratos = ContratoUso::all();
        $utilizacoes = Utilizacao::all();
        $portes = Porte::all();
        $padroes = Padrao::all();
        $arquitetonicas = AcessibilidadeArquitetonica::all();
        $elevadores = Elevador::all();
        $pracaClassificacoes = Classificacao::all();

        return view('gerencial.equipamentos.detalhestecnicos', compact(
            'equipamento',
            'contratos',
            'utilizacoes',
            'portes',
            'padroes',
            'arquitetonicas',
            'elevadores',
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
            'pavimento' => 'required|numeric'
        ]);

        $dt = $request->validade;
        $data = explode('/', $dt);
        $dataValidade = $data[2].'-'.$data[1].'-'.$data[0];

        $this->validate($request, [
            'acessibilidadeArquitetonica' => 'required',
            'elevador' => 'required',
            'qtdVagasAcessiveis' => 'required'
        ]);

        $acessibilidade = new Acessibilidade();

        $acessibilidade_id = $acessibilidade->create([
            'acessibilidade_arquitetonica_id' => $request->acessibilidadeArquitetonica,
            'banheiros_adaptados' => $request->banheiros,
            'rampas_acesso' => $request->rampas,
            'elevador_id' => $request->elevador,
            'piso_tatil' => $request->pisoTatil,
            'estacionamento_acessivel' => $request->estacionamentoAcessivel,
            'quantidade_vagas' => $request->qtdVagasAcessiveis
        ]);

        $insertEquipamento = $equipamento->detalhe()->create([
            'contrato_uso_id' => $request->contratoUso,
            'utilizacao_id' => $request->utilizacao,
            'porte_id' => $request->porte,
            'padrao_id' => $request->padrao,
            'pavimento' => $request->pavimento,
            'acessibilidade_id' => $acessibilidade_id->id,
            'validade_avcb' => $dataValidade,
            'predio_tombado' => $request->predioTombado,
            'lei' => $request->lei
        ]);

        //para abrir a tab correspondente
        session(['tabName' => "detalhes-tecnicos"]);

        if($insertEquipamento && $acessibilidade)
            return redirect()->route('equipamentos.show', $id)->with('flash_message', 'Detalhe cadastrado com sucesso');
        else
            return redirect()->back()->with('flash_message', 'Erra ao cadastrar');
    }

    public function atualizaDetalhes(Request $request, $id)
    {
        $equipamento = Equipamento::find($id);

        $detalhes = $this->validate($request, [
            'contratoUso' => 'required',
            'utilizacao' => 'required',
            'porte' => 'required',
            'padrao' => 'required',
            'pavimento' => 'required|numeric',
            'validade' => 'required'
        ]);

        $dt = $request->validade;
        $data = explode('/', $dt);
        $dataValidade = $data[2].'-'.$data[1].'-'.$data[0];

        $this->validate($request, [
            'acessibilidadeArquitetonica' => 'required',
            'qtdVagasAcessiveis' => 'nullable'
        ]);

        $acessibilidade_id = $equipamento->detalhe->acessibilidade_id;
        $acessibilidade = Acessibilidade::find($acessibilidade_id);

        $acessibilidade->update([
            'acessibilidade_arquitetonica_id' => $request->acessibilidadeArquitetonica,
            'banheiros_adaptados' => $request->banheiros,
            'rampas_acesso' => $request->rampas,
            'elevador_id' => $request->elevador,
            'piso_tatil' => $request->pisoTatil,
            'estacionamento_acessivel' => $request->estacionamentoAcessivel,
            'quantidade_vagas' => $request->qtdVagasAcessiveis
        ]);

        $equipamento->detalhe()->update([
            'contrato_uso_id' => $request->contratoUso,
            'utilizacao_id' => $request->utilizacao,
            'porte_id' => $request->porte,
            'padrao_id' => $request->padrao,
            'pavimento' => $request->pavimento,
            'acessibilidade_id' => $acessibilidade_id,
            'validade_avcb' => $dataValidade,
            'predio_tombado' => $request->predioTombado,
            'lei' => $request->lei
        ]);

        //para abrir a tab correspondente
        session(['tabName' => "detalhes-tecnicos"]);

        return redirect()->route('equipamentos.show', $id)->with('flash_message', 'Detalhe atualizado com sucesso');

    }

    public function criaCapacidade($id)
    {
        $equipamento = Equipamento::find($id);

        $pracaClassificacoes = Classificacao::all();

        return view('gerencial.equipamentos.capacidade', compact(
            'equipamento',
            'pracaClassificacoes'
        ));
    }

    public function gravaCapacidade(Request $request, $id)
    {
        $equipamento = Equipamento::findOrFail($id);

        $equipamento->equipamentoCapacidade()->create([
            'capacidade'=> $request->novo
        ]);

        //para abrir a tab correspondente
        session(['tabName' => "capacidade"]);

        return redirect()->route('equipamentos.show', $id)->with('flash_message', 'Capacidade cadastrada com sucesso');
    }

    public function gravaAuditorio(Request $request, $id){

        $equipamento = Equipamento::findOrFail($id);

        $insert = $equipamento->auditorio()->create([
            'nome'=>$request->input('nome'),
            'capacidade'=>$request->input('capacidade')
        ]);

        //para abrir a tab correspondente
        session(['tabName' => "capacidade"]);

        if ($insert)
            return redirect()->route('equipamentos.show', $id)->with('flash_message', 'Auditório cadastrada com sucesso');
        else
            return redirect()->back()->with('flash_message', 'Erra ao cadastrar');
    }

    public function gravaEstacionamento(Request $request, $id){

        $equipamento = Equipamento::findOrFail($id);

        $equipamento->estacionamento()->create([
            'interno'=>$request->input('interno'),
            'externo'=>$request->input('externo')
        ]);

        //para abrir a tab correspondente
        session(['tabName' => "detalhes-tecnicos"]);

        return redirect()->route('equipamentos.show', $id)->with('flash_message', 'Estacionamento cadastrada com sucesso');
    }

    public function gravaPraca(Request $request, $id){

        $equipamento = Equipamento::findOrFail($id);

        $praca = new Praca();

        $praca->equipamento_id = $equipamento->id;
        $praca->praca = $request->input('praca');
        $praca->praca_classificacao_id = $request->input('classificacao');
        if ($praca->praca == 0) $praca->praca_classificacao_id = 1; //caso nao tenha praça
        $praca->save();

        //para abrir a tab correspondente
        session(['tabName' => "detalhes-tecnicos"]);

        return redirect()->route('equipamentos.show', $id)->with('flash_message', 'Praça cadastrada com sucesso');
    }

    public function gravaEstudoGrupo(Request $request, $id){

        $equipamento = Equipamento::findOrFail($id);

        $equipamento->estudoGrupo()->create([
            'capacidade'=>$request->input('novo'),
            'especificacao' => $request->especificacao
        ]);

        //para abrir a tab correspondente
        session(['tabName' => "capacidade"]);

        return redirect()->route('equipamentos.show', $id)->with('flash_message', 'Espaço de estudo em grupo cadastrado com sucesso');
    }

    public function gravaEstudoIndividual(Request $request, $id){

        $equipamento = Equipamento::findOrFail($id);

        $equipamento->estudoIndividual()->create([
            'quantidade'=>$request->input('novo'),
            'especificacao' => $request->especificacao
        ]);

        //para abrir a tab correspondente
        session(['tabName' => "capacidade"]);

        return redirect()->route('equipamentos.show', $id)->with('flash_message', 'Espaço de estudo individual cadastrado com sucesso');
    }

    public function gravaSalaComum(Request $request, $id){

        $equipamento = Equipamento::findOrFail($id);

        $equipamento->salaComum()->create([
            'quantidade' => $request->input('novo'),
            'especificacao' => $request->especificacao
        ]);

        //para abrir a tab correspondente
        session(['tabName' => "capacidade"]);

        return redirect()->route('equipamentos.show', $id)->with('flash_message', 'Espaço de uso comum cadastrado com sucesso');
    }

    public function gravaTelecentro(Request $request, $id){

        $equipamento = Equipamento::findOrFail($id);

        $equipamento->telecentroDiglab()->create([
            'quantidade'=>$request->input('novo')
        ]);

        //para abrir a tab correspondente
        session(['tabName' => "capacidade"]);

        return redirect()->route('equipamentos.show', $id)->with('flash_message', 'Telecentro/DigiLab cadastrado com sucesso');
    }

    public function gravaSalaInfantil(Request $request, $id){

        $equipamento = Equipamento::findOrFail($id);

        $equipamento->infantil()->create([
            'capacidade'=>$request->input('novo'),
            'especificacao' => $request->especificacao
        ]);

        //para abrir a tab correspondente
        session(['tabName' => "capacidade"]);

        return redirect()->route('equipamentos.show', $id)->with('flash_message', 'Espaço infantil cadastrada com sucesso');
    }

    public function gravaSalaMultiuso(Request $request, $id){

        $equipamento = Equipamento::findOrFail($id);

        $equipamento->multiuso()->create([
            'capacidade'=>$request->input('novo'),
            'especificacao' => $request->especificacao
        ]);

        //para abrir a tab correspondente
        session(['tabName' => "capacidade"]);

        return redirect()->route('equipamentos.show', $id)->with('flash_message', 'Espaço Multiuso cadastrado com sucesso');
    }

    public function gravaTeatro(Request $request, $id){

        $equipamento = Equipamento::findOrFail($id);

        $equipamento->teatro()->create([
            'nome'=>$request->input('nome'),
            'capacidade'=>$request->input('capacidade')
        ]);

        //para abrir a tab correspondente
        session(['tabName' => "capacidade"]);

        return redirect()->route('equipamentos.show', $id)->with('flash_message', 'Teatro cadastrado com sucesso');
    }

    public function criaArea($id)
    {
        $equipamento = Equipamento::find($id);

        return view('gerencial.equipamentos.area', compact('equipamento'));
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
            'total_terreno' => $request->areaTotalTerreno,
            'especificacao' => $request->especificacao
        ]);

        //para abrir a tab correspondente
        session(['tabName' => "area"]);

        return redirect()->route('equipamentos.show', $id)->with('flash_message', 'Área cadastrada com sucesso');
    }

    public function atualizaArea(Request $request, $id)
    {
        $equipamento = Equipamento::find($id);

        $this->validate($request, [
            'areaInterna' => 'required|numeric',
            'areaTotalConstruida' => 'required|numeric',
            'areaTotalTerreno' => 'required|numeric',
            'areaAuditorio' => 'nullable|numeric',
            'areaTeatro' => 'nullable|numeric'
        ]);

        $equipamento->area()->update([
            'interna' => $request->areaInterna,
            'auditorio' => $request->areaAuditorio,
            'teatro' => $request->areaTeatro,
            'total_construida' => $request->areaTotalConstruida,
            'total_terreno' => $request->areaTotalTerreno,
            'especificacao' => $request->especificacao
        ]);

        return redirect()->route('equipamentos.show', $id)->with('flash_message', 'Área atualizada com sucesso');
    }

    public function criaReforma($id)
    {
        $equipamento = Equipamento::find($id);

        return view('gerencial.equipamentos.reforma', compact('equipamento'));
    }

    public function gravaReforma(Request $request, $id)
    {
        $equipamento = Equipamento::find($id);
        $user = Auth::user();

        $this->validate($request, [
            'inicioReforma' => 'required|after:terminoReforma',
            'terminoReforma' => 'nullable',
            'descricaoReforma' => 'required'
        ]);

        $dtInicio = $request->inicioReforma;
        $dataInicio = date("Y-m-d",strtotime($dtInicio));

        $dtTermino = $request->terminoReforma;
        $dataTermino = explode('/', $dtTermino);
        $data = $dataTermino[2].'-'.$dataTermino[1].'-'.$dataTermino[0];

        $equipamento->reformas()->create([
            'user_id' => $user->id,
            'inicio_reforma' => $dataInicio,
            'termino_reforma' => $data,
            'descricao' => $request->descricaoReforma
        ]);

        session(['tabName' => "reforma"]);

        return redirect()->route('equipamentos.show', $id)->with('flash_message', 'Período de reforma incluido com sucesso');
    }


    public function ativarEquipamento(Request $request)
    {
        Equipamento::findOrFail($request->id)
            ->update(['publicado' => 1]);

        return redirect()->route('equipamentos.index', ['type' => $request->type])
            ->with('flash_message',
                'Usuário ativado com sucesso.');
    }

    // Filtro de Equipamentos
    public function searchEquipamento(Request $request, Equipamento $equipamento)
    {
        $dataForm = $request->except('_token');

        $type = $request->types;

        $siglas = EquipamentoSigla::all();

        $equipamentos = $equipamento->search($dataForm)->orderBy('nome')->paginate(10);

        return view('gerencial.equipamentos.index', compact('dataForm', 'equipamentos', 'siglas', 'type'));
    }

    public function equipamentoOcorrencia(Request $request)
    {

        $equipamento = Equipamento::findOrFail($request->idEquipamento);

        $data = $this->validate($request,
            [
                'data' => 'required',
                'ocorrencia' => 'required',
                'observacao' => 'required'

            ]);

        $user = Auth::user()->id;


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
        $count = EquipamentoOcorrencia::where('equipamento_id', $id)->get()->count();

        return response()->json($count);

        // dd($count);
    }

    public function editPortaria($id)
    {
        $equipamento = Equipamento::findOrFail($id);
        if ($equipamento->portaria == 1) {
            $equipamento->update(['portaria' => 0]);
            return redirect()->route('equipamentos.show', $id)->with('flash_message', 'Formulário atualizado para o simples.');
        } else {
            $equipamento->update(['portaria' => 1]);
            return redirect()->route('equipamentos.show', $id)->with('flash_message', 'Formulário atualizado para o completo.');
        }
    }

    public function alterarFormulario(Request $request){

        $biblioteca = $request->biblioteca;
        $onibus = $request->onibus;
        $tipoForm = $request->tipoForm;

        if ($biblioteca && $onibus){
            if ($tipoForm == 'on'){
                Equipamento::where('publicado',1)->update(['portaria'=>1]);
                return redirect()->back()->with('flash_message', 'Alterado para Formulário Completo.');
            }
            else{
                Equipamento::where('publicado',1)->update(['portaria'=>0]);
                return redirect()->back()->with('flash_message', 'Alterado para Formulário Simples.');
            }
        }elseif ($biblioteca){
            if ($tipoForm == 'on'){
                Equipamento::where('tipo_servico_id','!=',4)->update(['portaria'=>1]);
                return redirect()->back()->with('flash_message', '  Alterado Biblioteca para Formulário Completo.');
            }
            else{
                Equipamento::where('tipo_servico_id','!=',4)->update(['portaria'=>0]);
                return redirect()->back()->with('flash_message', 'Alterado Biblioteca para Formulário Simples.');
            }
        }elseif($onibus){
            if ($tipoForm == 'on'){
                Equipamento::where('tipo_servico_id',4)->update(['portaria'=>1]);
                return redirect()->back()->with('flash_message', 'Alterado Ônibus para Formulário Completo.');
            }
            else{
                Equipamento::where('tipo_servico_id',4)->update(['portaria'=>0]);
                return redirect()->back()->with('flash_message', 'Alterado Ônibus para Formulário Simples.');
            }
        }
        return redirect()->back()->with('flash_message_danger','Selecione um tipo de equipamento');
    }

    public function editPortariaLote($id)
    {
        $equipamento = Equipamento::findOrFail($id);
        if ($equipamento->portaria == 1) {
            $equipamento->update(['portaria' => 0]);
            return redirect()->route('equipamentos.lote')->with('flash_message', 'Formulário atualizado para o simples.');
        } else {
            $equipamento->update(['portaria' => 1]);
            return redirect()->route('equipamentos.lote')->with('flash_message', 'Formulário atualizado para o completo.');
        }
    }

    public function listaTrocaEquipamentos()
    {
        $equipamentos = Equipamento::where('publicado', '=', '1')->orderBy('nome')->get();
        return view('gerencial.gerenciar.loteEquipamentos', compact('equipamentos'));
    }

}