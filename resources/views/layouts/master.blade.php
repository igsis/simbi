<!DOCTYPE html>
<html>
<?php
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
?>

    {{-- Include com cabeçalho do HTML <HEAD> --}}
    @includeIf('layouts.head')

<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

    {{-- Include com SideBar da parte de cima do site <HEADER> --}}
    @if(!Auth::guest())
        @includeIf('layouts.header')
    @endif
    {{-- Include com Menu lateral esquerdo do site <ASIDE> --}}
    @if(!Auth::guest())
        @includeIf('layouts.sidebarLateral')
    @endif

    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        {{--<section class="content-header">--}}
            {{--<h1>--}}
                {{--Dashboard--}}
                {{--<small>Version 2.0</small>--}}
            {{--</h1>--}}
            {{--<ol class="breadcrumb">--}}
                {{--<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>--}}
                {{--<li class="active">Dashboard</li>--}}
            {{--</ol>--}}
        {{--</section>--}}

        <!-- Main content -->
        @if(Session::has('flash_message'))
            <div class="col-md-10 col-sm-10">
                <div class="alert alert-success"><em> {!! session('flash_message') !!}</em></div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-10 col-sm-10">
                @includeIf('layouts.erros')
            </div>
        </div>
        <section class="content">
            @yield('conteudo')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    {{-- Include com footer do site <FOOTER> --}}
    @includeIf('layouts.footer')


</div>
<!-- ./wrapper -->

@includeIf('layouts.scripts')

</body>
</html>
