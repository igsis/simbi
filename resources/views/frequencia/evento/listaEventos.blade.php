@extends('layouts.master2')

@section('linksAdicionais')
    @includeIf('links.tabelas_AdminLTE')
@endsection

@section('titulo','Eventos Cadastrados')


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
                <i class="glyphicon glyphicon-th-list"></i>
                Eventos Cadastrados
                <small>{{ $equipamento->nome }}</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Pesquisa de eventos</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <div class="btn-tabela">
                            <a href="{{ route('eventos.cadastro', $equipamento->id) }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Adicionar
                                Evento</a>
                            <a href="{{ route('eventos.importar', $equipamento->id) }}"  class="btn bg-purple"><i
                                        class="glyphicon glyphicon-list-alt"></i> &nbsp;&nbsp;Importar Evento do SisContrat</a>
                        </div>
                        <table id="tabela1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="50%">Eventos</th>
                                <th>Tipo do Evento</th>
                                <th>Operações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($eventos as $evento)
                                <tr>
                                    <td>{{ $evento->nome_evento }}</td>
                                    <td>{{ $evento->tipoEvento->tipo_evento }}</td>
                                    <td>
                                        <a href="{{ route('eventos.cadastro.ocorrencia', [$equipamento->id,$evento->id]) }}"
                                           class="btn btn-success" style="margin-right: 3px"><i
                                                    class="glyphicon glyphicon-plus-sign"></i> Ocorrência</a>&nbsp &nbsp;
                                        <a href="{{ route('eventos.editar', [$equipamento->id,$evento->id]) }}"
                                           class="btn btn-info"><i class="glyphicon glyphicon-pencil"></i> Editar Evento</a>
                                    </td>
                                </tr>
                            @endforeach
                            @include('layouts.excluir_confirm')
                            </tbody>
                            <tfooter>
                                <tr>
                                    <th width="50%">Eventos</th>
                                    <th>Tipo do Evento</th>
                                    <th>Operações</th>
                                </tr>
                            </tfooter>
                        </table>
                    </div>

                </div>
            </div>
        </section>
    </div>


@endsection

@section('scripts_adicionais')
    <script type="text/javascript">

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

    </script>

    @include('scripts.tabelas_admin')

@endsection