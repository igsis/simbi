@extends('layouts.master')

@section('conteudo')
<div class="container-fluid">
<div class="container-fluid">
	<h1><i class='glyphicon glyphicon-cog'></i> Secretarias </h1>
	<hr>
	{{-- <div class="panel-heading">Página {{ $secretarias->currentPage() }} de {{ $secretarias->lastPage() }}</div> --}}

	<div class="form">
	    <form method="POST" class="form form-inline">
	        {{ csrf_field() }}
	        <input type="text" name="sigla" class="form-control" placeholder="Sigla" title="Pesquisa pela Sigla">
	        <input type="text" name="descricao" class="form-control" placeholder="Descrição" title="Pesquisa pela Descrição">
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
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			@foreach($secretarias as $secretaria)
			<tr>
				<td>{{$secretaria->sigla}}</td>
				<td>{{$secretaria->descricao}}</td>
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
        {!! $secretarias->appends($dataForm)->links() !!} 
    @else
        {!! $secretarias->links() !!} 
    @endif
</div>
@endsection
