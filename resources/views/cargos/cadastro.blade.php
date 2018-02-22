@extends('layouts.master')

@section('conteudo')

<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='glyphicon glyphicon-plus-sign'></i>Adicionar Cargo</h1>
    <hr>

    <form method="POST" action="{{url('/cargos')}}" accept-charset="UTF-8">

	    <div class="form-group">
	    	<label for="name">Nome</label>
	    	<input class="form-control" type="text" name="name" id="name">
	    </div>

	    <h5><b>Atribuir Permissões</b></h5>

	    <div class='form-group'>
	        @foreach ($permissions as $permission)
	        	<input name="permissions" type="checkbox" value="{{$permission->id}}">
	        	<label for="{{$permission->name}}">{{$permission->name}}</label>
	        	<br>
	        @endforeach
	    </div>

	    <input class="btn btn-primary" type="submit" value="Adicionar">

    </form>

</div>

@endsection