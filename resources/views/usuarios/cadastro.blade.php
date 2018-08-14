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
                    <input class="form-control" type="text" name="name" id="name">
                </div>

                <div class="form-group col-md-5 has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">E-mail</label>
                    <input class="form-control" type="email" name="email" id="email">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-3 has-feedback {{ $errors->has('login') ? ' has-error' : '' }}">
                    <label for="login">Login</label>
                    <input class="form-control" type="text" name="login" id="login" maxlength="7">
                </div>

                <div class="form-group col-xs-8 col-md-4 has-feedback {{ $errors->has('subordinacaoAdministrativa') ? ' has-error' : '' }}">
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

                <div class="form-group col-xs-8 col-md-5 has-feedback {{ $errors->has('identificacaoSecretaria') ? ' has-error' : '' }}">
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
            </div>

            <div class="row">
                <div class="form-group col-xs-8 col-md-5 has-feedback {{ $errors->has('cargo') ? ' has-error' : '' }}">
                    <label for="cargo">Cargo</label>
                    <select class="form-control" name="cargo" id="cargo">
                        <option value="">Selecione uma Opção</option>
                        @foreach ($cargos as $cargo)
                            @if ($cargo->id == old('cargo'))
                                <option value="{{$cargo->id}}" selected>{{$cargo->sigla}}</option>
                            @else
                                <option value="{{$cargo->id}}">{{$cargo->sigla}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4 has-feedback {{ $errors->has('aposentadoria') ? ' has-error' : '' }}">
                    <label for="aposentadoria">Previsão de Aposentadoria</label>
                    <input type="date" class="form-control" name="aposentadoria" id="aposentadoria">
                </div>
                <div class="form-group col-xs-8 col-md-5 has-feedback {{ $errors->has('funcao') ? ' has-error' : '' }}">
                    <label for="funcao">Função</label>
                    <select class="form-control" name="funcao" id="funcao">
                        <option value="">Selecione uma Opção</option>
                        @foreach ($funcoes as $funcao)
                            @if ($funcao->id == old('funcao'))
                                <option value="{{$funcao->id}}" selected>{{$funcao->sigla}}</option>
                            @else
                                <option value="{{$funcao->id}}">{{$funcao->sigla}}</option>
                            @endif
                        @endforeach
                    </select>
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
                <div class="form-group col-md-6 has-feedback {{ $errors->has('roles') ? ' has-error' : '' }}">
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

    </div>

@endsection