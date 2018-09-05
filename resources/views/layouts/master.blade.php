<!DOCTYPE html>
<html>
<?php
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
?>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Sistema Simbi</title>

        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}" rel="stylesheet">

        <link rel="stylesheet" href="{{asset('css/app.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
        @yield('scripts_css')

    </head>
    <body>
        @include('layouts.br')
        <div class="wrapper">
            @if (!Auth::guest())
                @include ('layouts.sidebar')
            @endif
            <div id="content">
                @if (!Auth::guest())
                   @include ('layouts.navbar')
                @endif
                @if(Session::has('flash_message'))
                    <div class="container">      
                        <div class="alert alert-success"><em> {!! session('flash_message') !!}</em></div>
                    </div>
                @endif 
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">              
                        @include ('layouts.erros')
                    </div>
                </div>
                @yield ('conteudo')
            </div>
        </div>
        <div class="overlay"></div>
        @include ('layouts.scripts')
    </body>
</html>
