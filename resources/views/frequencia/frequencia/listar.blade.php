@include('layouts.br')
@extends('layouts.master2')

@section('linksAdicionais')
    @includeIf('links.tabelas_AdminLTE')
@endsection

@section('titulo','Frequência de Público')

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
                <i class="glyphicon glyphicon-th-list"></i>
                Frequência de Público
                <small>{{ $equipamento->nome }}</small></h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <input type="radio" name="periodo" value="1" checked> Segunda à Sexta &nbsp;&nbsp;
                        <input type="radio" name="periodo" value="2" > Sábado &nbsp;&nbsp;
                        <input type="radio" name="periodo" value="3"> Domingo
                    </h3>
                </div>
                <div class="box-body">
                    <button onclick="AddTableRow()" type="button">Adicionar Produto</button>
                    <div class="table table-responsive">
                        <table class="table table-bordered table-striped" id="tabela">
                            @if ($equipamento->frequencias->count() != 0)
                                <thead>
                                <tr>
                                    <th colspan="4" class="text-center"> </th>
                                </tr>

                                <tr>
                                    <th>Público de Recepção</th>
                                    <th>Publico de Evento Interno</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>100</td>
                                    <td>100</td>
                                    <td>200</td>
                                </tr>
                                </tbody>
                            @else
                                <tr>
                                    <th colspan="2" class="text-center">Não há frequência cadastradas</th>
                                </tr>
                            @endif
                        </table>
                    </div>
                    <div class="form-group col-md-offset-4 col-md-4">
                        <a href="{{route('frequencia.relatorio')}}" class="form-control btn btn-warning">
                            Retornar à Lista de Equipamentos
                        </a>
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection

@section('scripts_adicionais')
    @include('scripts.tabelas_admin')
    <script>
        $(document).ready(function(){
            var id = {{$equipamento->id}};
            $("input[name='periodo']").change(function(){
                var idPeriodo = $("input[name='periodo']:checked").val();
                $.getJSON('/simbi/api/' + id + '/relatorioCompleto/' + idPeriodo, function (equipamento) {

                });
            });
        });

    </script>

    <script>
        (function($) {
            AddTableRow = function() {
                var newRow = $("<tr>");
                var cols = "";

                cols += '<td>&nbsp;</td>';
                cols += '<td>&nbsp;</td>';
                cols += '<td>&nbsp;</td>';

                newRow.append(cols);
                $("#tabela").append(newRow);
            };
        })(jQuery);
    </script>

@endsection