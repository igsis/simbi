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
                                <a href="{{ route('equipamentos.criaReforma', $equipamento->id) }}" class="btn btn-success">Inserir Reforma</a>
                                @hasrole('Administrador')
                                    <a href="{{ route('equipamentos.editar', $equipamento->id) }}" class="btn btn-success">Editar Equipamento</a>
                                    <a href="{{ route('equipamentos.criaDetalhes', $equipamento->id) }}" class="btn btn-success">Editar Detalhes Técnicos</a>
                                @endhasrole
                            @endhasanyrole
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    {{--TODO: Alterar exibição para Labels--}}
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
                                <th width="30%">Subprefeitura:</th>
                                <td>{{--TODO: Adicionar relacionamento para Subprefeitura--}}</td>
                            </tr>
                            <tr>
                                <th width="30%">Distrito:</th>
                                <td>{{--TODO: Adicionar relacionamento para Distrito--}}</td>
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
            </div>
        </div>
    </div>

@endsection