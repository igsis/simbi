@extends('layouts.master')

@section('conteudo')

	<div class='col-lg-4 col-lg-offset-4'>
	    <h1><i class='glyphicon glyphicon-lock'></i> Cadastrar Pergunta de Seurança </h1>
	    <hr>

	    <form method="POST" action="">
	    	
	    	<input type="hidden" name="_method" value="">

		    <div class="form-group">
		    	<label for="name" class="">Selecione a Pergunta</label>
		    	<select name="" id="" class="form-control">
		    		{{-- <option value=""></option> --}}
		    	</select>
		    </div>
		    <div class="form-group">
		    	<label for="name">Resposta</label>
		    	<input class="form-control" type="text" name="name" id="name" value="" placeholder="Resposta da pergunta selecionada">
		    </div>

		    <input class="btn btn-primary" type="submit" value="Salvar">
		</form>
	</div>

@endsection
