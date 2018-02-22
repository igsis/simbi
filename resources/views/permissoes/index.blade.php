@extends('layouts.master')

@section('conteudo')

	<div class="col-lg-10 col-lg-offset-1">
		<h1><i class="glyphicon glyphicon-wrench"></i>Permissões Disponiveis</h1>
		<hr>

		<div class="table-responsive">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Permissões</th>
						<th>Operações</th>
					</tr>
				</thead>
				<tbody>
					@foreach($permissions as $permission)
						<tr>
							<td>{{$permission->name}}</td>
							<td>
								<a href="{{ URL::to('permissoes/'.$permission->id.'/editar') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Editar</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<a href="{{ URL::to('permissoes/cadastro') }}" class="btn btn-success">Adicionar Permissão</a>
	</div>

@endsection