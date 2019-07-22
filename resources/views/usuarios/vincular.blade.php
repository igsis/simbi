@extends('layouts.master')

@section('linksAdicionais')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('tituloPagina')
    <i class="glyphicon glyphicon-user"></i> Vincular Equipamento: {{$user->name}}
@endsection

@section('conteudo')

    <div class="col-lg-8 col-lg-offset-2">

        <form method="POST" action="{{ route('usuarios.vincular', $user->id) }}" accept-charset="UTF-8">
            {{ csrf_field() }}

            <div class="row">
                <label>Equipamentos vinculados:</label>
                <div class="well">
                    @foreach($equipamentos as $equipamento)
                        <div class="checkbox-inline">
                            <label><input type="checkbox" name="equipamento[]" value="{{$equipamento->id}}" {{ in_array($equipamento->id, $user->equipamentos()->pluck('equipamento_id')->toArray()) ? "checked" : "" }}>{{$equipamento->nome}}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-offset-3 col-md-3">
                    <label for="dataInicio">Data de Inicio:</label>
                    <input type="text" class="form-control calendario" name="dataInicio" id="dataInicio">
                </div>
                <div class="form-group col-md-3">
                    <label for="dataFim">Data de Término:</label>
                    <input type="text" class="form-control calendario" name="dataFim" id="dataFim" value="">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-offset-4 col-md-4">
                    <label for="responsabilidadeTipo">Cargo:</label>
                    <select class="form-control" name="responsabilidadeTipo" id="cargo">
                        <option value="">Selecione...</option>
                        @foreach($cargos as $cargo)

                            <option value="{{$cargo->id}}">{{$cargo->responsabilidade_tipo}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <hr>
                <div class="form-group col-md-offset-4 col-md-2">
                    <a href="{{route('usuarios.index', ['type' => 1])}}" class="form-control btn btn-warning">
                        Voltar
                    </a>
                </div>
                <div class="form-group col-md-2">
                    <input type="submit" class="form-control btn btn-primary" name="enviar" value="Vincular">
                </div>
            </div>
        </form>
    </div>
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