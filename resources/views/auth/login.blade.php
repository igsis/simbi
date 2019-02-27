@extends('auth.masterauth')

@section('conteudo')
    <p class="login-box-msg">Coloque as informações para o login</p>

    <form method="POST" action="{{ route('login') }}">

        {{ csrf_field() }}
        <div class="form-group has-feedback {{ $errors->has('name') ? ' has-error' : '' }}">
            <input id="login" type="text" class="form-control" name="login" maxlength="7" value="{{ old('login') }}" required placeholder="Usuário">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            @if ($errors->has('login'))
                <span class="help-block">
                        <strong>{{ $errors->first('login') }}</strong>
                    </span>
            @endif
        </div>

        <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
            <input id="password" type="password" class="form-control" name="password" required placeholder="Senha">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if ($errors->has('password'))
                <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
            @endif
        </div>
        <div class="row">
            <div class="col-xs-8">
                <a href="{{ route('password.request') }}">Esqueci minha Senha</a>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
            </div>
            <!-- /.col -->
        </div>
    </form>
@endsection