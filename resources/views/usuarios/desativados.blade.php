@extends('layouts.master')

@section('conteudo')

<h1><i class="glyphicon glyphicon-user"></i>Usuários Desativados</h1>
<div class="panel-heading">Página {{ $users->currentPage() }} de {{ $users->lastPage() }}</div>

<div class="">
    <form action="{{ route('users.disabled') }}" method="POST" class="form form-inline">
        {{ csrf_field() }}
        {{-- <input type="hidden" name="_method" value="PATCH"> --}}
        <input type="text" name="name" class="form-control" placeholder="Nome" title="Pesquisar usuários pelo Nome">
        <input type="text" name="login" class="form-control" placeholder="Login" title="Pesquisar usuários pelo Login/Prodam">
        <input type="text" name="email" class="form-control" placeholder="E-mail" title="Pesquisar usuários pelo E-mail">
        {{-- <input type="text" class="form-control" placeholder="Cargo"> --}}
        <button class="btn btn-primary"><i class="glyphicon glyphicon-search"></i>
        Pesquisar</button>
    </form>
</div>
<hr>
<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Login</th>
                <th>E-mail</th>
                <th>Equipamento(s) Vinculado(s)</th>
                <th>Cargo</th>
                <th>Operações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->login }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->equipamentos()->pluck('nome')->implode('') }}</td> {{--TODO: Relacionamento Usuario / Equipamento no Controller--}}
                    <td>{{ $user->roles()->pluck('name')->implode('') }}</td>
                    <td>
                        @hasrole('Administrador')
                            <button class="btn btn-success" type="button">Ativar</button>
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
        {!! $users->appends($dataForm)->links() !!} 
    @else
        {!! $users->links() !!} 
    @endif

</div>
@hasrole('Administrador')
    <a href="{{ route('usuarios.cadastro') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Adicionar Usuario</a>
@endhasrole

{{--Modal para vincular Equipamentos--}}
<div class="modal fade" id="vinculaEquipamento" role="dialog" aria-labelledby="vinculaEquipamentoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Vincular equipamento ao usuário</h4>
            </div>
            <div class="modal-body">
                <form id="formVincula" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="PUT">

                    @foreach($equipamentos as $equipamento)
                        <div class="checkbox-inline">
                            <label><input type="checkbox" name="equipamento[]" value="{{$equipamento->id}}">{{$equipamento->nome}}</label>
                        </div>
                    @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <input type="submit" class="btn btn-success" value="Vincular">
            </div>
        </div>
    </div>
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
            var nome = $(e.relatedTarget).attr('data-nome');
            $(this).find('.modal-title').text(`Vincular equipamento ao usuário: ${nome}`);

            var id = $(e.relatedTarget).attr('data-id');
            $(this).find('#formVincula').attr('action', `{{url('usuarios')}}/${id}`);
        });
    </script>

@endsection