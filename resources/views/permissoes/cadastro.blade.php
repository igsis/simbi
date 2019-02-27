@extends('layouts.master')

@section('tituloPagina','<i class="glyphicon glyphicon-plus-sign"></i>Adicionar Permissão')

@section('conteudo')

	<div class="col-lg-4 col-lg-offset-4">
		<form method="POST" action="{{ url('/permissoes') }}" accept-charset="UTF-8">
			<div class="form-group">
				<label for="name">Nome</label>
				<input class="form-control" type="text" name="name" id="name">
			</div>
			
			<br>

			@if(!$roles->isEmpty())
				<h4>Adicionar permissão ao Cargo: </h4>
				@foreach($roles as $role)
					<input name="roles" type="checkbox" value="{{$role->id}}">
					<label for="{{$role->name}}">{{$role->name}}</label>
				@endforeach
			@endif

			<br>

			<input class="btn btn-primary" type="submit" value="Adicionar">
		</form>
	</div>

@endsection