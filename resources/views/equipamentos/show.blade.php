@extends ('layouts.master2')

@section('tituloPagina')
    Detalhes <small>{{$equipamento->nome}}</small>
@endsection

@section('conteudo')
<div class="content-wrapper">


    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="page-header">@yield('tituloPagina')</h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#dados-equipamento" data-toggle="tab">Dados do Equipamento</a></li>
                <li><a href="#dados-endereco" data-toggle="tab">Dados do Endereço</a></li>
                <li><a href="#ocorrencia" data-toggle="tab">Ocorrências</a></li>
                <li><a href="#reformas" data-toggle="tab">Reformas</a></li>
                <li><a href="#detalhes-tecnicos" data-toggle="tab">Detalhes Técnicos</a></li>
                <li><a href="#capacidade" data-toggle="tab">Capacidade</a></li>
                <li><a href="#area" data-toggle="tab">Area</a></li>
            </ul>
            <div class="tab-content">
                <!-- boxDados.blade.php -->
                @include('equipamentos.boxDados')

                <!-- boxEndereco.blade.php -->
                @include('equipamentos.boxEndereco')

                <!-- boxDados.blade.php -->
                @include('equipamentos.boxOcorrencias')

                <!-- boxReformas.blade.php -->
                @include('equipamentos.boxReformas')

                <!-- boxReformas.blade.php -->
                @include('equipamentos.boxDetalhesTecnicos')

                <!-- boxReformas.blade.php -->
                @include('equipamentos.boxCapacidade')

                <!-- boxReformas.blade.php -->
                @include('equipamentos.boxArea')

            </div>
        </div>

    </section>
</div>
@endsection

@section('scripts_adicionais')
    <script type="text/javascript">
        // Script Confirmar Troca Formulário
        $('#confirmTroca').on('show.bs.modal', function (e)
        {
            $title = $(e.relatedTarget).attr('data-title');
            $(this).find('.modal-title p').text($title);
            $message = $(e.relatedTarget).attr('data-message');
            $(this).find('.modal-body p').text($message);

            // Pass form reference to modal for submission on yes/ok
            var form = $(e.relatedTarget).closest('form');
            $(this).find('.modal-footer #confirm').data('form', form);
        });
        // Form confirm (yes/ok) handler, submits form
        $('#confirmTroca').find('.modal-footer #confirm').on('click', function()
        {
            $(this).data('form').submit();
        });
    </script>

@endsection