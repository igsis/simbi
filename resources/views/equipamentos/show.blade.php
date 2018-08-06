@extends ('layouts.master')

@section('conteudo')

    <div class="container">
        <div style="text-align: center;">
            <h2>
                Detalhes<br>
                <small>{{$equipamento->nome}}</small>
            </h2>
        </div>
        <hr>

        <div class="col-md-offset-1 col-md-10">
            <div class="panel panel-default panel-table">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col text-right">
                            @hasanyrole('Coordenador|Administrador')
                                @hasrole('Administrador')
                                    <a href="{{ route('equipamentos.editar', $equipamento->id) }}" class="btn btn-success">Editar Equipamento</a>
                                @endhasrole
                            @endhasanyrole
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <!--LABELS-->

                    <div>
                        <div role="tabpanel">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#dados-equipamento" data-toggle="tab">Dados do Equipamento</a>
                                </li>
                                <li>
                                    <a href="#ocorrencia" data-toggle="tab">Ocorrências</a>
                                </li>
                                <li>
                                    <a href="#dados-endereco" data-toggle="tab">Dados do Endereço</a>
                                </li>
                                <li>
                                    <a href="#reformas" data-toggle="tab">Reformas</a>
                                </li>

                                <!--DROPMENU-->
                               <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        Dados do Edifício <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#detalhes-tecnicos" data-toggle="tab">Detalhes Técnicos</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="#capacidade" data-toggle="tab">Capacidade</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="#area" data-toggle="tab">Área (m²)</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="tab-content">
                        <!--Label Dados Equipamentos-->
                        <div role="tabpanel" class="tab-pane fade in active" id="dados-equipamento">
                                
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th colspan="2" class="text-center">Dados do Equipamento</th>
                                    </tr>
                                    <tr>
                                        <th width="30%">Nome:</th>
                                        <td>{{$equipamento->nome}}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Tipo de Serviço:</th>
                                        <td>{{$equipamento->tipoServico->descricao}}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Sigla do Equipamento:</th>
                                        <td>{{$equipamento->equipamentoSigla->sigla}}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Telefone:</th>
                                        <td>{{$equipamento->telefone}}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Identificação da Secretaria:</th>
                                        <td>{{$equipamento->secretaria->descricao}}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Subordinação Administrativa:</th>
                                        <td>{{$equipamento->subordinacaoAdministrativa->descricao}}</td>
                                    </tr>

                                @if ($equipamento->tematico == 1)
                                    <tr>
                                        <th width="30%">Equipamento Temático:</th>
                                        <td>Sim</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Nome da Temática:</th>
                                        <td>{{$equipamento->nome_tematica}}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <th width="30%">Equipamento Temático:</th>
                                        <td>Não</td>
                                    </tr>
                                @endif

                                    <tr>
                                        <th width="30%">Telecentro:</th>
                                        <td>
                                            @if ($equipamento->telecentro == 0)
                                                Não
                                            @else
                                                Sim
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Acervo Especializado:</th>
                                        <td>
                                            @if ($equipamento->acervo_especializado == 0)
                                                Não
                                            @else
                                                Sim
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Núcleo Braile:</th>
                                        <td>
                                            @if ($equipamento->nucleo_braile == 0)
                                                Não
                                            @else
                                                Sim
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Status:</th>
                                        <td>{{$equipamento->status->descricao}}</td>
                                    </tr>    
                                </tbody>
                            </table>
                        </div>

                        <div role="tabpanel" class="tab-pane fade in" id="ocorrencia">

                           <!--Label Ocorrencia-->
                           <table class="table table-bordered">
                               <tbody>
                                        @if ($equipamento->ocorrencias->count() != 0)
                                        <tr>
                                            <th colspan="2" class="text-center">Ocorrências</th>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                @foreach ($equipamento->ocorrencias as $ocorrencia)
                                                <div class="list-group-item">
                                                    <strong>{{ date('d/m/Y', strtotime($ocorrencia->data)) }}</strong><br>
                                                    <label>Usuário: </label> {{$ocorrencia->user->name}}<br>
                                                    <label>Ocorrência: </label> {{$ocorrencia->ocorrencia}}<br>
                                                    <label>Observação: </label> {{$ocorrencia->observacao}}
                                                </div>
                                                @endforeach
                                            </td>
                                        </tr>
                                        @else
                                            <tr>
                                                <th colspan="2" class="text-center">Não ha ocorrências cadastradas</th>
                                            </tr>
                                        @endif
                                </tbody>
                            </table>
                        </div>

                        <div role="tabpanel" class="tab-pane fade in" id="dados-endereco">
                            <!--Label Dados Endereço-->
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th colspan="2" class="text-center">Dados do Endereço</th>
                                    </tr>

                                    <tr>
                                        <th width="30%">Endereço:</th>
                                        <td>{{$equipamento->endereco->logradouro}}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Bairro:</th>
                                        <td>{{$equipamento->endereco->bairro}}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Número:</th>
                                        <td>{{$equipamento->endereco->numero}}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Complemento:</th>
                                        <td>{{$equipamento->endereco->complemento}}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">CEP:</th>
                                        <td>{{$equipamento->endereco->cep}}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Cidade:</th>
                                        <td>{{$equipamento->endereco->cidade}}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">UF:</th>
                                        <td>{{$equipamento->endereco->estado}}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Prefeitura Regional:</th>
                                        <td>{{$equipamento->endereco->prefeituraRegional->descricao}}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Distrito:</th>
                                        <td>{{$equipamento->endereco->distrito->descricao}}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Macrorregião:</th>
                                        <td>{{$equipamento->endereco->macrorregiao->descricao}}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Região:</th>
                                        <td>{{$equipamento->endereco->regiao->descricao}}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Regional:</th>
                                        <td>{{$equipamento->endereco->regional->descricao}}</td>
                                    </tr>
                                </tbody>
                            </table>                      
                        </div>

                        <div role="tabpanel" class="tab-pane fade in" id="reformas">
                            <!--Label Reformas-->
                            <div class="col text-center botao-margem">
                                @hasanyrole('Coordenador|Administrador')
                                    <a href="{{ route('equipamentos.criaReforma', $equipamento->id) }}" class="btn btn-success">Inserir Reforma</a>
                                @endhasanyrole 
                            </div>
                            <table class="table table-bordered">
                                <tbody>
                                    @if ($equipamento->reformas->count() != 0)
                                        <tr>
                                            <th colspan="2" class="text-center">Reformas</th>
                                        </tr>
                                        <tr>
                                            <td colspan="5">
                                                @foreach ($equipamento->reformas as $reforma)
                                                    <div class="list-group-item">
                                                        <label>Inicio da Reforma: </label> {{ date('d/m/Y', strtotime($reforma->inicio_reforma)) }} <br>
                                                        <label>Fim da Reforma : </label> {{ date('d/m/Y', strtotime($reforma->termino_reforma)) }} <br>
                                                        <label>Descrição da Reforma</label> {{ $reforma->descricao }} <br>
                                                        {{--<label>Usuário: </label>--}} {{--TODO: Adicionar usuario--}}
                                                    </div>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <th colspan="2" class="text-center">Não ha reformas cadastradas</th>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div role="tabpanel" class="tab-pane fade in" id="detalhes-tecnicos">
                            <!--Label Detalhes Tecnicos-->
                            <div class="col text-center botao-margem">
                                @hasanyrole('Coordenador|Administrador')
                                <a href="{{ route('equipamentos.criaDetalhes', $equipamento->id) }}" class="btn btn-success">Inserir Detalhes Técnicos</a>
                                @endhasanyrole
                            </div>
                            <table class="table table-bordered">
                                <tbody>
                                    @if (isset ($equipamento->detalhe))
                                        <tr>
                                            <th colspan="2" class="text-center">Detalhes Técnicos</th>
                                        </tr>
                                        
                                        <tr>
                                            <th width="30%">Contrato de Uso:</th>
                                            <td>{{ $equipamento->detalhe->contratoUso->contrato_uso }}</td>
                                        </tr>
                                        <tr>
                                            <th width="30%">Utilização:</th>
                                            <td>{{ $equipamento->detalhe->utilizacao }}
                                            {{--TODO: problema no relacionamento utilizacao e de mais--}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%">Porte:</th>
                                            <td>{{ $equipamento->detalhe->porte }}</td>
                                            {{--TODO: problema no relacionamento porte e de mais--}}
                                        </tr>
                                        <tr>
                                            <th width="30%">Padrão:</th>
                                            <td>{{ $equipamento->detalhe->padrao }}</td>
                                            {{--TODO: problema no relacionamento padrao e de mais--}}
                                        </tr>
                                        <tr>
                                            <th width="30%">Pavimentos:</th>
                                            <td>{{ $equipamento->detalhe->pavimento }}</td>
                                        </tr>
                                        <tr>
                                            <th width="30%">Validade AVBC:</th>
                                            <td>{{ date('d/m/Y', strtotime($equipamento->detalhe->validade_avcb)) }}</td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th colspan="2" class="text-center">Detalhes de Acessibilidade</th>
                                            </tr>
                                            <tr>
                                                <th width="30%">Acessibilidade Arquitetonica:</th>
                                                <td>{{ $equipamento->detalhe->acessibilidade->acessibilidadeArquitetonica->acessibilidade_arquitetonica }}</td>
                                            </tr>
                                            <tr>
                                                <th width="30%">Banheiros Adaptados: </th>
                                                <td>
                                                    @if ($equipamento->detalhe->acessibilidade->banheiros_adaptados == 0)
                                                        Não
                                                    @else
                                                        Sim
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th width="30%">Rampas de Acesso: </th>
                                                <td>
                                                    @if ($equipamento->detalhe->acessibilidade->rampas_acesso == 0)
                                                        Não
                                                    @else
                                                        Sim
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th width="30%">Elevador: </th>
                                                <td>
                                                    @if ($equipamento->detalhe->acessibilidade->elevador == 0)
                                                        Não
                                                    @else
                                                        Sim
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th width="30%">Piso Tátil: </th>
                                                <td>
                                                
                                                    @if ($equipamento->detalhe->acessibilidade->piso_tatil == 0)
                                                        Não
                                                    @else
                                                        Sim
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th width="30%">Estacionamento Acessivel: </th>
                                                <td>
                                                    @if ($equipamento->detalhe->acessibilidade->estacionamento_acessivel == 0)
                                                        Não
                                                    @else
                                                        Sim
                                                    @endif                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <th width="30%">Quantidade de Vagas: </th>
                                                <td>{{ $equipamento->detalhe->acessibilidade->quantidade_vagas }}</td>
                                            </tr>
                                    @else 
                                        <tr>
                                            <th colspan="2" class="text-center">Não ha detalhes cadastrados</th>
                                        </tr>
                                    @endif
                                        </tbody>
                                </table>
                        </div>

                        <div role="tabpanel" class="tab-pane fade in" id="capacidade">
                            <!--Label Capacidade-->
                            <div class="col text-center botao-margem">
                                @hasanyrole('Coordenador|Administrador')
                                <a href="{{ route('equipamentos.criaCapacidade', $equipamento->id) }}" class="btn btn-success">Inserir Capacidades</a>
                                @endhasanyrole
                            </div>
                            <table class="table table-bordered">
                                <tbody>
                                    @if (isset($equipamento->capacidade))
                                        <tr>
                                            <th colspan="2" class="text-center">Capacidade</th>
                                        </tr>
                                    @else
                                        <tr>
                                            <th colspan="2" class="text-center">Não ha capacidade cadastrada</th>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div role="tabpanel" class="tab-pane fade in" id="area">
                            <!--Label Area-->
                            <div class="col text-center botao-margem">
                                @hasanyrole('Coordenador|Administrador')
                                <a href="{{ route('equipamentos.criaArea', $equipamento->id) }}" class="btn btn-success">Inserir Áreas</a>
                                @endhasanyrole
                            </div>
                            <table class="table table-bordered">
                                <tbody>
                                    @if (isset($equipamento->area))
                                        <tr>
                                            <th colspan="2" class="text-center">Área (m²)</th>
                                        </tr>
                                        <tr>
                                            <th width="30%">Área Interna: </th>
                                            <td>{{ $equipamento->area->interna }}</td>
                                        </tr>
                                        <tr>
                                            <th width="30%">Área Auditório: </th>
                                            <td>{{ $equipamento->area->auditorio }}</td>
                                        </tr>
                                        <tr>
                                            <th width="30%">Área do Teatro: </th>
                                            <td>{{ $equipamento->area->teatro }}</td>
                                        </tr>
                                        <tr>
                                            <th width="30%">Área Total Construída: </th>
                                            <td>{{ $equipamento->area->total_construida }}</td>
                                        </tr>
                                        <tr>
                                            <th width="30%">Área Total Terreno: </th>
                                            <td>{{ $equipamento->area->total_terreno }}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <th colspan="2" class="text-center">Não ha areas cadastradas</th>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="form-group col-md-offset-4 col-md-4">
            <a href="{{route('equipamentos.index', ['type' => '1'])}}" class="form-control btn btn-warning">
                Retornar à Lista de Equipamentos
            </a>
        </div>
    </div>

@endsection