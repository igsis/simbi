@extends('layouts.master')

@section('conteudo')

    <div class="col-lg-8 col-lg-offset-2">
        <h1><i class="glyphicon glyphicon-user"></i> Editar {{$user->name}}</h1>
        <hr>

        <form method="POST" action="{{ url('usuarios', [$user->id]) }}" accept-charset="UTF-8">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">

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
                    <div class="form-group col-xs-8 col-md-6 has-feedback {{ $errors->has('subordinacaoAdministrativa') ? ' has-error' : '' }}">
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

                    <div class="form-group col-xs-8 col-md-6 has-feedback {{ $errors->has('identificacaoSecretaria') ? ' has-error' : '' }}">
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
                    <div class="form-group col-md-6 has-feedback {{ $errors->has('cargo') ? ' has-error' : '' }}">
                        <label for="cargo">Cargo</label>
                        <input type="text" class="form-control" name="cargo" id="cargo">
                    </div>

                    <div class="form-group col-md-6 has-feedback {{ $errors->has('funcao') ? ' has-error' : '' }}">
                        <label for="funcao">Função</label>
                        <input type="text" class="form-control" name="funcao" id="funcao">
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
                    

                    <input type="radio" value="2" name="roles">
                    <label for="Coordenador">Coordenador</label><br>
                    @endhasrole

                @endif
                    <input type="radio" value="3" name="roles">
                    <label for="Funcionario">Funcionário</label><br>
            </div>
            <input class="btn btn-primary" type="submit" value="Editar">
        </form>
        <br>

        @if($user->name != Auth::user()->name)
        <form id="resetSenha" method="POST" action="{{route('usuarios.reset', $user->id)}}" accept-charset="UTF-8">
            {{ csrf_field() }}
            {{method_field('PUT')}}
            <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Resetar a Senha?" data-message='Desejar realmente resetar a senha deste usuário? Senha: simbi@2018' data-button="Resetar Senha">Resetar Senha</button>
        </form>
        @endif
        @include('layouts.excluir_confirm')
@endsection

@section('scripts_adicionais')
<!-- Script Msg Resetar Senha -->
    <script type="text/javascript">
        $('#confirmDelete').on('show.bs.modal', function (e)
        {
            $message = $(e.relatedTarget).attr('data-message');
            $(this).find('.modal-body p').text($message);
            $title = $(e.relatedTarget).attr('data-title');
            $(this).find('.modal-title').text($title);
            $button = $(e.relatedTarget).attr('data-button');
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

            @if($user->name == Auth::user()->name)
                $('#perguntaSeguranca').val("{{$user->perguntaSeguranca->id}}");
            @endif
        });
    </script>
@endsection