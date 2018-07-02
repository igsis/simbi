@extends('layouts.master')

@section('conteudo')

<div class="col-lg-6 col-lg-offset-3">
        <h1><i class="glyphicon glyphicon-user"></i> Editar {{$user->name}}</h1>
        <hr>

        <form method="POST" action="{{ url('usuarios', [$user->id]) }}" accept-charset="UTF-8">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">

            <div class="form-group">
                <label for="name">Nome</label>
                <input class="form-control" name="name" type="text" value="{{$user->name}}" id="name">
            </div>

            <div class="row">
                <div class="form-group col-md-3">
                    <label for="login">Login</label>
                    <input class="form-control" type="text" name="login" id="login" maxlength="7" value="{{$user->login}}">{{-- readonly --}}
                </div>

                <div class="form-group col-md-9">
                    <label for="email">Email</label>
                    <input class="form-control" name="email" type="email" value="{{$user->email}}" id="email">
                </div>
            </div>

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
            @endif

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
                <input class="form-control" name="respostaSeguranca" readonly type="text" value="{{$user->resposta_seguranca}}">
            </div>
            

            <h5><b>Adicionar Cargo</b></h5>

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
        </form><br>
        @if($user->name != Auth::user()->name)
        <form id="resetSenha" method="POST" action="{{ url('usuarios', [$user->id])}}" accept-charset="UTF-8">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="novaSenha">
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

            @if($user->name == Auth::user()->name)
                $('#perguntaSeguranca').val("{{$user->perguntaSeguranca->id}}");
            @endif
        });
    </script>
@endsection