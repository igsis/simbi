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
                                    <a href="{{ route('equipamentos.criaDetalhes', $equipamento->id) }}" class="btn btn-success">Editar Detalhes Técnicos</a>
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
                                    <tr>
                                        <th colspan="2" class="text-center">Reformas</th>
                                    </tr>
                                    @foreach ($equipamento->reformas as $reforma)
                                        <tr>
                                            <th width="30%">Inicio da Reforma:</th>

                                            <td>{{ date('d/m/Y', strtotime($reforma->inicio_reforma)) }}</td>
                                        </tr>
                                        <tr>
                                            <th width="30%">Fim da Reforma:</th>
                                            <td>{{ date('d/m/Y', strtotime($reforma->termino_reforma)) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Descrição da Reforma:</th>
                                            <td>{{$reforma->descricao}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div role="tabpanel" class="tab-pane fade in" id="detalhes-tecnicos">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th colspan="2" class="text-center">Detalhes Técnicos</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div role="tabpanel" class="tab-pane fade in" id="capacidade">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th colspan="2" class="text-center">Capacidade</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div role="tabpanel" class="tab-pane fade in" id="area">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th colspan="2" class="text-center">Área (m²)</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection