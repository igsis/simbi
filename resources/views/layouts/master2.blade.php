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
