<div class="tab-pane" id="capacidade">
    <!--Label Capacidade-->

    @hasanyrole('Coordenador|Administrador')
    @if(isset($equipamento->auditorio) || isset($equipamento->estacionamento) || isset($equipamento->praca) || isset($equipamento->estudoGrupo) || isset($equipamento->estudoIndiviudal) || isset($equipamento->infantil) || isset($equipamento->multiuso) || isset($equipamento->teatro))
        <div>
            <div role="tabpanel">
                <ul class="nav nav-tabs">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle label-primary" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: white">
                            Editar <span class="caret"></span>
                        </a>
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
                                <li><a href="#">Sala de Estudo Individual</a></li>
                                <li role="separator" class="divider"></li>
                            @endif

                            @if(isset($equipamento->infantil))
                                <li><a href="#">Sala Infantil</a></li>
                                <li role="separator" class="divider"></li>
                            @endif

                            @if(isset($equipamento->multiuso))
                                <li><a href="#">Sala Multiuso</a></li>
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
            <th colspan="2" class="text-center">Capacidade do Equipamento</th>
        </tr>
        @if (isset($equipamento->equipamentoCapacidade))
            <tr>
                <th width="50%" class="text-center">Capacidade: </th>
                <td class="text-center">{{ $equipamento->equipamentoCapacidade->capacidade }}</td>
            </tr>
        @else
            <tr>
                <th class="text-center" style="border: none;">
                    Sem dados cadastrados
                </th>
                <td style="border: none;">
                    @hasanyrole('Coordenador|Administrador')
                    <button class="btn btn-success" data-toggle="modal" data-target="#addCapacidade">Adicionar</button>
                    @endhasanyrole
                </td>
            </tr>
        @endif
        </tbody>
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
            <th colspan="2" class="text-center">Estacionamento</th>
        </tr>
        @if (isset($equipamento->estacionamento))
            <tr>
                <th class="text-center" width="50%">Capacidade: </th>
                <td class="text-center">{{ $equipamento->estacionamento->capacidade }}</td>
            </tr>
        @else
            <tr>
                <th class="text-center" style="border: none;">
                    Sem dados cadastrados
                </th>
                <th style="border: none;">
                    @hasanyrole('Coordenador|Administrador')
                    <button class="btn btn-success" data-toggle="modal" data-target="#addEstacionamento">Adicionar</button>
                    @endhasanyrole
                </th>
            </tr>
        @endif
        </tbody>
    </table>

    <table class="table table-bordered">
        <tbody>
        <tr>
            <th colspan="2" class="text-center">Praça</th>
        </tr>
        @if (isset($equipamento->praca))
            <tr>
                <th class="text-center" width="50%">Classificação: </th>
                {{-- TODO : Verificar relacionamento da praça --}}
                <td class="text-center">{{ $equipamento->praca->classificacao->classificacao }}</td>
            </tr>
        @else
            <tr>
                <th class="text-center" style="border: none;">
                    Sem dados cadastrados
                </th>
                <th style="border: none;">
                    @hasanyrole('Coordenador|Administrador')
                    <button class="btn btn-success" data-toggle="modal" data-target="#addPraca">Adicionar</button>
                    @endhasanyrole
                </th>
            </tr>
        @endif
        </tbody>
    </table>

    <table class="table table-bordered">
        <tbody>
        <tr>
            <th colspan="2" class="text-center">Sala de Estudo em Grupo</th>
        </tr>
        @if (isset($equipamento->estudoGrupo))
            <tr>
                <th class="text-center" width="50%">Capacidade: </th>
                <td class="text-center">{{ $equipamento->estudoGrupo->capacidade }}</td>
            </tr>
        @else
            <tr>
                <th class="text-center" style="border: none;">
                    Sem dados cadastrados
                </th>
                <th style="border: none;">
                    @hasanyrole('Coordenador|Administrador')
                    <button class="btn btn-success" data-toggle="modal" data-target="#addSalaEstudoGrupo">Adicionar</button>
                    @endhasanyrole
                </th>
            </tr>
        @endif
        </tbody>
    </table>

    <table class="table table-bordered">
        <tbody>
        <tr>
            <th colspan="2" class="text-center">Sala de Estudo Individual</th>
        </tr>
        @if (isset($equipamento->estudoIndividual))
            <tr>
                <th class="text-center" width="50%">Quantidade: </th>
                <td class="text-center">{{ $equipamento->estudoIndividual->quantidade }}</td>
            </tr>
        @else
            <tr>
                <th class="text-center" style="border: none;">
                    Sem dados cadastrados
                </th>
                <th style="border: none;">
                    @hasanyrole('Coordenador|Administrador')
                    <button class="btn btn-success" data-toggle="modal" data-target="#addSalaEstudoIndivitual">Adicionar</button>
                    @endhasanyrole
                </th>
            </tr>
        @endif
        </tbody>
    </table>

    <table class="table table-bordered">
        <tbody>
        <tr>
            <th colspan="2" class="text-center">Sala Infantil</th>
        </tr>
        @if (isset($equipamento->infantil))
            <tr>
                <th class="text-center" width="50%">Capacidade: </th>
                <td class="text-center">{{ $equipamento->infantil->capacidade }}</td>
            </tr>
        @else
            <tr>
                <th class="text-center" style="border: none;">
                    Sem dados cadastrados
                </th>
                <th style="border: none;">
                    @hasanyrole('Coordenador|Administrador')
                    <button class="btn btn-success" data-toggle="modal" data-target="#addSalaInfantil">Adicionar</button>
                    @endhasanyrole
                </th>
            </tr>
        @endif
        </tbody>
    </table>

    <table class="table table-bordered">
        <tbody>
        <tr>
            <th colspan="2" class="text-center">Sala Multiuso</th>
        </tr>
        @if (isset($equipamento->multiuso))
            <tr>
                <th class="text-center" width="50%">Capacidade: </th>
                <td class="text-center">{{ $equipamento->multiuso->capacidade }}</td>
            </tr>
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
            <th colspan="2" class="text-center">Teatro</th>
        </tr>
        @if (isset($equipamento->teatro))
            <tr>
                <th class="text-center" width="50%">Nome: </th>
                <td class="text-center">{{ $equipamento->teatro->nome }}</td>
            </tr>
            <tr>
                <th class="text-center">Capacidade: </th>
                <td class="text-center">{{ $equipamento->teatro->capacidade }}</td>
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

@include('layouts.modal',['idModal'=>'addEstacionamento','titulo'=>'Adicionar Capacidade do Estacionamento','idInput'=>'txtCapacidade','funcaoJS'=>'','label'=>'Estacionamento','actionForm'=>'equipamentos.gravaEstacionamento','equipamentoId'=>$equipamento->id])

@include('layouts.modal',['idModal'=>'addSalaEstudoGrupo','titulo'=>'Adicionar Capacidade','idInput'=>'txtCapacidade','funcaoJS'=>'','label'=>'Sala de Estudos em Grupo'])

@include('layouts.modal',['idModal'=>'addSalaEstudoIndivitual','titulo'=>'Adicionar Capacidade','idInput'=>'txtCapacidade','funcaoJS'=>'','label'=>'Sala de Estudo Individual'])

@include('layouts.modal',['idModal'=>'addSalaInfantil','titulo'=>'Adicionar Capacidade','idInput'=>'txtCapacidade','funcaoJS'=>'','label'=>'Sala Infantil'])

@include('layouts.modal',['idModal'=>'addSalaMulti','titulo'=>'Adicionar Capacidade','idInput'=>'txtCapacidade','funcaoJS'=>'','label'=>'Sala Multiuso'])


<div class="modal fade" id="addPraca" role="dialog" aria-labelledby="addPracaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Adicionar Auditório</h4>
            </div>
            <form action="{{ route('equipamentos.gravaPraca',$equipamento->id) }}" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Classificação</label>
                        <select class="form-control" id="classificacao" name="classificacao">
                            <option value=""></option>
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
                        <input class="form-control" type="text" name="nome" id="nome">
                    </div>
                    <div class="form-group">
                        <label>Capacidade</label>
                        <input class="form-control" type="number" name="capacidade" id="capacidade">
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
            <div class="modal-body">
                <div class="form-group">
                    <label>Nome</label>
                    <input class="form-control" type="text" name="nome" id="nome">
                </div>
                <div class="form-group">
                    <label>Capacidade</label>
                    <input class="form-control" type="number" name="capacidade" id="capacidade">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button class="btn btn-success" onclick="">Adicionar</button>
            </div>
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
@endsection