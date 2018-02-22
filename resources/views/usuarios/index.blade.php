@extends('layouts.master')

@section('conteudo')

<h1><i class="glyphicon glyphicon-user"></i>Usuarios Cadastrados</h1>
		<hr>
	<div class="table-responsive">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Email</th>
					<th>Data/Hora Criação</th>
					<th>Cargo</th>
					<th>Operações</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($users as $user)
					<tr>
						<td>{{ $user->name }}</td>
						<td>{{ $user->email }}</td>
						<td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
						<td>{{ $user->roles()->pluck('name')->implode(' ') }}</td>
						<td>
							<a href="{{ route('usuarios.editar', $user->id) }}" class="btn btn-info pull-left" style="margin-right: 3px">Editar</a>
							@can('Administrador')
								<form method="POST" action="{{ route('usuarios.destroy', $user->id) }}" style="display: inline;">
							        <input type="hidden" name="_token" value="{{ csrf_token() }}">
							        <input type="hidden" name="_method" value="DELETE">
									<button class="btn btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Excluir {{$user->name}}?" data-message='Desejar realmente excluir este usuario?'>Excluir
									</button>
						        </form>
							@endcan
						</td>
					</tr>
				@endforeach
								@include('layouts.excluir_confirm')
			</tbody>
		</table>
	</div>
<a href="{{ route('usuarios.cadastro') }}" class="btn btn-success">Adicionar Usuario</a>
@endsection

@section('script_delete')
<!-- Script Msg Excluir Usuario -->
    <script type="text/javascript">
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
    </script>
@endsection