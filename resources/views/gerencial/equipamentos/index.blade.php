@extends('layouts.master2')

@section('linksAdicionais')
    @includeIf('links.tabelas_AdminLTE')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@section('titulo')
    @if($type == 1)
        {{$pagina = "Equipamentos Cadastrados"}}
    @else
        {{$pagina = "Equipamentos Desativados"}}
    @endif
    {{$pagina}}
@endsection

@section('conteudo')

    <div class="content-wrapper">

        <div class="row">
            <div class="col-xs-12">
                @includeIf('layouts.erros')
            </div>
        </div>

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="page-header"><i class="glyphicon glyphicon-home"></i>
                {{-- Equipamento ativo --}}
                {{ $pagina }}
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Pesquisa de equipamentos</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <div class="btn-tabela">
                            @if($type == 1)
                                <a href="{{ route('equipamentos.cadastro') }}" class="btn btn-success"><i
                                            class="glyphicon glyphicon-plus"></i> &nbsp; Adicionar Equipamento</a>
                                <a href="{{ route('equipamentos.importar') }}" class="btn bg-purple"><i
                                            class="glyphicon glyphicon-list-alt"></i> &nbsp; Importar do Siscontrat</a>
                                <button class="btn bg-navy" type="button" data-toggle="modal"
                                        data-target="#confirmTroca" data-title="Formulário"
                                        data-message='Deseja Trocar o Formulário para o modelo Completo?'
                                        data-footer="Trocar"><i
                                            class="fa fa-exchange" id="botaomaluco"></i> &nbsp; Trocar Formulário
                                </button>
                            @endif
                        </div>
                        <table id="tabela1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Nome do Equipamento</th>
                                <th>Sigla do Equipamento</th>
                                <th>Telefone</th>
                                <th>Status</th>
                                <th>Operações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($equipamentos as $equipamento)
                                <tr>
                                    <td>{{$equipamento->nome}}</td>
                                    <td>{{$equipamento->equipamento_sigla}}</td>
                                    <td>{{$equipamento->telefone}}</td>
                                    <td>{{$equipamento->status->descricao}}</td>
                                    <td>
                                        @if($type == 1)
                                            @hasrole('Administrador')
                                            <a href="{{ route('equipamentos.editar', $equipamento->id) }}"
                                               class="btn btn-info"><i class="glyphicon glyphicon-pencil"></i> Editar
                                                Equipamento</a>
                                            @endhasrole
                                            &nbsp; <a href="{{ route('equipamentos.show', $equipamento->id) }}"
                                                      class="btn btn-warning" style="margin-right: 3px"><i
                                                        class="glyphicon glyphicon-eye-open"></i> Mais Detalhes</a>
                                        @endif
                                        @hasrole('Administrador')
                                        @if($equipamento->publicado == 1)
                                            <form method="POST"
                                                  action="{{ route('equipamentos.destroy', $equipamento->id, $type) }}"
                                                  style="display: inline;">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="type" value="{{ $type }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-danger" type="button" data-toggle="modal"
                                                        data-target="#confirmDelete"
                                                        data-title="Desativar {{$equipamento->nome}}?"
                                                        data-message='Desejar realmente desativar este Equipamento?'
                                                        data-footer="Desativar"><i
                                                            class="glyphicon glyphicon-trash"></i>
                                                    Desativar
                                                </button>
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('ativar.equipamento') }}"
                                                  style="display: inline;">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="type" value="{{ $type }}">
                                                <input type="hidden" name="id" value="{{ $equipamento->id }}">
                                                <input type="hidden" name="_method" value="PUT">
                                                <button class="btn btn-success" type="button" data-toggle="modal"
                                                        data-target="#confirmDelete"
                                                        data-title="Ativar {{$equipamento->name}}?"
                                                        data-message='Desejar realmente ativar este usuario?'
                                                        data-footer="Ativar"><i class="glyphicon glyphicon-ok"></i>
                                                    Ativar
                                                </button>
                                            </form>
                                        @endif
                                        @endhasrole
                                    </td>
                                </tr>
                            @endforeach
                            @include('layouts.excluir_confirm')
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Nome do Equipamento</th>
                                <th>Sigla do Equipamento</th>
                                <th>Telefone</th>
                                <th>Status</th>
                                <th>Operações</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="text-center">
                        @if(isset($dataForm))
                            {!! $equipamentos->appends($dataForm)->links() !!}
                        @else
                            {{--                            {!! $equipamentos->links() !!}--}}
                        @endif

                    </div>

                </div>
            </div>
        </section>
    </div>
    @if($type == 1)
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
    @endif


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
