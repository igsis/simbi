@extends('layouts.master2')

@section('titulo','Cadastro de Portaria')

@section('links_adicionais')
    <link rel="stylesheet" href="{{asset('AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
@endsection

@section('conteudo')

    <div class="content-wrapper">

        <div class="row">
            <div class="col-xs-12">
                @includeIf('layouts.erros')
            </div>
        </div>

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="page-header"><i class="glyphicon glyphicon-user"></i> Público Atendido</h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        {{$equipamento->nome}}
                    </h3>
                </div>
                <div class="box-body">
                    <form method="POST" action="{{route('frequencia.portaria.gravar', $equipamento->id)}}">
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
                                <label for="data">Data</label>
                                {{--<div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy" data-date-end-date="0d">--}}
                                    {{--<input type="text" class="form-control" name="data" id="data">--}}
                                    {{--<div class="input-group-addon">--}}
                                        {{--<span class="glyphicon glyphicon-calendar"></span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <label for="data">Data</label>
                                <input class="form-control calendario" type="text" name="data" id="data" value="{{old('data')}}">
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
                                <input type="number" class="form-control" id="quantidade" name="quantidade" value="{{ old('quantidade') }}">
                            </div>
                        </div>

                        <input class="btn btn-success" type="submit" value="Cadastrar">
                    </form>
                </div>
            </div>
        </section>
    </div>

@endsection

@section('scripts_adicionais')
    <script src="{{asset('AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

    <script type="text/javascript">
        $(function () {
            $('#data').datepicker({
                autoclose: true,
                defaultDate: "11/1/2019",
                locale: 'pt-br'
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $( ".calendario" ).datepicker({
                dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
                dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
                dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
                monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
            });
            $('.calendario').datepicker("option","showAnim","blind");
            $('.calendario').datepicker( "option", "dateFormat", "dd/mm/yy");
        });
    </script>
@endsection
@section('linksAdicionais')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection
