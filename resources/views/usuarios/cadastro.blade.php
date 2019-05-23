@extends('layouts.master2')

@section('titulo', 'Cadastrar Usuario')

@section('conteudo')
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="page-header"><i class="glyphicon glyphicon-user"></i> Cadastrar Usuário</h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Usuário</h3>
            </div>

            <div class="row">
                <div class="col-md-12">
                    @includeIf('layouts.erros')
                </div>
            </div>
            <form method="POST" action="{{ route('usuarios.index') }}">
                {{ csrf_field() }}
                <input type="hidden" value="{{$funcionario->id}}" name="id_funcionario" id="id_funconario">
                <div class="box-body">
                    <div class="col-10">
                        <div class="row">
                            <div class="form-group col-md-6 has-feedback {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">Nome *</label>
                                <input class="form-control" type="text" name="name" id="name" value="@isset($funcionario->nome) {{ $funcionario->nome }} @endisset @empty($funcionario->nome) {{old('name')}} @endempty" required>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col-md-6 has-feedback {{ $errors->has('login') ? ' has-error' : '' }}">
                                <label for="login">Login *</label>
                                <input class="form-control" type="text" name="login" id="login" maxlength="7"  required>
                                @if ($errors->has('login'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('login') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">E-mail *</label>
                                <input class="form-control" type="email" name="email" id="email" value="@isset($funcionario->email) {{ $funcionario->email }} @endisset @empty($funcionario->email) {{old('email')}} @endempty" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 has-feedback">
                                <label for="">Senha:</label>
                                <p>simbi@2019</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 has-feedback {{ $errors->has('roles') ? ' has-error' : '' }}">
                                <label for="roles">Nivel de Acesso *</label>
                                <select class="form-control" name="roles" id="roles">
                                    <option value="">Selecione uma Opção</option>
                                    @foreach ($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('roles'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('roles') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div class="row">

                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="{{route('usuarios.index', ['type' => '1'])}}" class="btn btn-default">Retornar</a>
                    <input type="submit" class="btn btn-primary pull-right" name="enviar" value="Adicionar">
                </div>
            </form>
        </div>

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
    <script>
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
                newOption.setAttribute("value", `${i + 1}`);
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
                newInput.setAttribute("name", "descricaoSecretaria");
                newInput.setAttribute("value", newOptionVal.textContent);
                div.insertBefore(newInput, div.lastChild);

                newInput2.setAttribute("type", "hidden");
                newInput2.setAttribute("name", "siglaSecretaria");
                newInput2.setAttribute("value", newOptionVal2.textContent);
                div.insertBefore(newInput2, div.lastChild);
            }
            $('#addSecretaria').modal('hide');
            $("input[id='novaSecretaria']").val('');
        }
    </script>
@endsection