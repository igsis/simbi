@extends('layouts.master')

@section('conteudo')

	<div class="col-lg-4 col-lg-offset-4">
		<h1><i class="glyphicon glyphicon-plus-sign"></i></h1>
		<br>

		{{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT')) }}

			<div class="form-group">
				<label for="name">Nome da Permissão</label>
				<input class="form-control" type="text" name="name" id="name">
			</div>

			<br>

			<input class="btn btn-primary" type="submit" value="Editar">

		{{ Form::close() }}
	</div>

@endsection