@extends('layouts.master')

@section('conteudo')
<div class="container-fluid">
	<h1><i class='glyphicon glyphicon-cog'></i> Prefeituras Regionais </h1>
	<hr>
	{{-- <div class="panel-heading">Página {{ $prefeiturasRegionais->currentPage() }} de {{ $prefeiturasRegionais->lastPage() }}</div> --}}

	<div class="form">
	    <form method="POST" class="form form-inline">
	        {{ csrf_field() }}
	        <input type="text" name="descricao" class="form-control" placeholder="Descrição" title="Pesquisa pela Descrição">
	        <button class="btn btn-primary"><i class="glyphicon glyphicon-search"></i>
	        Pesquisar</button>
	    </form>
	</div><br>

	<div class="table-responsive">
	    <table class="table table-bordered table-striped ">
		<thead>
			<tr>
				<th>Descrição</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			@foreach($prefeiturasRegionais as $prefeituraRegional)
			<tr>
				<td>{{$prefeituraRegional->descricao}}</td>
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
        {!! $prefeiturasRegionais->appends($dataForm)->links() !!} 
    @else
        {!! $prefeiturasRegionais->links() !!} 
    @endif
</div>
@endsection
