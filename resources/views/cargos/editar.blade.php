@extends('layouts.master')

@section('conteudo')

	<div class='col-lg-4 col-lg-offset-4'>
	    <h1><i class='glyphicon glyphicon-wrench'></i> Editar Cargo: {{$role->name}}</h1>
	    <hr>

	    {{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT')) }}

	    <div class="form-group">
	    	<label for="name">Nome do Cargo</label>
	    	<input class="form-control" type="text" name="name" id="name">
	    </div>

	    <h5><b>Atribuir Permissões</b></h5>
	    @foreach ($permissions as $permission)
	    	<input name="permission" type="checkbox" value="{{$permission->id}}">
	    	<label for="{{$permission->name}}">{{$permission->name}}</label>
	    	<br>
	    @endforeach
	    <br>

	    <input class="btn btn-primary" type="submit" value="Editar">

	    {{ Form::close() }}    
	</div>

@endsection