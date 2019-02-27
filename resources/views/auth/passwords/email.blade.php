@extends('auth.masterauth')

@section('conteudo')
    <p class="login-box-msg">Recuperação de Senha</p>

    <form method="POST" action="{{ route('password.request') }}">
        {{csrf_field()}}
        <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @if ($errors->has('login'))
                <span class="help-block">
                    <strong>{{ $errors->first('login') }}</strong>
                </span>
            @endif
        </div>

        <div class="row">
            <div class="col-xs-8">
                <a href="{{ route('login') }}">Voltar a tela de login</a>
            </div>
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Enviar</button>
            </div>
        </div>
    </form>
@endsection
