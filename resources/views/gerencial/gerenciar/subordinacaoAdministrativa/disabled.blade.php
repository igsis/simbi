@extends('layouts.master')

@section('tituloPagina')
	<i class="glyphicon glyphicon-cog"></i> Subordinação Administrativas
@endsection

@section('conteudo')

	{{-- <div class="panel-heading">Página {{ $subordinacaoAdministrativas->currentPage() }} de {{ $subordinacaoAdministrativas->lastPage() }}</div> --}}

	<div class="form">
	    <form method="POST" class="form form-inline" action="{{route('searchSubordinacaoAdministrativa')}}">
	        {{ csrf_field() }}
	        <input type="text" name="descricao" class="form-control" placeholder="Descrição" title="Pesquisa pela Descrição">
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
				<th>Descrição</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			@foreach($subordinacaoAdministrativas as $subordinacaoAdministrativa)
			<tr>
				<td>{{$subordinacaoAdministrativa->descricao}}</td>
				<td>
					<button class="btn btn-success" data-toggle="modal" data-target="#ativar"
							data-id="{{$subordinacaoAdministrativa->id}}" 
							data-title="{{$subordinacaoAdministrativa->descricao}}"
							data-route="{{route('toActivateSubordinacaoAdministrativa', '')}}">
						<i class="glyphicon glyphicon-ok"></i> Ativar
					</button>					
				</td>
			</tr>
			@endforeach				
		</tbody>
		</table>
	</div>			


	<!-- Editar Sub. Administrativa -->
	<div class="modal fade" id="subordinacaoAdministrativa" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<form method="POST"> {{-- action Pelo js --}}
						{{csrf_field()}}
						<input type="hidden" name="id">
						<label>Descrição</label>
						<input class="form-control" type="text" name="descricao">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						<input type="submit" class="btn btn-success" name="novaSubordinacaoAdministrativa" value="">
					</div>
				</form>
			</div>
		</div>
	</div>
	@include('layouts.desativar')
<div class="text-center"> 
	@if(isset($dataForm))
        {!! $subordinacaoAdministrativas->appends($dataForm)->links() !!} 
    @else
        {!! $subordinacaoAdministrativas->links() !!} 
    @endif
</div>
@endsection
@section('scripts_adicionais')
    @include('scripts.desativar_modal')
@endsection