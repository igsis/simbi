@extends('layouts.master')

@section('conteudo')

	<div class='col-lg-4 col-lg-offset-4'>
	    <h1><i class='glyphicon glyphicon-lock'></i> Cadastrar Pergunta de Segurança </h1>
	    <hr>

	    <form method="POST" action="{{ route('seguranca') }}">
	    	{{ csrf_field() }}

		    <div class="form-group has-feedback {{ $errors->has('perguntaSeguranca') ? ' has-error' : '' }}">
		    	<label for="name" class="">Selecione a Pergunta</label>
		    	<select name="perguntaSeguranca" id="" class="form-control">
		    		<option value=""></option>
		    		@foreach($perguntas as $pergunta)
		    			<option value="{{$pergunta->id}}">{{$pergunta->pergunta_seguranca}}</option>
		    		@endforeach
		    	</select>
		    </div>
		    <div class="form-group has-feedback {{ $errors->has('respostaSeguranca') ? ' has-error' : '' }}">
		    	<label for="name">Resposta</label>
		    	<input class="form-control" type="text" name="respostaSeguranca" id="name" placeholder="Resposta da pergunta selecionada">
		    </div>

		    <input class="btn btn-primary" type="submit" value="Salvar">
		</form>
	</div>

@endsection
