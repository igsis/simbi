@extends('layouts.master')

@section('conteudo')
<div class="container-fluid">
	<h1><i class='glyphicon glyphicon-cog'></i> Siglas dos Equipamentos </h1>
	<hr>
	{{-- <div class="panel-heading">Página {{ $equipamentoSiglas->currentPage() }} de {{ $equipamentoSiglas->lastPage() }}</div> --}}

	<div class="table-responsive">
	    <table class="table table-bordered table-striped ">
		<thead>
			<tr>
				<th>Sigla</th>
				<th>Descrição</th>
				<th>Roteiro</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			@foreach($equipamentoSiglas as $equipamentoSigla)
			<tr>
				<td>{{$equipamentoSigla->sigla}}</td>
				<td>{{$equipamentoSigla->descricao}}</td>
				<td>{{$equipamentoSigla->roteiro}}</td>
				<td>
					<button class="btn btn-info"><i class="glyphicon glyphicon-pencil"> </i></button>
					<button class="btn btn-danger"><i class="glyphicon glyphicon-remove"> </i></button>					
				</td>
			</tr>
			@endforeach				
		</tbody>
		</table>
	</div>			
	<button class="btn btn-success"><i class="glyphicon glyphicon-plus"></i></button> 	
</div>

@endsection
