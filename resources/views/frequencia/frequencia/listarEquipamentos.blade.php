@extends('layouts.master2')

@section('linksAdicionais')
    @includeIf('links.tabelas_AdminLTE')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('titulo','Equipamentos')

@section('conteudo')

    <div class="content-wrapper">
        <div class="row">
            <div class="col-xs-12">
                @includeIf('layouts.erros')
            </div>
        </div>

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="page-header">
                <i class="fa fa-users"></i>
                @if($type == 1)
                    Público em Equipamentos
                @elseif($type == 2)
                    Ocorrência de Eventos em Equipamentos
                @else
                    Público de Recepção em Equipamentos
                @endif
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Lista de Equipamentos</h3>
                </div>

                <div class="box-body">
                    <div class="table-responsive">
                        <table id="tabela1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Nome do Equipamento</th>
                                <th>Operações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($type == 1)
                                @foreach($equipamentos as $equipamento)
                                    <tr>
                                        <td>{{$equipamento->nome}}</td>
                                        <td>
                                            <a href="{{ route('frequencia.ocorrencias', [$equipamento->id,1]) }}"
                                               class="btn bg-navy" style="margin-right: 3px"><i
                                                        class="glyphicon glyphicon-eye-open"></i> &nbsp; Publico de Evento</a>
                                            @if($equipamento->portaria == 0)
                                                <button type="button" data-toggle="modal"
                                                        data-target="#cadastroPortariaSimples"
                                                        data-title="Cadastro de Portaria"
                                                        class="btn bg-light-blue" style="margin-right: 3px"
                                                        onclick="setarIdEquipamento({{ $equipamento->id }})"> <i
                                                            class="glyphicon glyphicon-eye-open"></i> &nbsp; Público de Recepção
                                                </button>
                                            @else
                                                <a href="{{ route('frequencia.portaria.cadastroCompleto',$equipamento->id) }}"
                                                   class="btn bg-light-blue" style="margin-right: 3px"><i
                                                            class="glyphicon glyphicon-eye-open"></i> &nbsp; Público de Recepção</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @elseif($type == 2)
                                @foreach($equipamentos as $equipamento)
                                    <tr>
                                        <td>{{$equipamento->nome}}</td>
                                        <td>
                                            <a href="{{ route('frequencia.ocorrenciasEnviadas', [$equipamento->id,2]) }}"
                                               class="btn bg-navy" style="margin-right: 3px"><i
                                                        class="glyphicon glyphicon-eye-open"></i> &nbsp; Ocorrência de Evento</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                @foreach($equipamentos as $equipamento)
                                    <tr>
                                        <td>{{$equipamento->nome}}</td>
                                        <td>
                                            <a href="{{ route('frequencia.portaria.listar', $equipamento->id) }}"
                                               class="btn btn-info pull-right" style="margin-right: 3px"><i
                                                        class="fa fa-users"></i> &nbsp; Público de Recepção</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                            <tfooter>
                                <thead>
                                <tr>
                                    <th>Nome do Equipamento</th>
                                    <th>Operações</th>
                                </tr>
                                </thead>
                            </tfooter>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="cadastroPortariaSimples" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="glyphicon glyphicon-user"></i> Cadastro de Público de Recepção Simples</h4>
                </div>
                <!-- inicio do form -->
                <form action="{{route('frequencia.portaria.gravar')}}" method="post" autocomplete="off">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="form-group col-md-4" >
                                <label for="data">Data</label>
                                <input type="text" class="form-control" id="calendario" name="data" autocomplete="off" maxlength="10">
                            </div>
                            <div class="form-group col-md-6" >
                                <label for="data">Período</label> <br>
                                    <input type="radio" name="periodo" value="1"> Segunda à Sexta &nbsp;&nbsp;
                                    <input type="radio" name="periodo" value="2"> Sábado &nbsp;&nbsp;
                                    <input type="radio" name="periodo" value="3"> Domingo
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="nome">Quantidade</label>
                                <input type="number" class="form-control" id="quantidade" name="quantidade"
                                       value="">
                            </div>
                        </div>
                        <input type="hidden" name="id" id="idEquipamento" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <input class="btn btn-success" id="submitForm" type="submit" value="Cadastrar">
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts_adicionais')
    {{--    <script src="{{asset('AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>--}}
    @include('scripts.tabelas_admin')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function () {
            let data = new Date();
            $('#calendario').datepicker("option", "showAnim", "blind");
            $("#calendario").datepicker({

                dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'],
                dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
                dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
                monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
            });
            $('#calendario').datepicker("option", "dateFormat", "dd/mm/yy");
        });

    </script>

    <script>
        function setarIdEquipamento(id) {
            let idEquipamento = document.querySelector('#idEquipamento');

            idEquipamento.value = id;
        }
    </script>
@endsection