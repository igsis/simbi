<div class="login-box">
    <div class="login-logo">
        <a href="{{url('/')}}"><b>SIMBI</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Coloque as informações para o login</p>

        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
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
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Mantenha-se Conectado
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <a class="btn btn-link" href="{{ route('password.request') }}">
            Esqueceu sua Senha?
        </a>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->