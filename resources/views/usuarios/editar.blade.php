@extends('layouts.master2')

@section('conteudo')
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="page-header"><i class="glyphicon glyphicon-user"></i> Editar {{$user->name}}</h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{$user->name}}</h3>
                <div class="box-tools">
                    @if($user->name != Auth::user()->name)
                        <form id="resetSenha" method="POST" action="{{route('usuarios.reset', $user->id)}}" accept-charset="UTF-8">
                            {{ csrf_field() }}
                            {{method_field('PUT')}}
                            <button class="btn btn-danger pull-right" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Resetar a Senha?" data-message='Desejar realmente resetar a senha deste usuário? Senha: simbi@2018' data-button="Resetar Senha">Resetar Senha</button>
                        </form>
                    @endif
                </div>
            </div>
            <form method="POST" action="{{ url('usuarios', [$user->id]) }}" accept-charset="UTF-8">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">

                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-md-7 has-feedback {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name">Nome</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{$user->name}}">
                        </div>

                        <div class="form-group col-md-5 has-feedback {{ $errors->has('login') ? ' has-error' : '' }}">
                            <label for="login">Login</label>
                            <input class="form-control" type="text" name="login" id="login" maxlength="7" value="{{$user->login}}" readonly>
                        </div>

                        <div class="form-group col-md-12 has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">E-mail</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{$user->email}}">
                        </div>
                    </div>

                    @hasanyrole('Administrador|Coordenador')
                    <div class="row">
                        <div id="divSubAdm" class="form-group col-xs-7 col-md-5 has-feedback {{ $errors->has('subordinacaoAdministrativa') ? ' has-error' : '' }}">
                            <label for="subordinacaoAdministrativa">Subordinação Administrativa</label>
                            <select class="form-control" name="subordinacaoAdministrativa" id="subordinacaoAdministrativa">
                                <option value="">Selecione uma Opção</option>
                                @foreach ($subordinacoesAdministrativas as $subordinacaoAdministrativa)
                                    @if ($subordinacaoAdministrativa->id == old('subordinacaoAdministrativa'))
                                        <option value="{{$subordinacaoAdministrativa->id}}" selected>{{$subordinacaoAdministrativa->descricao}}</option>
                                    @else
                                        <option value="{{$subordinacaoAdministrativa->id}}">{{$subordinacaoAdministrativa->descricao}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-xs-2 col-md-1">
                            <label for="addSubAdm">&emsp;</label>
                            <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#addSubAdm">
                                <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"/>
                            </button>
                        </div>

                        <div id="divSecretaria" class="form-group col-xs-7 col-md-5 has-feedback {{ $errors->has('identificacaoSecretaria') ? ' has-error' : '' }}">
                            <label for="identificacaoSecretaria">Identificação da Secretaria</label>
                            <select class="form-control" name="identificacaoSecretaria" id="identificacaoSecretaria">
                                <option value="">Selecione uma Opção</option>
                                @foreach ($secretarias as $secretaria)
                                    @if ($secretaria->id == old('identificacaoSecretaria'))
                                        <option value="{{$secretaria->id}}" selected>{{$secretaria->sigla}}</option>
                                    @else
                                        <option value="{{$secretaria->id}}">{{$secretaria->sigla}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-xs-2 col-md-1">
                            <label for="addSecretaria">&emsp;</label>
                            <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#addSecretaria">
                                <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"/>
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div id="divCargo" class="form-group col-xs-8 col-md-5 has-feedback {{ $errors->has('cargo') ? ' has-error' : '' }}">
                            <label for="cargo">Cargo</label>
                            <select class="form-control" name="cargo" id="cargo">
                                <option value="">Selecione...</option>
                                @foreach ($cargos as $cargo)
                                    @if ($cargo->id == old('cargo'))
                                        <option value="{{$cargo->id}}" selected>{{$cargo->cargo}}</option>
                                    @else
                                        <option value="{{$cargo->id}}">{{$cargo->cargo}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-xs-2 col-md-1">
                            <label for="addCargo">&emsp;</label>
                            <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#addCargo">
                                <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"/>
                            </button>
                        </div>

                        <div id="divFuncao" class="form-group col-xs-8 col-md-5 has-feedback {{ $errors->has('funcao') ? ' has-error' : '' }}">
                            <label for="funcao">Função</label>
                            <select class="form-control" name="funcao" id="funcao">
                                <option value="">Selecione...</option>
                                @foreach ($funcoes as $funcao)
                                    @if ($funcao->id == old('funcao'))
                                        <option value="{{$funcao->id}}" selected>{{$funcao->sigla}}</option>
                                    @else
                                        <option value="{{$funcao->id}}">{{$funcao->funcao}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-xs-2 col-md-1">
                            <label for="addFunção">&emsp;</label>
                            <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#addFuncao">
                                <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"/>
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6 has-feedback {{ $errors->has('aposentadoria') ? ' has-error' : '' }}">
                            <label for="aposentadoria">Previsão de Aposentadoria</label>
                            <input type="date" class="form-control" name="aposentadoria" id="aposentadoria" value="{{$user->previsao_aposentadoria}}">
                        </div>

                        <div class="form-group col-md-6 has-feedback {{ $errors->has('escolaridade') ? ' has-error' : '' }}">
                            <label for="escolaridade">Nivel de Escolaridade</label>
                            <select class="form-control" name="escolaridade" id="escolaridade">
                                <option value="">Selecione uma Opção</option>
                                @foreach ($escolaridades as $escolaridade)
                                    <option value="{{$escolaridade->id}}">{{$escolaridade->escolaridade}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endhasanyrole

                    @if($user->name == Auth::user()->name)
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="password">Senha</label><br>
                                <input class="form-control" name="password" type="password" value="" id="password">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="password">Confirmar Senha</label><br>
                                <input class="form-control" name="password_confirmation" type="password" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="perguntaSeguranca">Pergunta de Segurança</label><br>
                            <select class="form-control" name="perguntaSeguranca" id="perguntaSeguranca">
                                @foreach($perguntas as $pergunta)
                                    <option value="{{$pergunta->id}}">{{$pergunta->pergunta_seguranca}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="respostaSeguranca">Resposta</label><br>
                            <input class="form-control" name="respostaSeguranca" type="text" value="{{$user->resposta_seguranca}}">
                        </div>
                    @endif

                    <h5><b>Nível de Acesso</b></h5>

                    <div class='form-group'>
                        @if(!(Auth::user()->hasrole('Funcionario')))
                            @hasrole('Administrador')
                            <input type="radio" value="1" name="roles">
                            <label for="Administrador">Administrador</label><br>
                            @endhasrole

                            @hasrole('Administrador|Coordenador')
                            <input type="radio" value="2" name="roles">
                            <label for="Coordenador">Coordenador</label><br>
                            @endhasrole
                        @endif

                        <input type="radio" value="3" name="roles">
                        <label for="Funcionario">Funcionário</label><br>
                    </div>

                    <div class="form-group col-md-12">
                    </div>
                </div>
                <div class="box-footer">
                    <a class="btn btn-default" href="{{ route('usuarios.index', ['type' => '1']) }}">Voltar</a>
                    <input class="btn btn-primary pull-right" type="submit" value="Editar">
                </div>
            </form>
        </div>
        @include('layouts.excluir_confirm')

        @include('layouts.modal', ['idModal' => 'addCargo', 'titulo' => 'Adicionar novo Cargo', 'idInput' => 'novoCargo', 'funcaoJS' => 'insertCargo'])
        @include('layouts.modal', ['idModal' => 'addFuncao', 'titulo' => 'Adicionar nova Função', 'idInput' => 'novaFuncao', 'funcaoJS' => 'insertFuncao'])
        @include('layouts.modal', ['idModal' => 'addSubAdm', 'titulo' => 'Adicionar nova Sub. Administrativa', 'idInput' => 'novaSubAdm', 'funcaoJS' => 'insertSubAdm'])

        <div class="modal fade" id="addSecretaria" role="dialog" aria-labelledby="addSecretariaLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Adicionar nova Secretaria</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Sigla:</label>
                            <input class="form-control" type="text" name="secretariaSigla" id="secretariaSigla" maxlength="6">
                        </div>
                        <div class="form-group">
                            <label>Descrição:</label>
                            <input class="form-control" type="text" name="secretariaDescricao" id="secretariaDescricao">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-success" onclick="insertSecretaria();">Adicionar</button>
                    </div>
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

        // Form confirm (yes/ok) handler, submits form
        $('#confirmDelete').find('.modal-footer #confirm').on('click', function()
        {
            $(this).data('form').submit();
        });

        $(document).ready(function () {
            $('input:radio[name="roles"][value={{$user->roles->first()->id}}]').attr('checked', true);

            $('#identificacaoSecretaria').val("{{$user->secretaria_id}}");
            $('#subordinacaoAdministrativa').val("{{$user->subordinacao_administrativa_id}}");
            $('#cargo').val("{{$user->cargo_id}}");
            $('#funcao').val("{{$user->funcao_id}}");
            $('#escolaridade').val("{{$user->escolaridade_id}}");

            @if($user->name == Auth::user()->name)
                $('#perguntaSeguranca').val("{{$user->perguntaSeguranca->id}}");
            @endif
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

        function insertFuncao()
        {
            let select = document.getElementById("funcao"),
                div = document.getElementById("divFuncao"),
                i = {{$funcoes->count()}},
                txtVal = document.getElementById("novaFuncao").value,
                newOption = document.createElement("OPTION"),
                newInput = document.createElement("INPUT"),
                newOptionVal = document.createTextNode(txtVal);

            if (txtVal !== "")
            {
                newOption.appendChild(newOptionVal);
                newOption.setAttribute("value", `${i}`);
                select.insertBefore(newOption, select.lastChild);
                newOption.setAttribute('selected', 'selected');

                newInput.setAttribute("type", "hidden");
                newInput.setAttribute("name", "novaFuncao");
                newInput.setAttribute("value", newOptionVal.textContent);
                div.insertBefore(newInput, div.lastChild);
            }
            $('#addFuncao').modal('hide');
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
@endsection
