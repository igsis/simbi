@extends('layouts.master')

@section('tituloPagina')
    <i class="glyphicon glyphicon-user"></i> Vincular Equipamento: {{$user->name}}
@endsection

@section('conteudo')
    <form method="POST" action="{{ route('pessoas.vincular', $user->id) }}" accept-charset="UTF-8">
            {{ csrf_field() }}
        <div class="vinculos">
            <div class="vinculo">
                <div class="row">
                    <div class="form-group col-md-7 has-feedback">
                        <label for="cargo">Biblioteca</label>
                        <select class="form-control" name="equipamento[]" id="">
                            <option value="">Selecione...</option>
                            @foreach ($equipamentos as $equipamento)
                                @if($equipamento->publicado == 1)
                                    @if ($equipamento->id == old('equipamento[]'))
                                        <option value="{{$equipamento->id}}" {{ in_array($equipamento->id, $user->equipamentos()->pluck('equipamento_id')->toArray()) ? "selected" : "" }}>{{$equipamento->nome}}</option>
                                    @else
                                        <option value="{{$equipamento->id}}">{{$equipamento->nome}}</option>
                                    @endif
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-5">
                        <label for="responsabilidadeTipo">Responsabilidade:</label>
                        <select class="form-control" name="responsabilidadeTipo" id="cargo">
                            <option value="">Selecione...</option>
                            @foreach($cargos as $cargo)
                                <option value="{{$cargo->id}}">{{$cargo->responsabilidade_tipo}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <a class="btn btn-success" type="submit">Cadastrar</a>
            <a class="btn btn-primary pull-right" href="#void" id="addInput"> Adicionar outro Equipamento</a>
        </div>
    </form>
@endsection
@section('scripts_adicionais')
    @include('scripts.adicionar_equipamento')
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