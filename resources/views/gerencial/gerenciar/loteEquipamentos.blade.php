@extends('layouts.master2')

@section('linksAdicionais')
    @includeIf('links.tabelas_AdminLTE')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@section('titulo','Trocar Formulário')

@section('conteudo')

    <div class="content-wrapper">

        <div class="row">
            <div class="col-xs-12">
                @includeIf('layouts.erros')
            </div>
        </div>

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="page-header">
                <i class="glyphicon glyphicon-home"></i>
                Trocar Formulário dos Equipamentos
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Lista de Equipamentos</h3>

                    <button class="btn bg-orange btn-flat  pull-right" type="button" data-toggle="modal"
                            data-target="#confirmTroca" data-title="Formulário"
                            data-message='Deseja Trocar o Formulário para o modelo Completo?'
                            data-footer="Trocar"><i
                                class="fa fa-exchange" id="botaomaluco"></i> &nbsp; Trocar Formulário
                    </button>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="tabela1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Nome do Equipamento</th>
                                <th>Formulário Ativo</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($equipamentos as $equipamento)
                                <tr>
                                    <td>{{$equipamento->nome}}</td>
                                    @if ($equipamento->portaria == 1)
                                        <td>Formulário Completo</td>
                                    @else
                                        <td>Formulário Simples</td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                            <tfooter>
                                <thead>
                                <tr>
                                    <th>Nome do Equipamento</th>
                                    <th>Formulário Ativo</th>
                                </tr>
                                </thead>
                            </tfooter>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="cadastroPortariaSimples" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="glyphicon glyphicon-user"></i> Público Atendido</h4>
                </div>
                <!-- inicio do form -->
                <form method="post">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="page-header">
                                    Data do Evento
                                </h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="data">Data</label>
                                <div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy"
                                     data-date-end-date="0d">
                                    <input type="text" class="form-control" name="data" id="data">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </div>
                                </div>
                                {{--<label for="data">Data</label>--}}
                                {{--<input class="form-control" type="date" name="data" id="data" value="{{old('data')}}">--}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="page-header">
                                    Público Atendido
                                </h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-6">
                                <label for="nome">Quantidade</label>
                                <input type="number" class="form-control" id="quantidade" name="quantidade"
                                       value="{{ old('quantidade') }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <input class="btn btn-success" type="submit" value="Cadastrar">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmTroca" role="dialog" aria-labelledby="confirmTrocaLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><p>Alterar para Formulário</p>
                    </h4>
                </div>
                <form action="{{route('equipamento.altPortaria')}}" method="post">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group">
                            <p>Selecione quais equipamentos irão trocar o tipo de Formulário:</p>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="biblioteca" id="biblioteca" value="1">Bibliotecas CSMB
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="onibus" id="onibus" value="1">Ônibus Biblioteca
                            </label>
                        </div>
                        <div class="form-group">
                            <p>Selecione o tipo de Formulário:</p>
                            <input name="tipoForm" type="checkbox" checked data-toggle="toggle" data-on="Completo"
                                   data-off="Simples" data-onstyle="info" data-offstyle="primary" data-width="150">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="_method" value="PUT">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success" id="confirm">Trocar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('scripts_adicionais')

    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script type="text/javascript">
        // Script Msg Excluir Equipamento
        $('#confirmDelete').on('show.bs.modal', function (e) {
            $message = $(e.relatedTarget).attr('data-message');
            $(this).find('.modal-body p').text($message);
            $title = $(e.relatedTarget).attr('data-title');
            $(this).find('.modal-title').text($title);
            $message = $(e.relatedTarget).attr('data-footer');
            $(this).find('.modal-footer #confirm ').text($message);

            // Pass form reference to modal for submission on yes/ok
            var form = $(e.relatedTarget).closest('form');
            $(this).find('.modal-footer #confirm').data('form', form);
        });

        // Form confirm (yes/ok) handler, submits form
        $('#confirmDelete').find('.modal-footer #confirm').on('click', function () {
            $(this).data('form').submit();
        });
        $(function () {
            $('#toggle-btn').bootstrapToggle({
                on: 'Enabled',
                off: 'Disabled'
            });
        });
    </script>
    @includeIf('scripts.tabelas_admin')
@endsection
