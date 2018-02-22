@extends('layouts.master')

@section('conteudo')

	<div class="col-lg-4 col-lg-offset-4">
		<h1><i class="glyphicon glyphicon-user"></i>Cadastrar Usuario</h1>
		<hr>

		<form method="POST" action="{{ url('/usuarios') }}">
			{{ csrf_field() }}
			<div class="form-group">
				<label for="name">Nome</label>
				<input class="form-control" type="text" name="name" id="name">
			</div>

			<div class="form-group">
				<label for="email">Email</label>
				<input class="form-control" type="email" name="email" id="email">
			</div>

			<div class="form-group">
				<label for="roles">Cargo</label>
				<select class="form-control" name="roles" id="roles">
					@foreach ($roles as $role)
						<option value="{{$role->id}}">{{$role->name}}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group">
				<label for="password">Senha</label>
				<input class="form-control" type="password" name="password" id="password">
			</div>

			<div class="form-group">
				<label for="password">Confirmar Senha</label>
				<input class="form-control" type="password" name="password_confirmation">
			</div>

			<input class="btn btn-primary" type="submit" value="Adicionar">
		</form>

	</div>

@endsection