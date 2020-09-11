
@extends('layouts.master2')

@section('linksAdicionais')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('titulo', 'Editar Usuario')

@section('conteudo')
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="page-header"><i class="glyphicon glyphicon-user"></i> Edição de pessoa</h1>
        </section>

        <div class="row">
            <div class="col-xs-12">
                @includeIf('layouts.erros')
            </div>
        </div>
        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                    @if($user->tipo_pessoa == 1)
                        Funcionário: {{$user->nome}}
                    @elseif( $user->tipo_pessoa == 2)
                        Convocado: {{$user->nome}}
                    @else
                        Estagiário: {{$user->nome}}
                    @endif
                    </h3>
                </div>
                <form method="POST" action="{{ route('funcionario.atualizar', $user->id) }}" accept-charset="UTF-8" autocomplete="off">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">

                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-xs-7 col-md-6 has-feedback {{ $errors->has('RF') ? ' has-error' : '' }}">
                                <label for="name">Registro Funcional</label>
                                <input class="form-control" type="text" name="RF" id="RF" maxlength="6" value="{{$user->RF}}" data-mask="0000000">
                            </div>
                            <div class="form-group col-md-6 has-feedback {{ $errors->has('vinculo') ? ' has-error' : '' }}">
                                <label for="name">Vínculo</label>
                                <input class="form-control" type="text" name="vinculo" id="vinculo" value="{{$user->vinculo}}" maxlength="1" data-mask="0"  {{ ($user->tipo_pessoa == 3) ? 'readonly' : "" }}>


                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 has-feedback {{ $errors->has('nome') ? ' has-error' : '' }}">
                                <label for="name">Nome</label>
                                <input class="form-control" type="text" name="nome" id="nome" value="{{$user->nome}}">
                            </div>
                            @hasanyrole('Administrador|Coordenador')
                            <div id="divCargo"
                                 class="form-group col-xs-8 col-md-5 has-feedback {{ $errors->has('cargo') ? ' has-error' : '' }}">
                                <label for="cargo">Cargo/Função</label>
                                <select class="form-control" name="cargo" id="cargo">
                                    <option value="">Selecione...</option>
                                    @foreach ($cargos as $cargo)
                                        @if($cargo->publicado == 1)
                                            @if ($cargo->id == old('cargo') || $cargo->id == $user->cargo_id)
                                                <option value="{{$cargo->id}}" selected>{{$cargo->cargo}}</option>
                                            @else
                                                <option value="{{$cargo->id}}">{{$cargo->cargo}}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-xs-2 col-md-1">
                                <label for="addCargo">&emsp;</label>
                                <button type="button" class="btn btn-info btn-block" data-toggle="modal"
                                        data-target="#addCargo">
                                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"/>
                                </button>
                            </div>

                            <div id="divSubAdm"
                                 class="form-group col-xs-7 col-md-5 has-feedback {{ $errors->has('subordinacaoAdministrativa') ? ' has-error' : '' }}">
                                <label for="subordinacaoAdministrativa">Lotação</label>
                                <select class="form-control" name="subordinacaoAdministrativa"
                                        id="subordinacaoAdministrativa">
                                    <option value="">Selecione uma Opção</option>
                                    @foreach ($subordinacoesAdministrativas as $subordinacaoAdministrativa)
                                        @if($subordinacaoAdministrativa->publicado == 1)
                                            @if ($subordinacaoAdministrativa->id == old('subordinacaoAdministrativa') || $subordinacaoAdministrativa->id == $user->subordinacao_administrativa_id)
                                                <option value="{{$subordinacaoAdministrativa->id}}"
                                                        selected>{{$subordinacaoAdministrativa->descricao}}</option>
                                            @else
                                                <option value="{{$subordinacaoAdministrativa->id}}">{{$subordinacaoAdministrativa->descricao}}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-xs-2 col-md-1">
                                <label for="addSubAdm">&emsp;</label>
                                <button type="button" class="btn btn-info btn-block" data-toggle="modal"
                                        data-target="#addSubAdm">
                                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"/>
                                </button>
                            </div>

                        </div>

                        @if($user->tipo_pessoa == 1)
                            <div id="divFuncionario">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="aposenta" id="aposenta" value="1" onclick="desabilitar(!this.checked)" {{isset($user->FuncionarioAdicionais->data_aposentadoria) ? "checked" : ""}}>Pode Aposentar
                                </label>
                            </div>
                                <div class="row">
                                    <div class="form-group col-md-6"><br>
                                        <label for="data">Previsão para aposentadoria</label>
                                        <input class="form-control calendario" type="text" name="dataAposentadoria"
                                               value="{{ isset($user->FuncionarioAdicionais->data_aposentadoria) ? date('m/d/Y', strtotime($user->FuncionarioAdicionais->data_aposentadoria)) : "" }}"
                                               id="dataAposentadoria" {{isset($user->FuncionarioAdicionais->data_aposentadoria) ? "" : "disabled"}}>
                                    </div>
                                    <div class="form-group col-md-12 has-feedback">
                                        <label for="name">Observação</label>
                                        <input class="form-control" type="text" name="observacao" id="observacao" value="{{ isset($user->FuncionarioAdicionais->observacao) ? $user->FuncionarioAdicionais->observacao : "" }}">
                                    </div>
                                </div>
                            </div>
                        @else
                        <div class="row">
                            <div id="divSecretaria"
                                 class="form-group col-xs-7 col-md-5 has-feedback {{ $errors->has('identificacaoSecretaria') ? ' has-error' : '' }}">
                                    <label for="identificacaoSecretaria">Identificação da Secretaria</label>
                                    <select class="form-control" name="identificacaoSecretaria"
                                            id="identificacaoSecretaria">
                                        <option value="" selected>Selecione uma Opção</option>
                                        @foreach ($secretarias as $secretaria)
                                            @if ($secretaria->publicado == 1)
                                                @if ($secretaria->id == old('identificacaoSecretaria') || $secretaria->id == $user->secretaria_id)
                                                    <option value="{{$secretaria->id}}"
                                                            selected>{{$secretaria->sigla}}</option>
                                                @else
                                                    <option value="{{$secretaria->id}}">{{$secretaria->sigla}}</option>
                                                @endif
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-xs-2 col-md-1">
                                    <label for="addSecretaria">&emsp;</label>
                                    <button type="button" class="btn btn-info btn-block" data-toggle="modal"
                                            data-target="#addSecretaria">
                                        <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"/>
                                    </button>
                                </div>
                        </div>

                        @endif
                        @endhasanyrole
                    <div class="box-footer">
                        <a class="btn btn-default" href="{{ route('funcionarios.index', ['type' => '1']) }}">Voltar</a>
                        <input class="btn btn-primary pull-right" type="submit" value="Editar">
                    </div>
                </form>
            </div>
            @include('layouts.excluir_confirm')

            @include('layouts.funcionario_modal', ['idModal' => 'addCargo', 'titulo' => 'Adicionar novo Cargo', 'actionForm' => 'createCargo', 'nameModal' => 'cargo', 'equipamentoId' => '0', 'idInput' => 'novoCargo', 'funcaoJS' => 'insertCargo'])
            @include('layouts.funcionario_modal', ['idModal' => 'addFuncao', 'titulo' => 'Adicionar nova Função', 'actionForm' => 'createFuncao', 'nameModal' => 'funcao', 'equipamentoId' => '0', 'idInput' => 'novaFuncao', 'funcaoJS' => 'insertFuncao'])
            @include('layouts.funcionario_modal', ['idModal' => 'addSubAdm', 'titulo' => 'Adicionar nova Sub. Administrativa', 'actionForm' => 'createSubordinacaoAdministrativa', 'nameModal' => 'descricao', 'equipamentoId' => '0', 'idInput' => 'novaSubAdm', 'funcaoJS' => 'insertSubAdm'])

            <div class="modal fade" id="addSecretaria" role="dialog" aria-labelledby="addSecretariaLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Adicionar nova Secretaria</h4>
                        </div>
                        <form action="{{route('createSecretaria')}}"  method="POST">
                            {{csrf_field()}}
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Sigla:</label>
                                    <input class="form-control" type="text" name="sigla" id="secretariaSigla"
                                           maxlength="6">
                                </div>
                                <div class="form-group">
                                    <label>Descrição:</label>
                                    <input class="form-control" type="text" name="descricao"
                                           id="secretariaDescricao">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button class="btn btn-success" onclick="insertSecretaria(); arrumar();">Adicionar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection

@section('scripts_adicionais')
    <!-- Script Msg Resetar Senha -->
    <script type="text/javascript" defer>
        $('#confirmDelete').on('show.bs.modal', function (e)
        {
            let $message = $(e.relatedTarget).attr('data-message');
            $(this).find('.modal-body p').text($message);
            let $title = $(e.relatedTarget).attr('data-title');
            $(this).find('.modal-title').text($title);
            let $button = $(e.relatedTarget).attr('data-button');
            $(this).find('.modal-footer #confirm').text($button);

            // Pass form reference to modal for submission on yes/ok
            var form = $(e.relatedTarget).closest('form');
            $(this).find('.modal-footer #confirm').data('form', form);
        });

        //Form confirm (yes/ok) handler, submits form
        $('#confirmDelete').find('.modal-footer #confirm').on('click', function()
        {
            $(this).data('form').submit();
        });

        $(document).ready(function () {
            {{--$('input:radio[name="roles"][value={{$user->roles->first()->id}}]').attr('checked', true);--}}

            $('#identificacaoSecretaria').val("{{$user->secretaria_id}}");
            $('#subordinacaoAdministrativa').val("{{$user->subordinacao_administrativa_id}}");
            $('#cargo').val("{{$user->cargo_id}}");
            $('#funcao').val("{{$user->funcao_id}}");
            $('#escolaridade').val("{{$user->escolaridade_id}}");

            {{--            @if($user->name == Auth::user()->name)--}}
            {{--                $('#perguntaSeguranca').val("{{$user->perguntaSeguranca->id}}");--}}
            {{--            @endif--}}
        });

        function insertCargo()
        {
            let select = document.getElementById("cargo"),
                div = document.getElementById("divCargo"),
                i = {{$cargos->count()}},
                txtVal = document.getElementById("novoCargo").value,
                newOption = document.createElement("OPTION"),
                newInput = document.createElement("INPUT"),
                newOptionVal = document.createTextNode(txtVal);

            if (txtVal !== "")
            {
                newOption.appendChild(newOptionVal);
                newOption.setAttribute("value", `${i + 1}`);
                select.insertBefore(newOption, select.lastChild);
                newOption.setAttribute('selected', 'selected');

                newInput.setAttribute("type", "hidden");
                newInput.setAttribute("name", "novoCargo");
                newInput.setAttribute("value", newOptionVal.textContent);
                div.insertBefore(newInput, div.lastChild);
            }
            $('#addCargo').modal('hide');
            $("input[id='novoCargo']").val('');
        }


        function insertSubAdm()
        {
            let select = document.getElementById("subordinacaoAdministrativa"),
                div = document.getElementById("divSubAdm"),
                i = {{$subordinacoesAdministrativas->count()}},
                txtVal = document.getElementById("novaSubAdm").value,
                newOption = document.createElement("OPTION"),
                newInput = document.createElement("INPUT"),
                newOptionVal = document.createTextNode(txtVal);

            if (txtVal !== "")
            {
                newOption.appendChild(newOptionVal);
                newOption.setAttribute("value", `${i + 1}`);
                select.insertBefore(newOption, select.lastChild);
                newOption.setAttribute('selected', 'selected');

                newInput.setAttribute("type", "hidden");
                newInput.setAttribute("name", "novaSubAdm");
                newInput.setAttribute("value", newOptionVal.textContent);
                div.insertBefore(newInput, div.lastChild);
            }
            $('#addSubAdm').modal('hide');
            $("input[id='novaSubAdm']").val('');
        }

        function insertSecretaria()
        {
            let select = document.getElementById("identificacaoSecretaria"),
                div = document.getElementById("divSecretaria"),
                i = {{$secretarias->count()}},
                txtVal = document.getElementById("secretariaSigla").value,
                txtVal2 = document.getElementById("secretariaDescricao").value,
                newOption = document.createElement("OPTION"),
                newInput = document.createElement("INPUT"),
                newInput2 = document.createElement("INPUT"),
                newOptionVal = document.createTextNode(txtVal),
                newOptionVal2 = document.createTextNode(txtVal2);

            if (txtVal !== "")
            {
                newOption.appendChild(newOptionVal);
                newOption.setAttribute("value", `${i + 1}`);
                select.insertBefore(newOption, select.lastChild);
                newOption.setAttribute('selected', 'selected');

                newInput.setAttribute("type", "hidden");
                newInput.setAttribute("name", "siglaSecretaria");
                newInput.setAttribute("value", newOptionVal.textContent);
                div.insertBefore(newInput, div.lastChild);

                newInput2.setAttribute("type", "hidden");
                newInput2.setAttribute("name", "descricaoSecretaria");
                newInput2.setAttribute("value", newOptionVal2.textContent);
                div.insertBefore(newInput2, div.lastChild);
            }
            $('#addSecretaria').modal('hide');
            $("input[id='novaSecretaria']").val('');
        }
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


    <script type="text/javascript">
        function desabilitar(selecionado) {
            document.getElementById('dataAposentadoria').disabled = selecionado;
            dataAposentadoria.value = "";
        }
    </script>

@endsection
