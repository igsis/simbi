<!DOCTYPE html>
<html>
<?php
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
?>

    {{-- Include com cabeçalho do HTML <HEAD> --}}
@include('layouts.head')
@auth
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">
@endauth

@guest
  <body class="hold-transition login-page">
@endguest
    {{-- Include com SideBar da parte de cima do site <HEADER> --}}
    @includeWhen(Auth::user(),'layouts.header')

    {{-- Include com Menu lateral esquerdo do site <ASIDE> --}}
    @includeWhen(Auth::user(),'layouts.sidebarLateral')

@auth
    <div class="content-wrapper">
@endauth

        <!-- Main content -->
        @if(Session::has('flash_message'))
            <div class="col-md-10 col-sm-10">
                <div class="alert alert-success"><em> {!! session('flash_message') !!}</em></div>
            </div>
        @endif
        <div class="row">
            <div class="col-xs-12">
                @includeIf('layouts.erros')
            </div>
        </div>
        <div class="content">
            @auth
            <div class="box box-default">
                <div class="box-body">
            @endauth
                    @yield('conteudo')
            @auth
                </div>
            </div>
            @endauth
        </div>
        
    </div>
    <!-- /.content-wrapper -->
@auth
    {{-- Include com footer do site <FOOTER> --}}
    @includeIf('layouts.footer')
@endauth

</div>
<!-- ./wrapper -->

@includeIf('layouts.scripts')

</body>
</html>
