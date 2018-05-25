@extends ('layouts.master')

@section('conteudo')

    <div class="container">
        {{--TODO: Alterar exibição para uma tabela responsiva--}}
        <div style="text-align: center;">
            <h2>
                Detalhes do Equipamento<br>
                <small>{{$equipamento->nome}}</small>
            </h2>
        </div>
        <hr>

        {{--<div class="col-md-offset-1 col-md-10">
            <div class="panel panel-default panel-table">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col col-xs-6">
                            <h3 class="panel-title">{{$equipamento->nome}}</h3>
                        </div>
                        <div class="col col-xs-6 text-right">
                            <a href="{{ route('equipamentos.editar', $equipamento->id) }}" class="btn btn-success">Editar Equipamento</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th width="30%">Nome:</th>
                                <td>{{$equipamento->nome}}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>--}}

        <div class="col-md-offset-2 col-md-8">
            <div class="well">
                <strong>Nome: </strong>{{$equipamento->nome}}<br>
                <strong>Tipo de Serviço: </strong>{{$equipamento->tipoServico->descricao}}<br>
                <strong>Sigla do Equipamento: </strong>{{$equipamento->equipamentoSigla->sigla}}<br>
                <strong>Identificação da Secretaria: </strong>{{$equipamento->secretaria->descricao}}<br>
                <strong>Subordinação Administrativa: </strong>{{$equipamento->subordinacaoAdministrativa->descricao}}<br>

                <strong>Equipamento Temático: </strong>
                    @if ($equipamento->tematico == 0)
                        Não<br>
                    @else
                        Sim<br>
                        <strong>Nome da Temática: </strong>{{$equipamento->nomeTematica}}<br>
                    @endif

                <strong>Telefone: </strong>{{$equipamento->telefone}}<br>

                <strong>Telecentro: </strong>
                    @if ($equipamento->telecentro == 0)
                        Não<br>
                    @else
                        Sim<br>
                    @endif

                <strong>Acervo Especializado: </strong>
                    @if ($equipamento->acervo_especializado == 0)
                        Não<br>
                    @else
                        Sim<br>
                    @endif

                <strong>Núcleo Braile: </strong>
                    @if ($equipamento->nucleo_braile == 0)
                        Não<br>
                    @else
                        Sim<br>
                    @endif

                <strong>Status: </strong>{{$equipamento->status->descricao}}<br>
                <hr>
                <strong>Endereço: </strong>{{$equipamento->endereco->logradouro}}<br>
                <strong>Bairro: </strong>{{$equipamento->endereco->bairro}}<br>
                <strong>Número: </strong>{{$equipamento->endereco->numero}}<br>
                <strong>Complemento: </strong>{{$equipamento->endereco->complemento}}<br>
                <strong>CEP: </strong>{{$equipamento->endereco->cep}}<br>
                <strong>Cidade: </strong>{{$equipamento->endereco->cidade}}<br>
                <strong>Estado: </strong>{{$equipamento->endereco->estado}}<br>
                <strong>Subprefeitura: </strong>{{--TODO: Adicionar relacionamento para Subprefeitura--}}<br>
                <strong>Distrito: </strong>{{--TODO: Adicionar relacionamento para Distrito--}}<br>
                <strong>Macrorregião: </strong>{{$equipamento->endereco->macrorregiao->descricao}}<br>
                <strong>Região: </strong>{{$equipamento->endereco->regiao->descricao}}<br>
                <strong>Regional: </strong>{{$equipamento->endereco->regional->descricao}}<br>
            </div>

            @hasrole('Administrador')
                <a href="{{ route('equipamentos.editar', $equipamento->id) }}" class="btn btn-success">Editar Equipamento</a>
            @endhasrole
        </div>
    </div>

@endsection