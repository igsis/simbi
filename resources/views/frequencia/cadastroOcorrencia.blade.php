@extends('layouts.master2')

@section('titulo','Cadastrar Ocorrência')
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
                <i class="glyphicon glyphicon-flag"></i> Cadastrar Ocorrência
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $equipamento->nome }}</h3>
                </div>
                <div class="box-body">
                    <form method="POST" action="{{route('eventos.grava.ocorrencia', [$equipamento->id, $evento->id])}}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <div class="form-group">
                                <label for="nome">Nome do Evento</label>
                                <input class="form-control" type="text" id="nome" name="nome" readonly value="{{ $evento->nome_evento }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="form-group ">
                                    <label for="data">Data</label>
                                    <input class="form-control calendario" type="text" name="data" value="{{ old('data') }}" autocomplete="off" onblur="arrumaData()">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-group ">
                                    <label for="hora">Hora</label>
                                    <input class="form-control hora" maxlength="5" type="text" data-mask="00:00" name="hora" id="hora" placeholder="Digite a hora" value="{{ old('hora') }}">
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-success"> Cadastrar</button>
                    </form>
                </div>
            </div>
        </section>
    </div>

@endsection

@section('scripts_adicionais')
    <script type="text/javascript">
    $(document).ready(function(){
        $(".hora").mask("99:99");
    });
    </script>
    {{--    <script src="{{asset('AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>--}}
    @include('scripts.tabelas_admin')
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
