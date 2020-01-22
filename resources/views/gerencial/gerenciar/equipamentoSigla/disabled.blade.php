@extends('layouts.master')
@section('tituloPagina')
	<i class="glyphicon glyphicon-cog"></i> Siglas dos Equipamentos
@endsection

@section('conteudo')

	{{-- <div class="panel-heading">Página {{ $equipamentoSiglas->currentPage() }} de {{ $equipamentoSiglas->lastPage() }}</div> --}}

	<div class="form">
	    <form method="POST" class="form form-inline" action="{{route('searchSiglaEquipamento')}}">
	        {{ csrf_field() }}
	        <input type="text" name="sigla" class="form-control" placeholder="Sigla" title="Pesquisa pela Sigla">
	        <input type="text" name="descricao" class="form-control" placeholder="Descrição" title="Pesquisa pela Descrição">
	        <input type="text" name="roteiro" class="form-control" placeholder="Roteiro" title="Pesquisa pelo Roteiro">
	        <select name="publicado" class="form-control">
	        	<option value="0">Selecione</option>
	        	<option value="1">Ativo</option>
	        	<option value="0">Desativado</option>
	        </select>
	        <button class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
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
					<button class="btn btn-success" data-toggle="modal" data-target="#ativar"
							data-id="{{$equipamentoSigla->id}}" 
							data-title="{{$equipamentoSigla->sigla}}"
							data-route="{{route('toActivateSiglaEquipamento', '')}}">
						<i class="glyphicon glyphicon-ok"></i> Ativar
					</button>					
				</td>
			</tr>
			@endforeach				
		</tbody>
		</table>
	</div>			 	

	<!-- Editar Sigla -->
	<div class="modal fade" id="equipamentoSigla" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<form method="POST" > {{-- action Pelo js --}}
						{{csrf_field()}}
						<div class="form-group">
							<label>Sigla</label>
							<input class="form-control" type="text" name="sigla">
						</div>
						<div class="form-group">
							<label>Descrição</label>
							<input class="form-control" type="text" name="descricao">
						</div>
						<div class="form-group">
							<label>Roteiro</label>
							<input class="form-control" type="text" name="roteiro">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						<input type="submit" class="btn btn-success" name="novaSigla" value="">
					</div>
				</form>
			</div>
		</div>
	</div>
	@include('layouts.desativar')
<div class="text-center"> 
	@if(isset($dataForm))
        {!! $equipamentoSiglas->appends($dataForm)->links() !!} 
    @else
        {!! $equipamentoSiglas->links() !!} 
    @endif
</div>

@endsection
@section('scripts_adicionais')
    @include('scripts.desativar_modal')
@endsection