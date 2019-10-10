@extends ('layouts.master2')

@section('titulo','Detalhes')

@section('tituloPagina')
    Detalhes <small>{{$equipamento->nome}}</small>
@endsection

@section('formulario')
    @if ($equipamento->portaria == 1)
        <h3 class="profile-username text-center">Formulário Completo</h3>

        <p class="text-muted text-center">Ativado</p>

{{--        <form method="POST" action="{{ route('equipamentos.editPortaria', $equipamento->id) }}">--}}
{{--            {{ csrf_field() }}--}}
{{--            <input type="hidden" name="id" value="{{ $equipamento->id }}">--}}
{{--            <input type="hidden" name="_method" class="form-control" value="PUT">--}}
{{--            <button class="btn btn-primary btn-block" type="button" data-toggle="modal" data-target="#confirmTroca" data-title="Formulário" data-message='Deseja Trocar o Formulário para o modelo Simples?' data-footer="Trocar"> Trocar Formulário--}}
{{--            </button>--}}
{{--        </form>--}}

    @else

        <h3 class="profile-username text-center">Formulário Simples</h3>

        <p class="text-muted text-center">Ativado</p>

{{--        <form method="POST" action="{{ route('equipamentos.editPortaria', $equipamento->id) }}">--}}
{{--            {{ csrf_field() }}--}}
{{--            <input type="hidden" name="id" value="{{ $equipamento->id }}">--}}
{{--            <input type="hidden" name="_method" value="PUT">--}}
{{--            <button class="btn btn-primary btn-block" type="button" data-toggle="modal" data-target="#confirmTroca" data-title="Formulário" data-message='Deseja Trocar o Formulário para o modelo Completo?' data-footer="Trocar"> Trocar Formulário--}}
{{--            </button>--}}
{{--        </form>--}}
    @endif
@endsection

@section('conteudo')
<div class="content-wrapper">


    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="page-header">@yield('tituloPagina')</h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-body">
                        @yield('formulario')
                        <hr>
                        <a href="{{route('equipamentos.index', ['type' => '1'])}}" class="btn btn-default btn-block">
                            Retornar à Lista de Equipamentos
                        </a>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    @includeIf('layouts.erros')
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
                    @include('gerencial.equipamentos.boxDados')

                    <!-- boxEndereco.blade.php -->
                    @include('gerencial.equipamentos.boxEndereco')

                    <!-- boxDados.blade.php -->
                    @include('gerencial.equipamentos.boxOcorrencias')

                    <!-- boxReformas.blade.php -->
                    @include('gerencial.equipamentos.boxReformas')

                    <!-- boxReformas.blade.php -->
                    @include('gerencial.equipamentos.boxDetalhesTecnicos')

                    <!-- boxReformas.blade.php -->
                    @include('gerencial.equipamentos.boxCapacidade')

                    <!-- boxReformas.blade.php -->
                        @include('gerencial.equipamentos.boxArea')

                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

{{--    <div class="modal fade" id="confirmTroca" role="dialog" aria-labelledby="confirmTrocaLabel" aria-hidden="true">--}}
{{--        <div class="modal-dialog">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>--}}
{{--                    <h4 class="modal-title"><p>Formulário</p></h4>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <p>Confirma?</p>--}}
{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>--}}
{{--                    <button type="button" class="btn btn-success" id="confirm">Trocar</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
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