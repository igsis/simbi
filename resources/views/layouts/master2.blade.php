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

            @if(Session::has('flash_message'))
                <div class="row" align="center">
                    <div class="col-md-12">
                        <div class="box box-success box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">{!! session('flash_message') !!}</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="remove">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- content-wrapper --}}
            @yield('conteudo')
            <!-- /.content-wrapper -->

        {{-- Include com footer do site <FOOTER> --}}
        @includeIf('layouts.footer')

        </div>
        <!-- ./wrapper -->

        @includeIf('layouts.scripts')

    </body>
</html>
