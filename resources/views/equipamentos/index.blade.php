@extends('layouts.master')

@section('conteudo')

<h1><i class="glyphicon glyphicon-home"></i> Equipamentos Cadastrados</h1>
<div class="panel-heading">Pagina {{$equipamentos->currentPage()}} de {{$equipamentos->lastPage()}}</div>
<div class="form">
    <form action="" method="POST" class="form form-inline">
        {{ csrf_field() }}
        <input type="text" name="name" class="form-control" placeholder="Nome do equipamento">
        <div class="form-group">
        	 <select class="form-control" name="status" id="status">
        	 	<option value="">-- Status --</option>
        	 	<option value="">Ativo</option>
        	 	<option value="">Fechado</option>
        	 	<option value="">Inativo</option>
        	 </select>
        </div>
         <div class="form-group">
        	 <select class="form-control" name="status" id="status">
        	 	<option value="">-- Sigla --</option>
        	 	<option value="">glo</option>
        	 	<option value="">ssp</option>
        	 </select>
        </div>
        {{-- <input type="text" name="email" class="form-control" placeholder="E-mail"> --}}
        <button class="btn btn-primary">Pesquisar</button>
    </form>
</div>
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
					<td>{{$equipamento->equipamentoSigla->sigla}}</td>
					<td>{{$equipamento->telefone}}</td>
					<td>{{$equipamento->status->descricao}}</td>
					<td>
						<a href="{{ route('equipamentos.show', $equipamento->id) }}" class="btn btn-info pull-left" style="margin-right: 3px">Mais Detalhes</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
<div class="text-center"> {!! $equipamentos->links() !!} </div>
<a href="{{ route('equipamentos.cadastro') }}" class="btn btn-success">Adicionar Equipamento</a>

@endsection