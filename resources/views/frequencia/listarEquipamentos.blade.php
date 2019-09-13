@extends('layouts.master2')

@section('linksAdicionais')
    @includeIf('links.tabelas_AdminLTE')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('scripts_css')
    <style>
        .ui-datepicker-calendar {
            display: none;
        }
    </style>
@endsection

@section('titulo','Frequência Enviadas')

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
                Público de Eventos em Equipamentos
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
                                                        class="glyphicon glyphicon-eye-open"></i> &nbsp; Frequencias</a>
                                            @if($equipamento->portaria == 0)
                                                <button type="button" data-toggle="modal"
                                                        data-target="#cadastroPortariaSimples"
                                                        data-title="Cadastro de Portaria"
                                                        class="btn bg-light-blue" style="margin-right: 3px"
                                                        onclick="setarIdEquipamento({{ $equipamento->id }})">&nbsp; Publico de Recepção
                                                </button>
                                            @else
                                                <a href="{{ route('frequencia.portaria.cadastroCompleto',$equipamento->id) }}"
                                                   class="btn bg-light-blue" style="margin-right: 3px"><i
                                                            class="glyphicon glyphicon-eye-open"></i> &nbsp; Publico de Recepção</a>
                                            @endif
                                            <a href="#" class="btn bg-olive" style="margin-right: 3px"><i
                                                        class="glyphicon glyphicon-eye-open"></i> &nbsp; Frequencias de
                                                Público</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                @foreach($equipamentos as $equipamento)
                                    <tr>
                                        <td>{{$equipamento->nome}}</td>
                                        <td>
                                            <a href="{{ route('frequencia.ocorrencias', [$equipamento->id,2]) }}"
                                               class="btn bg-navy" style="margin-right: 3px"><i
                                                        class="glyphicon glyphicon-eye-open"></i> &nbsp; Frequencias</a>
                                            <a href="#"
                                               class="btn bg-light-blue" style="margin-right: 3px"><i
                                                        class="glyphicon glyphicon-eye-open"></i> &nbsp; Publico de Recepção</a>
                                            <a href="#" class="btn bg-olive" style="margin-right: 3px"><i
                                                        class="glyphicon glyphicon-eye-open"></i> &nbsp; Frequencias de
                                                Público</a>
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
                    <h4 class="modal-title"><i class="glyphicon glyphicon-user"></i> Público Atendido</h4>
                </div>
                <!-- inicio do form -->
                <form action="{{route('frequencia.portaria.gravar')}}" method="post" autocomplete="off">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="page-header">
                                    Data do Evento
                                </h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="data">Mês</label>
                                <input type="text" class="form-control" id="calendario" name="data" autocomplete="off" maxlength="10">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="page-header">
                                    Período
                                </h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <input type="radio" name="periodo" value="seg_sex"> Segunda à Sexta
                            </div>
                            <div class="form-group col-md-3">
                                <input type="radio" name="periodo" value="sab"> Sábado
                            </div>
                            <div class="form-group col-md-3">
                                <input type="radio" name="periodo" value="dom"> Domingo
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="page-header">
                                    Público Atendido
                                </h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-6">
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
                dateFormat: "mm/yy",
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                currentText: 'Atual',
                closeText : "Selecionar",
                onClose: function(dateText, inst) {

                    function isDonePressed(){
                        return ($('#ui-datepicker-div').html().indexOf('ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all ui-state-hover') > -1);
                    }

                    if (isDonePressed()){
                        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                        $(this).datepicker('setDate', new Date(year, month, 1)).trigger('change');

                        $('.date-picker').focusout()//Added to remove focus from datepicker input box on selecting date
                    }
                },
                beforeShow : function(input, inst) {

                    inst.dpDiv.addClass('month_year_datepicker')

                    if ((datestr = $(this).val()).length > 0) {
                        year = datestr.substring(datestr.length-4, datestr.length);
                        month = datestr.substring(0, 2);
                        $(this).datepicker('option', 'defaultDate', new Date(year, month-1, 1));
                        $(this).datepicker('setDate', new Date(year, month-1, 1));
                        $(".ui-datepicker-calendar").hide();
                    }
                },

                dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'],
                dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
                dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
                monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
            });
            $('#calendario').datepicker("option", "dateFormat", "mm/yy");
        });

        $('#submitForm').click(function () {
            let data = $('#calendario').val();
            let nData = data.split('/');
            let novaData = nData[1]+'-'+nData[0]+'-01';
            $('#calendario').val(novaData);

        });

    </script>

    <script>
        function setarIdEquipamento(id) {
            let idEquipamento = document.querySelector('#idEquipamento');

            idEquipamento.value = id;
        }
    </script>
@endsection