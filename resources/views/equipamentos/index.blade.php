@extends('layouts.master')

@section('conteudo')

<h1><i class="glyphicon glyphicon-home"></i> Equipamentos Cadastrados</h1>
<div class="panel-heading">Pagina {{$equipamentos->currentPage()}} de {{$equipamentos->lastPage()}}</div>
<hr>

<div class="table-responsive">
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>Nome do Equipamento</th>
				<th>Sigla do Equipamento</th>
				<th>Telefone</th>
				<th>Status</th>
				<th>Operações</th>
			</tr>
		</thead>
		<tbody>
			@foreach($equipamentos as $equipamento)
				<tr>
					<td>{{$equipamento->nome}}</td>
					<td>{{$equipamento->idSiglaEquipamento}}</td>
					<td>{{$equipamento->telefone}}</td>
					<td>{{$equipamento->idStatusEquipamento}}</td>
					<td>
						<a href="{{ route('equipamentos.detalhes', $equipamento->id) }}" class="btn btn-info pull-left" style="margin-right: 3px">Mais Detalhes</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
<div class="text-center"> {!! $equipamentos->links() !!} </div>
<a href="{{ route('equipamentos.cadastro') }}" class="btn btn-success">Adicionar Equipamento</a>

@endsection