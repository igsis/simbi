@extends('layouts.master')

@section('conteudo')

    <h1>
        <i class="glyphicon glyphicon-th-list"></i>
        Eventos Cadastrados <br>
        <small>{{ $equipamento->nome }}</small>
    </h1>
    <div class="panel-heading">Pagina {{$eventos->currentPage()}} de {{$eventos->lastPage()}}</div>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
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
                            <a href="{{ route('frequencia.editarOcorrencia', $evento->id) }}" class="btn btn-info" style="margin-right: 3px"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                            <a href="{{ route('eventos.cadastro.ocorrencia', [$equipamento->igsis_id, $evento->igsis_evento_id]) }}" class="btn btn-success" style="margin-right: 3px"><i class="glyphicon glyphicon-plus-sign"></i> Ocorrência</a>
                            @hasrole('Administrador')
                            <form method="POST" action="{{ route('evento.ocorrencia.destroy', $evento->id) }}" style="display: inline;">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Remover {{$evento->nome_evento}}?" data-message='Desejar realmente remover este Evento?' data-footer="Remover"><i class="glyphicon glyphicon-trash"></i> Remover
                                </button>
                            </form>
                            @endhasrole
                        </td>
                    </tr>
            @endforeach
            @include('layouts.excluir_confirm')
            </tbody>
        </table>
    </div>
    <div class="text-center">
        @if(isset($dataForm))
            {!! $eventos->appends($dataForm)->links() !!}
        @else
            {!! $eventos->links() !!}
        @endif
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

@endsection