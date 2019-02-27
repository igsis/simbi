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

                @if(Session::has('flash_message'))
                    <div class="col-md-12 col-sm-12 center-block" style="margin-top: 15px">
                        <div class="alert alert-success"><em> {!! session('flash_message') !!}</em></div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-xs-12">
                        @includeIf('layouts.erros')
                    </div>
                </div>

                <!-- Main content -->
                <div class="content">
                    <div class="box box-default">
                        <div class="box-body">
                            @yield('conteudo')
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-wrapper -->

        {{-- Include com footer do site <FOOTER> --}}
        @includeIf('layouts.footer')

        </div>
        <!-- ./wrapper -->

        @includeIf('layouts.scripts')

    </body>
</html>
