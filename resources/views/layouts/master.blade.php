<!DOCTYPE html>
<html>
@include('layouts.br')

    {{-- Include com cabeçalho do HTML <HEAD> --}}
@include('layouts.head')

    <body class="hold-transition skin-blue sidebar-mini">

        <div class="wrapper">

        {{-- Include com SideBar da parte de cima do site <HEADER> --}}
        @include('layouts.header')

        {{-- Include com Menu lateral esquerdo do site <ASIDE> --}}
        @include('layouts.sidebarLateral')

            <div class="content-wrapper">

{{--                @if(Session::has('flash_message'))--}}
{{--                    <div style="margin: 15px;">--}}
{{--                        <div class="col-md-12 col-sm-12 center-block" style="margin-top: 15px">--}}
{{--                            <div class="alert alert-success"><em> {!! session('flash_message') !!}</em></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endif--}}
                <div class="row">
                    <div class="col-xs-12">
                        @includeIf('layouts.erros')
                    </div>
                </div>

                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 class="page-header">@yield('tituloPagina')</h1>
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Default box -->
                    <div class="box box-primary">
                        @yield('modulo')
                        <div class="box-header with-border">
                            <h3 class="box-title">@yield('subTitulo')</h3>
                        </div>
                        <div class="box-body">
                            @yield('conteudo')
                        </div>
                    </div>
                </section>
            </div>
            <!-- /.content-wrapper -->

        {{-- Include com footer do site <FOOTER> --}}
        @includeIf('layouts.footer')

        </div>
        <!-- ./wrapper -->

        @includeIf('layouts.scripts')

    </body>
</html>
