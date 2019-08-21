@extends('layouts.master')

@section('linksAdicionais')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection


@section('tituloPagina')
    Inserir Período de Reforma <small>{{$equipamento->nome}}</small>
@endsection
@section('conteudo')

        <form method="POST" action="{{ route('equipamentos.gravaReforma', $equipamento->id) }}" autocomplete="off">
            {{ csrf_field() }}

            <div class="row form-group">
                <div class="col-md-offset-3 col-md-3">
                    <label for="inicioReforma">Início da Reforma</label>
                    <input class="form-control calendario" type="text" name="inicioReforma" id="inicioReforma" autocomplete="off">
                </div>
                <div class="col-md-3">
                    <label for="terminoReforma">Término da Reforma</label>
                    <input class="form-control calendario" type="text" name="terminoReforma" id="terminoReforma" autocomplete="off">
                </div>
            </div>

            <div class="row form-group">
                <div class="col-md-offset-3 col-md-6">
                    <label for="descricaoReforma">Descrição da Reforma</label>
                    <textarea class="form-control" name="descricaoReforma" id="descricaoReforma" rows="5"></textarea>
                </div>
            </div>

            <div class="form-group col-md-offset-4 col-md-2">
                <a href="{{route('equipamentos.show', $equipamento->id)}}" class="form-control btn btn-warning">
                    Retornar à Detalhes
                </a>
            </div>
            <div class="form-group col-md-2">
                <input class="btn btn-success" type="submit" value="Inserir Reforma">
            </div>

        </form>

@endsection
@section('scripts_adicionais')
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