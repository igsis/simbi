@include('layouts.br')
@extends('layouts.master2')

@section('linksAdicionais')
    @includeIf('links.tabelas_AdminLTE')
@endsection

@section('titulo','Relatório de Consultas')

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
                Relatório de Consultas
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
                    <div class="table table-responsive">
                        <table class="table table-bordered table-striped" id="tabela">

                        </table>
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
            PreencherTabela();

            function PreencherTabela() {
                var id = {{$equipamento->id}};
                var idPeriodo = $("input[name='periodo']:checked").val();
                $.getJSON('/simbi/api/' + id + '/relatorioConsulta/' + idPeriodo, function (consultas) {
                    $( "tr" ).remove(); //limpar tabela
                    if (consultas.length <1){
                        var cols = "";
                        cols += '<thead>';
                        cols += '<tr>';
                        cols += '<th colspan="4" class="text-center">Sem registros neste período</th>';
                        cols += '</tr>';
                        $("#tabela").append(cols);
                    }
                    else{
                        $.each(consultas, function(key, value){
                            var mes = mesBr(value.mes);
                            var cols = "";

                            cols += '<thead>';
                            cols += '<tr>';
                            cols += '<th colspan="7" class="text-center">'+mes.toUpperCase()+'-'+value.ano+'</th>';
                            cols += '<tr>';
                            cols += '<th>Livro</th>';
                            cols += '<th>Audio-visual</th>';
                            cols += '<th>Mangá</th>';
                            cols += '<th>Jornal</th>';
                            cols += '<th>Revista</th>';
                            cols += '<th>Suportes</th>';
                            cols += '<th>Total</th>';
                            cols += '</tr>';
                            cols += '</thead>';
                            //body
                            cols += '<tr>';
                            cols += '<td>'+value.livro+'</td>';
                            cols += '<td>'+value.audio_visual+'</td>';
                            cols += '<td>'+value.manga+'</td>';
                            cols += '<td>'+value.jornal+'</td>';
                            cols += '<td>'+value.revista+'</td>';
                            cols += '<td>'+value.suportes+'</td>';
                            cols += '<td> <b>'+value.total+'</b></td>';
                            cols += '</tr>';
                            $("#tabela").append(cols);

                        })
                    };
                });
            }

            $("input[name='periodo']").change(function(){
                PreencherTabela();
            });

            function mesBr(mes) {
                var meses = [
                    "Janeiro",
                    "Fevereiro",
                    "Março",
                    "Abril",
                    "Maio",
                    "Junho",
                    "Julho",
                    "Agosto",
                    "Setembro",
                    "Outubro",
                    "Novembro",
                    "Dezembro"
                ];

                return meses[mes - 1];
            }

        });

    </script>
@endsection