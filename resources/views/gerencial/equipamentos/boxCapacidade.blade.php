<div class="tab-pane {{ session('tabName') == 'capacidade' ? 'active' : '' }}" id="capacidade">
    <!--Label Capacidade-->

    @hasanyrole('Coordenador|Administrador')
    @if(isset($equipamento->auditorio) || isset($equipamento->estacionamento) || isset($equipamento->praca) || isset($equipamento->estudoGrupo) || isset($equipamento->estudoIndiviudal) || isset($equipamento->infantil) || isset($equipamento->multiuso) || isset($equipamento->teatro))
        <div>
            <div role="tabpanel">
                <ul class="nav nav-tabs">
                    <li class="dropdown">
{{--                        <a href="#" class="dropdown-toggle label-primary" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: white">--}}
{{--                            Editar <span class="caret"></span>--}}
{{--                        </a>--}}
                        <ul class="dropdown-menu">
                            @if (isset($equipamento->equipamentoCapacidade))
                                <li><a href="#">Capacidade do Equipamento</a></li>
                                <li role="separator" class="divider"></li>
                            @endif
                            @if(isset($equipamento->auditorio))
                                <li><a href="#">Auditório</a></li>
                                <li role="separator" class="divider"></li>
                            @endif

                            @if(isset($equipamento->estacionamento))
                                <li><a href="#">Estacionamento</a></li>
                                <li role="separator" class="divider"></li>
                            @endif

                            @if(isset($equipamento->praca))
                                <li><a href="#">Praça</a></li>
                                <li role="separator" class="divider"></li>
                            @endif

                            @if(isset($equipamento->estudoGrupo))
                                <li><a href="#">Saka de Estudo em Grupo</a></li>
                                <li role="separator" class="divider"></li>
                            @endif

                            @if(isset($equipamento->estudoIndividual))
                                <li><a href="#">Espaço de Estudo Individual</a></li>
                                <li role="separator" class="divider"></li>
                            @endif

                            @if(isset($equipamento->infantil))
                                <li><a href="#">Espaço Infantil</a></li>
                                <li role="separator" class="divider"></li>
                            @endif

                            @if(isset($equipamento->multiuso))
                                <li><a href="#">Espaço Multiuso</a></li>
                                <li role="separator" class="divider"></li>
                            @endif

                            @if(isset($equipamento->teatro))
                                <li><a href="#">Teatro</a></li>
                                <li role="separator" class="divider"></li>
                            @endif

                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    @endif
    @endhasanyrole

    <table class="table table-bordered">
        <tbody>
        <tr>
            <th colspan="2" class="text-center">Capacidade de Público do Equipamento</th>
        </tr>
            <tr>
                <th width="50%" class="text-center">Capacidade máxima de pessoas no equipamento: </th>
                <td class="text-center">{{ $capacidadeTotal }}</td>
            </tr>
        </tbody>
    </table>

    <table class="table table-bordered">
            <th colspan="2" class="text-center">ÁREA INTERNA</th>
    </table>


    <table class="table table-bordered">
        <tbody>
        <tr>
            <th colspan="2" class="text-center">Auditório</th>
        </tr>
        @if (isset($equipamento->auditorio))
            <tr>
                <th class="text-center" width="50%">Nome: </th>
                <td class="text-center">{{ $equipamento->auditorio->nome }}</td>
            </tr>
            <tr>
                <th class="text-center">Capacidade: </th>
                <td class="text-center">{{ $equipamento->auditorio->capacidade }}</td>
            </tr>
        @else
            <tr>
                <th class="text-center" style="border: none;">
                    Sem dados cadastrados
                </th>
                <td style="border: none;">
                    @hasanyrole('Coordenador|Administrador')
                    <button class="btn btn-success" data-toggle="modal" data-target="#addAuditorio">Adicionar</button>
                    @endhasanyrole
                </td>
            </tr>
        @endif
        </tbody>
    </table>

    <table class="table table-bordered">
        <tbody>
        <tr>
            <th colspan="2" class="text-center">Espaço de uso comum</th>
        </tr>
        @if (isset($equipamento->salaComum))
            <tr>
                <th class="text-center" width="50%">Capacidade: </th>
                <td class="text-center">{{ $equipamento->salaComum->quantidade }}</td>
            </tr>
            @if (isset($equipamento->salaComum->especificacao))
                <th class="text-center" width="50%">Especificação: </th>
                <td class="text-center">{{ $equipamento->salaComum->especificacao }}</td>
            @endif
        @else
            <tr>
                <th class="text-center" style="border: none;">
                    Sem dados cadastrados
                </th>
                <td style="border: none;">
                    @hasanyrole('Coordenador|Administrador')
                    <button class="btn btn-success" data-toggle="modal" data-target="#addSalaComum">Adicionar</button>
                    @endhasanyrole
                </td>
            </tr>
        @endif
        </tbody>
    </table>

    <table class="table table-bordered">
        <tbody>
        <tr>
            <th colspan="2" class="text-center">Espaço de Estudo em Grupo</th>
        </tr>
        @if (isset($equipamento->estudoGrupo))
            <tr>
                <th class="text-center" width="50%">Capacidade: </th>
                <td class="text-center">{{ $equipamento->estudoGrupo->capacidade }}</td>
            </tr>
            @if (isset($equipamento->estudoGrupo->especificacao))
                <th class="text-center" width="50%">Especificação: </th>
                <td class="text-center">{{ $equipamento->estudoGrupo->especificacao }}</td>
            @endif
        @else
            <tr>
                <th class="text-center" style="border: none;">
                    Sem dados cadastrados
                </th>
                <td style="border: none;">
                    @hasanyrole('Coordenador|Administrador')
                    <button class="btn btn-success" data-toggle="modal" data-target="#addSalaEstudoGrupo">Adicionar</button>
                    @endhasanyrole
                </td>
            </tr>
        @endif
        </tbody>
    </table>

    <table class="table table-bordered">
        <tbody>
        <tr>
            <th colspan="2" class="text-center">Espaço de Estudo Individual</th>
        </tr>
        @if (isset($equipamento->estudoIndividual))
            <tr>
                <th class="text-center" width="50%">Quantidade: </th>
                <td class="text-center">{{ $equipamento->estudoIndividual->quantidade }}</td>
            </tr>
            @if (isset($equipamento->estudoIndividual->especificacao))
                <th class="text-center" width="50%">Especificação: </th>
                <td class="text-center">{{ $equipamento->estudoIndividual->especificacao }}</td>
            @endif
        @else
            <tr>
                <th class="text-center" style="border: none;">
                    Sem dados cadastrados
                </th>
                <td style="border: none;">
                    @hasanyrole('Coordenador|Administrador')
                    <button class="btn btn-success" data-toggle="modal" data-target="#addSalaEstudoIndivitual">Adicionar</button>
                    @endhasanyrole
                </td>
            </tr>
        @endif
        </tbody>
    </table>

    <table class="table table-bordered">
        <tbody>
        <tr>
            <th colspan="2" class="text-center">Espaço Infantil</th>
        </tr>
        @if (isset($equipamento->infantil))
            <tr>
                <th class="text-center" width="50%">Capacidade: </th>
                <td class="text-center">{{ $equipamento->infantil->capacidade }}</td>
            </tr>
            @if (isset($equipamento->infantil->especificacao))
                <th class="text-center" width="50%">Especificação: </th>
                <td class="text-center">{{ $equipamento->infantil->especificacao }}</td>
            @endif
        @else
            <tr>
                <th class="text-center" style="border: none;">
                    Sem dados cadastrados
                </th>
                <td style="border: none;">
                    @hasanyrole('Coordenador|Administrador')
                    <button class="btn btn-success" data-toggle="modal" data-target="#addSalaInfantil">Adicionar</button>
                    @endhasanyrole
                </td>
            </tr>
        @endif
        </tbody>
    </table>

    <table class="table table-bordered">
        <tbody>
        <tr>
            <th colspan="2" class="text-center">Espaço Multiuso</th>
        </tr>
        @if (isset($equipamento->multiuso))
            <tr>
                <th class="text-center" width="50%">Capacidade: </th>
                <td class="text-center">{{ $equipamento->multiuso->capacidade }}</td>
            </tr>
            @if (isset($equipamento->multiuso->especificacao))
                <th class="text-center" width="50%">Especificação: </th>
                <td class="text-center">{{ $equipamento->multiuso->especificacao }}</td>
            @endif
        @else
            <tr>
                <th class="text-center" style="border: none;">
                    Sem dados cadastrados
                </th>
                <td style="border: none;">
                    @hasanyrole('Coordenador|Administrador')
                    <button class="btn btn-success" data-toggle="modal" data-target="#addSalaMulti">Adicionar</button>
                    @endhasanyrole
                </td>
            </tr>
        @endif
        </tbody>
    </table>

    <table class="table table-bordered">
        <tbody>
        <tr>
            <th colspan="2" class="text-center">Telecentro/DigiLab</th>
        </tr>
        @if (isset($equipamento->telecentroDiglab))
            <tr>
                <th class="text-center" width="50%">Capacidade: </th>
                <td class="text-center">{{ $equipamento->telecentroDiglab->quantidade}}</td>
            </tr>
        @else
            <tr>
                <th class="text-center" style="border: none;">
                    Sem dados cadastrados
                </th>
                <td style="border: none;">
                    @hasanyrole('Coordenador|Administrador')
                    <button class="btn btn-success" data-toggle="modal" data-target="#addTelecentro">Adicionar</button>
                    @endhasanyrole
                </td>
            </tr>
        @endif
        </tbody>
    </table>

    <table class="table table-bordered">
        <tbody>
        <tr>
            <th colspan="2" class="text-center">Teatro</th>
        </tr>
        @if (isset($equipamento->teatro))
            <tr>
                <th class="text-center" width="50%">Nome: </th>
                <td class="text-center">{{ $equipamento->teatro->nome}}</td>
            </tr>
            <tr>
                <th class="text-center" width="50%">Capacidade: </th>
                <td class="text-center">{{ $equipamento->teatro->capacidade}}</td>
            </tr>
        @else
            <tr>
                <th class="text-center" style="border: none;">
                    Sem dados cadastrados
                </th>
                <td style="border: none;">
                    @hasanyrole('Coordenador|Administrador')
                    <button class="btn btn-success" data-toggle="modal" data-target="#addTeatro">Adicionar</button>
                    @endhasanyrole
                </td>
            </tr>
        @endif
        </tbody>
    </table>
</div>


@include('layouts.modal',['idModal'=>'addCapacidade','titulo'=>'Adicionar Capacidade','idInput'=>'txtCapacidade','funcaoJS'=>'','label'=>'Capacidade do Equipamento','actionForm'=>'equipamentos.gravaCapacidade','equipamentoId'=>$equipamento->id])

@include('layouts.modal_especificacao',['idModal'=>'addSalaEstudoGrupo','titulo'=>'Adicionar Capacidade','idInput'=>'txtCapacidade','funcaoJS'=>'','label'=>'Espaço de Estudos em Grupo','actionForm'=>'equipamentos.gravaEstudoGrupo','equipamentoId'=>$equipamento->id])

@include('layouts.modal_especificacao',['idModal'=>'addSalaEstudoIndivitual','titulo'=>'Adicionar Capacidade','idInput'=>'txtCapacidade','funcaoJS'=>'','label'=>'Espaço de Estudo Individual','actionForm'=>'equipamentos.gravaEstudoIndividual','equipamentoId'=>$equipamento->id])

@include('layouts.modal_especificacao',['idModal'=>'addSalaComum','titulo'=>'Adicionar Capacidade','idInput'=>'txtCapacidade','funcaoJS'=>'','label'=>'Espaço de uso comum','actionForm'=>'equipamentos.gravaSalaComum','equipamentoId'=>$equipamento->id])

@include('layouts.modal_especificacao',['idModal'=>'addSalaInfantil','titulo'=>'Adicionar Capacidade','idInput'=>'txtCapacidade','funcaoJS'=>'','label'=>'Espaço Infantil','actionForm'=>'equipamentos.gravaSalaInfantil','equipamentoId'=>$equipamento->id])

@include('layouts.modal_especificacao',['idModal'=>'addSalaMulti','titulo'=>'Adicionar Capacidade','idInput'=>'txtCapacidade','funcaoJS'=>'','label'=>'Espaço Multiuso','actionForm'=>'equipamentos.gravaSalaMultiuso','equipamentoId'=>$equipamento->id])

@include('layouts.modal',['idModal'=>'addTelecentro','titulo'=>'Adicionar Capacidade','idInput'=>'txtCapacidade','funcaoJS'=>'','label'=>'Telecentro/DigiLab','actionForm'=>'equipamentos.gravaTelecentro','equipamentoId'=>$equipamento->id])




<div class="modal fade" id="addEstacionamento" role="dialog" aria-labelledby="addPracaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Adicionar Capacidade do Estacionamento</h4>
            </div>
            <form action="{{ route('equipamentos.gravaEstacionamento',$equipamento->id) }}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="col">
                        <label>Vagas internas</label>
                        <input class="form-control" type="text" name="interno" required>
                    </div>
                    <br>
                    <div class="col">
                        <label>Vagas externas</label>
                        <input class="form-control" type="text" name="externo" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-success" type="submit" onclick="">Adicionar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addPraca" role="dialog" aria-labelledby="addPracaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Adicionar Praça</h4>
            </div>
            <form action="{{ route('equipamentos.gravaPraca',$equipamento->id) }}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label>Situado em praça</label>
                        <select class="form-control" id="praca" name="praca" required onchange="habilitarClassificacao()">
                            <option value="">Selecione uma opção</option>
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Dimensão</label>
                        <select class="form-control" id="classificacao" name="classificacao">
                            <option value="">Selecione uma opção</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-success" type="submit" onclick="">Adicionar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addAuditorio" role="dialog" aria-labelledby="addAuditorioLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Adicionar Auditório</h4>
            </div>
            <form action="{{route('equipamentos.gravaAuditorio',$equipamento->id)}}" method="POST">
                <div class="modal-body">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label>Nome</label>
                        <input class="form-control" type="text" name="nome" id="nome" required>
                    </div>
                    <div class="form-group">
                        <label>Capacidade</label>
                        <input class="form-control" type="number" name="capacidade" id="capacidade" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-success" type="submit" onclick="">Adicionar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addTeatro" role="dialog" aria-labelledby="addTeatroLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Adicionar Teatro</h4>
            </div>
            <form action="{{route('equipamentos.gravaTeatro',$equipamento->id)}}" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        {{ csrf_field() }}
                        <label>Nome</label>
                        <input class="form-control" type="text" name="nome" id="nome" required>
                    </div>
                    <div class="form-group">
                        <label>Capacidade</label>
                        <input class="form-control" type="number" name="capacidade" id="capacidade" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-success" type="submit" onclick="">Adicionar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts_adicionais')
    <script>

        //Alteração type input do modal capacidade
        let txtCapacidade = document.querySelectorAll("#txtCapacidade");

        for(let x=0;x<txtCapacidade.length;x++){
            txtCapacidade[x].type = 'number';
        }

        //Carregar classificação
        function carregarClassificacao() {
            $.getJSON('{{url('/api/classificacao')}}', function (data) {
                for (let x=0;x<data.length;x++){
                    opcao = '<option value="'+ data[x].id +'">'+ data[x].classificacao +'</option>';

                    $('#classificacao').append(opcao);

                }
            });
        }

        $(document).ready(function(){
            carregarClassificacao();
        });

    </script>

    <script>
        function habilitarClassificacao() {
            let praca = document.getElementById('#praca').value;
            alert(praca);
            let classificacao = document.getElementById('#classificacao')
            if (praca == 1){
                classificacao.readOnly = false;
            } else {
                classificacao.readOnly = true;
            }
        }
    </script>
@endsection