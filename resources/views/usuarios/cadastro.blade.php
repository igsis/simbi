@extends('layouts.master')

@section('conteudo')

    <div class="col-lg-8 col-lg-offset-2">
        <h1><i class="glyphicon glyphicon-user"></i>Cadastrar Usuário</h1>
        <hr>

        <form method="POST" action="{{ route('usuarios.index') }}">
            {{ csrf_field() }}

            <div class="row">
                <div class="form-group col-md-7 has-feedback {{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">Nome</label>
                    <input class="form-control" type="text" name="name" id="name" >
                </div>

                <div class="form-group col-md-5 has-feedback {{ $errors->has('login') ? ' has-error' : '' }}">
                    <label for="login">Login</label>
                    <input class="form-control" type="text" name="login" id="login" maxlength="7">
                </div>

                <div class="form-group col-md-12 has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">E-mail</label>
                    <input class="form-control" type="email" name="email" id="email">
                </div>
            </div>

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
                <div class="form-group col-md-6 has-feedback {{ $errors->has('escolaridade') ? ' has-error' : '' }}">
                    <label for="escolaridade">Nivel de Escolaridade</label>
                    <select class="form-control" name="escolaridade" id="escolaridade">
                        <option value="">Selecione uma Opção</option>
                        @foreach ($escolaridades as $escolaridade)
                            <option value="{{$escolaridade->id}}">{{$escolaridade->escolaridade}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-6 has-feedback {{ $errors->has('aposentadoria') ? ' has-error' : '' }}">
                    <label for="aposentadoria">Previsão de Aposentadoria</label>
                    <input type="date" class="form-control" name="aposentadoria" id="aposentadoria">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12 has-feedback {{ $errors->has('roles') ? ' has-error' : '' }}">
                    <label for="roles">Nivel de Acesso</label>
                    <select class="form-control" name="roles" id="roles">
                        <option value="">Selecione uma Opção</option>
                        @foreach ($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <input class="btn btn-primary" type="submit" value="Adicionar">
        </form>

    @include('layouts.modal', ['idModal' => 'addCargo', 'titulo' => 'Adicionar novo Cargo', 'idInput' => 'novoCargo', 'funcaoJS' => 'insertCargo'])
    @include('layouts.modal', ['idModal' => 'addFuncao', 'titulo' => 'Adicionar nova Função', 'idInput' => 'novaFuncao', 'funcaoJS' => 'insertFuncao'])
    @include('layouts.modal', ['idModal' => 'addSubAdm', 'titulo' => 'Adicionar nova Sub. Administrativa', 'idInput' => 'novaSubAdm', 'funcaoJS' => 'insertSubAdm'])
    @include('layouts.modal', ['idModal' => 'addSecretaria', 'titulo' => 'Adicionar nova Secretaria', 'idInput' => 'novaSecretaria', 'funcaoJS' => 'insertSecretaria'])

    </div>

    {{--TODO: Acertar include abaixo--}}
@endsection
@section('scripts_adicionais')
    @include('scripts.novo_via_modal', [
        'nomeFuncao' => 'insertCargo',
        'idSelect' => 'cargo',
        'divSelect' => 'divCargo',
        'countTabela' => '$cargo->count()',
        'idInputModal' => 'novoCargo'
    ])
    <script>
        function insertFuncao()
        {
            let select = document.getElementById("funcao"),
                div = document.getElementById("divFuncao"),
                i = document.getElementById("funcao").length,
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
    </script>
@endsection