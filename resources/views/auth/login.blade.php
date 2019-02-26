<div class="login-box">
    <div class="login-logo">
        <a href="{{url('/')}}"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="form-group has-feedback {{ $errors->has('name') ? ' has-error' : '' }}">
                <input id="login" type="text" class="form-control" name="login" maxlength="7" value="{{ old('login') }}" required autofocus>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                @if ($errors->has('login'))
                    <span class="help-block">
                                    <strong>{{ $errors->first('login') }}</strong>
                                </span>
                @endif
            </div>
            <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" class="form-control" name="password" required>
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


    {{--<div class="row">--}}
        {{--<div class="col-md-8 col-md-offset-2">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">Login</div>--}}

                {{--<div class="panel-body">--}}
                {{--<form class="form-horizontal" method="POST" action="{{ route('login') }}">--}}
                    {{--{{ csrf_field() }}--}}

                    {{--<div class="form-group has-feedback {{ $errors->has('name') ? ' has-error' : '' }}">--}}
                        {{--<label for="login" class="col-md-4 control-label">Login</label>--}}

                        {{--<div class="col-md-6">--}}
                            {{--<input id="login" type="text" class="form-control" name="login" maxlength="7" value="{{ old('login') }}" required autofocus>--}}
                            {{--<span class="glyphicon glyphicon-user form-control-feedback"></span>--}}
                            {{--@if ($errors->has('login'))--}}
                                {{--<span class="help-block">--}}
                                    {{--<strong>{{ $errors->first('login') }}</strong>--}}
                                {{--</span>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">--}}
                        {{--<label for="password" class="col-md-4 control-label">Senha</label>--}}

                        {{--<div class="col-md-6">--}}
                            {{--<input id="password" type="password" class="form-control" name="password" required>--}}
                                {{--<span class="glyphicon glyphicon-lock form-control-feedback"></span>--}}
                            {{--@if ($errors->has('password'))--}}
                                {{--<span class="help-block">--}}
                                    {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                {{--</span>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<div class="col-md-6 col-md-offset-4">--}}
                            {{--<div class="checkbox">--}}
                                {{--<label>--}}
                                    {{--<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Mantenha-se Conectado--}}
                                {{--</label>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<div class="col-md-8 col-md-offset-4">--}}
                            {{--<button type="submit" class="btn btn-primary">--}}
                                {{--Login--}}
                            {{--</button>--}}

                            {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
                                {{--Esqueceu sua Senha?--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</form>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}