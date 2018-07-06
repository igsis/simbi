@extends('layouts.master')

@section('conteudo')
<div class="container-fluid">
	<h1><i class='glyphicon glyphicon-cog'></i> Siglas dos Equipamentos </h1>
	<hr>
	{{-- <div class="panel-heading">Página {{ $equipamentoSiglas->currentPage() }} de {{ $equipamentoSiglas->lastPage() }}</div> --}}

	<div class="form">
	    <form method="POST" class="form form-inline">
	        {{ csrf_field() }}
	        <input type="text" name="sigla" class="form-control" placeholder="Sigla" title="Pesquisa pela Sigla">
	        <input type="text" name="descricao" class="form-control" placeholder="Descrição" title="Pesquisa pela Descrição">
	        <input type="text" name="roteiro" class="form-control" placeholder="Roteiro" title="Pesquisa pelo Roteiro">
	        <button class="btn btn-primary"><i class="glyphicon glyphicon-search"></i>
	        Pesquisar</button>
	    </form>
	</div><br>

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
<div class="text-center"> 
	@if(isset($dataForm))
        {!! $equipamentoSiglas->appends($dataForm)->links() !!} 
    @else
        {!! $equipamentoSiglas->links() !!} 
    @endif
</div>

@endsection
