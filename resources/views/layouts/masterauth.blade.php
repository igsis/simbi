<!DOCTYPE html>
<html>
@include('layouts.br')

{{-- Include com cabeçalho do HTML <HEAD> --}}
@include('layouts.head')

<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{url('/')}}"><b>SIMBI</b></a>
    </div>

        @yield("conteudo")
</div>
<!-- /.login-box -->
</body>
</html>