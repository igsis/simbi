@extends('layouts.master2')

@section('linksAdicionais')
    @includeIf('links.tabelas_AdminLTE')
@endsection

@section('titulo','Ocorrências de Eventos')

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
                Ocorrências de Eventos
                <small>{{ $equipamento->nome }}</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Lista de Ocorrências</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="tabela1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="50%">Ocorrências</th>
                                <th>Data</th>
                                <th>Hora</th>
                                <th>Operações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($eventos as $evento)
                                <input type="hidden" value="{{ $igsis_id = $evento->igsis_id }}">
                                @if(!(in_array($evento->id, $frequenciasCadastradas)))
                                    <tr>
                                        <td>{{ $evento->nome_evento }}</td>
                                        <td>{{ date('d/m/Y', strtotime($evento->data)) }}</td>
                                        <td>{{ date('H:i', strtotime($evento->horario)) }}</td>
                                        <td>
                                            <a href="{{ route('frequencia.editarOcorrencia', $evento->id) }}" class="btn btn-info" style="margin-right: 3px"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                                            <a href="{{ route('frequencia.cadastro', $evento->id) }}" class="btn btn-success" style="margin-right: 3px"><i class="glyphicon glyphicon-plus-sign"></i> Frequência</a>
                                            @hasrole('Administrador')
                                            <form method="POST" action="{{ route('evento.ocorrencia.destroy', $evento->id) }}" style="display: inline;">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Remover {{$evento->nome_evento}}?" data-message='Desejar realmente remover esta ocorrência?' data-footer="Remover"><i class="glyphicon glyphicon-trash"></i> Remover
                                                </button>
                                            </form>
                                            @endhasrole
                                        </td>
                                    </tr>
                                @else
                                    <tr class="bg-success">
                                        <td class="bg-success">{{ $evento->nome_evento }}</td>
                                        <td class="bg-success">{{ date('d/m/Y', strtotime($evento->data)) }}</td>
                                        <td class="bg-success">{{ date('H:i', strtotime($evento->horario)) }}</td>
                                        <td class="bg-success">
                                            <a href="{{ route('frequencia.editarOcorrencia', $evento->id) }}" class="btn btn-info" style="margin-right: 3px"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                                            <a href="{{ route('frequencia.cadastro', $evento->id) }}" disabled class="btn btn-success disabled" role="button" aria-disabled="true" style="margin-right: 3px"><i class="glyphicon glyphicon-plus-sign"></i> Frequência</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            @include('layouts.excluir_confirm')
                            </tbody>
                            <tfooter>
                                <thead>
                                <tr>
                                    <th width="50%">Ocorrências</th>
                                    <th>Data</th>
                                    <th>Hora</th>
                                    <th>Operações</th>
                                </tr>
                                </thead>
                            </tfooter>
                        </table>
                    </div>
                    <a href="{{ route('eventos.cadastro', $equipamento->igsis_id) }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Adicionar Evento</a>
                    <a href="{{ route('eventos.listar', $equipamento->igsis_id) }}" class="btn btn-success"><i class="glyphicon glyphicon-list"></i> Listar Eventos</a>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts_adicionais')
    <script type="text/javascript">

        $('#confirmDelete').on('show.bs.modal', function (e)
        {
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
        $('#confirmDelete').find('.modal-footer #confirm').on('click', function()
        {
            $(this).data('form').submit();
        });

    </script>

    @include('scripts.tabelas_admin')

@endsection