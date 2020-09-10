@extends('layouts.master')

@section('linksAdicionais')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('tituloPagina')
    <i class="glyphicon glyphicon-user"></i> Vincular Equipamento: {{$user->nome}}
@endsection

@section('conteudo')
    <form method="POST" action="{{ route('pessoas.vincular', $user->id) }}" accept-charset="UTF-8">
        {{ csrf_field() }}
        <div class="vinculos" id="vinculos">
            <div class="vinculo">
                @if ($user->equipamentos->count() == false)
                <div class="row">
                    <div class="form-group col-md-6 has-feedback">
                        <label for="cargo">Biblioteca</label>
                        <select class="form-control" name="equipamento[]" id="" required>
                            @if(count($equipamentos) == 0)
                                <option value="">Não há equipamentos cadastrados</option>
                            @else
                                <option value="">Selecione...</option>
                                @foreach ($equipamentos as $equipamento)
                                    @if($equipamento->publicado == 1)
                                        <option value="{{$equipamento->id}}"> {{$equipamento->nome}} </option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="responsabilidadeTipo">Responsabilidade:</label>
                        <select class="form-control" name="responsabilidadeTipo[]" id="cargo">
                            <option value="">Selecione...</option>
                            @foreach($cargos as $cargo)
                                <option value="{{$cargo->id}}"> {{$cargo->responsabilidade_tipo}} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <br>  {{--fazer margin bottom --}}
                        <a class="btn btn-danger col-md-12" id="remover" onclick="remover(this)">Remover <i class="fa fa-trash-o"></i></a>
                    </div>
                </div>
                @else
                    @foreach($equipamentoVinculados as $equipamentoVinculado)
                    <div class="row">
                        <div class="form-group col-md-6 has-feedback">
                            <label for="cargo">Biblioteca</label>
                            <select class="form-control" name="equipamento[]" id="">
                                @foreach ($equipamentos as $equipamento)
                                    @if($equipamento->publicado == 1)
                                        <option value="{{$equipamento->id}}" {{ in_array($equipamento->id, $equipamentoVinculado->toArray()) ? "selected" : "" }}> {{$equipamento->nome}} </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="responsabilidadeTipo">Responsabilidade:</label>
                            <select class="form-control" name="responsabilidadeTipo[]" id="cargo">
                                <option value="">Selecione...</option>
                                @foreach($cargos as $cargo)
                                    <option value="{{$cargo->id}}" {{ $cargo->id == $equipamentoVinculado->responsabilidade_tipo_id ? "selected" : "" }}> {{$cargo->responsabilidade_tipo}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <br>  {{--fazer margin bottom --}}
                            <a class="btn btn-danger col-md-12" id="remover" onclick="remover(this)">Remover <i class="fa fa-trash-o"></i></a>
                        </div>

                    </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="box-footer">
            <a class="btn btn-primary " href="#void" id="addInput"> Adicionar outro Equipamento</a>
            <button class="btn btn-success pull-right" type="submit">Cadastrar vínculo</button>
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

        function remover(e){
            if($(".row").length > 0) $(e).closest(".row").remove();
        }
    </script>
@endsection

