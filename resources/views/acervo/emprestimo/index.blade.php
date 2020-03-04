@extends('layouts.master2')

@section('linksAdicionais')
    @includeIf('links.tabelas_AdminLTE')
@endsection

@section('titulo','Empréstimo')

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
                Empréstimos <small>{{$equipamentos->nome}}</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Registros</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="tabela1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Mês-Ano</th>
                                <th>Livro</th>
                                <th>Audio-Visual</th>
                                <th>Mangá</th>
                                <th>Revista</th>
                                <th>Suportes</th>
                                <th>Data de envio</th>
                                <th>Operações</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($emprestimos as $emprestimo)
                                <tr>
                                    <td>{{$emprestimo->mes}}- {{$emprestimo->ano}}</td>
                                    <td>{{$emprestimo->livro}}</td>
                                    <td>{{$emprestimo->audio_visual}}</td>
                                    <td>{{$emprestimo->manga}}</td>
                                    <td>{{$emprestimo->revista}}</td>
                                    <td>{{$emprestimo->suportes}}</td>
                                    <td>{{ date('d/m/Y', strtotime($emprestimo->data_envio)) }}</td>
                                    <td>
                                        <a href="{{ route('emprestimo.editar', [$equipamentos->id, $emprestimo->id]) }}"
                                           class="btn btn-info" style="margin-right: 3px"><i
                                                    class="glyphicon glyphicon-plus-sign"></i> Editar</a>
                                        <form method="get" action="{{ route('emprestimo.delete', [$equipamentos->id, $emprestimo->id]) }}" style="display: inline;">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="type" value="">
                                            <input type="hidden" name="id" value="">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button class="btn btn-danger" data-footer="Excluir" type="button"
                                                    data-toggle="modal" data-target="#confirmDelete" data-title="Excluir"
                                                    data-message='Deseja excluir este registro?'>
                                                <i class="glyphicon glyphicon-trash"></i> Excluir
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfooter>
                                <thead>
                                <tr>
                                    <th>Mês-Ano</th>
                                    <th>Livro</th>
                                    <th>Audio-Visual</th>
                                    <th>Mangá</th>
                                    <th>Revista</th>
                                    <th>Suportes</th>
                                    <th>Data de envio</th>
                                    <th>Operações</th>
                                </tr>
                                </thead>
                            </tfooter>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('layouts.excluir_confirm')
@endsection

@section('scripts_adicionais')
    @include('scripts.tabelas_admin')

    <script>
        $('#confirmDelete').on('show.bs.modal', function (e)
        {
            $('.modal').addClass('bg-danger');
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
