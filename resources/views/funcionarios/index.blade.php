@extends('layouts.master2')

@section('linksAdicionais')
    @includeIf('links.tabelas_AdminLTE')
@endsection

@section('titulo')
    @if($type == 1)
        {{$pagina = "Funcionários Cadastrados"}}
    @else
        {{$pagina = "Funcionários Desativados"}}
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
        <h1 class="page-header">
            <i class="glyphicon glyphicon-user"></i>
            {{-- Equipamento ativo --}}
            {{$pagina}}
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Pesquisa de Funcionários</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <div class="btn-tabela">
                        @hasrole('Administrador')
                        @if($type == 1)
                            <a href="{{ route('usuarios.cadastro') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Adicionar Usuario</a>
                        @endif
                        @endhasrole
                    </div>
                    <table id="tabela1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Cargo</th>
                            <th>Função</th>
                            <th>Operações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->nome }}</td>
                                <td>{{ $user->cargo->cargo }}</td>
                                <td>{{ $user->funcao->funcao }}</td>
                                <td>
                                    @if($type == 1)
                                        <a href="{{ route('funcionarios.editar', $user->id) }}" class="btn btn-info pull-left" style="margin-right: 3px"><i class="glyphicon glyphicon-pencil"></i> Editar</a>
                                    @endif
                                    @hasrole('Administrador')
                                    @if($user->publicado == 1)
                                        <form method="POST" action="{{ route('usuarios.destroy', $user->id) }}" style="display: inline;">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="type" value="{{ $type }}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button class="btn btn-danger" data-footer="Desativar" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Desativar {{$user->name}}?" data-message='Desejar realmente desativar este usuário?'><i class="glyphicon glyphicon-trash"></i> Desativar
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('ativar.user') }}" style="display: inline;">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="type" value="{{ $type }}">
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                            <input type="hidden" name="_method" value="PUT">
                                            <button class="btn btn-success" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Ativar {{$user->name}}?" data-message='Desejar realmente ativar este usuário?' data-footer="Ativar"><i class="glyphicon glyphicon-ok"></i> Ativar
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
                            <th>Nome</th>
                            <th>Cargo</th>
                            <th>Função</th>
                            <th>Operações</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="text-center">
{{--            @if(isset($dataForm))--}}
{{--                {!! $users->appends($dataForm)->links() !!}--}}
{{--            @else--}}
{{--                {!! $users->links() !!}--}}
{{--            @endif--}}

        </div>


        {{--Modal para vincular Equipamentos--}}
        <div class="modal fade" id="vinculaEquipamento" role="dialog" aria-labelledby="vinculaEquipamentoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Vincular equipamento ao usuário</h4>
                    </div>
                    <div class="modal-body">
                        <form id="formVincula" method="POST" {{--action via javascript--}}>
                            {{csrf_field()}}
                            <input type="hidden" name="type" value="{{ $type }}">
                            @foreach($equipamentos as $equipamento)
                                <div class="checkbox-inline">
                                    <label><input type="checkbox" name="equipamento[]" value="{{$equipamento->id}}">{{$equipamento->nome}}</label>
                                </div>
                            @endforeach
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-success" value="Vincular">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('scripts_adicionais')
    <script type="text/javascript">
        // Script Msg Excluir Usuario
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

        // Alimenta o modal com informações de cada usuario
        $('#vinculaEquipamento').on('show.bs.modal', function (e)
        {
            let nome = $(e.relatedTarget).attr('data-nome');
            $(this).find('.modal-title').text(`Vincular equipamento ao usuário: ${nome}`);

            let id = $(e.relatedTarget).attr('data-id');
            $(this).find('#formVincula').attr('action', `{{url('usuarios')}}/${id}/vincular`);
        });
    </script>

    @includeIf('scripts.tabelas_admin')

@endsection