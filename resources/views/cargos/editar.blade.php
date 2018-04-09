@extends('layouts.master')

@section('conteudo')

	<div class='col-lg-4 col-lg-offset-4'>
	    <h1><i class='glyphicon glyphicon-wrench'></i> Editar Cargo: {{$role->name}}</h1>
	    <hr>

	    <form method="POST" action="{{route('cargos.update', $role->id)}}">
	    	{{csrf_field()}}
	    	<input type="hidden" name="_method" value="PUT">

	    <div class="form-group">
	    	<label for="name">Nome do Cargo</label>
	    	<input class="form-control" type="text" name="name" id="name" value="{{$role->name}}">
	    </div>

	    <h5><b>Atribuir Permissões</b></h5>
	    @foreach ($permissions as $permission)
	    	<input name="permissions[]" type="checkbox" value="{{$permission->id}}">
	    	<label for="{{$permission->name}}">{{$permission->name}}</label>
	    	<br>
	    @endforeach
	    <br>

	    <input class="btn btn-primary" type="submit" value="Editar">
	</div>

@endsection
@section('scripts_adicionais')
		<script type="text/javascript">
        $(document).ready(function () {
            $('input:checkbox[name="permissions[]"][value={{$role->permissions}}]').attr('checked', true);
        });
    </script>
@endsection