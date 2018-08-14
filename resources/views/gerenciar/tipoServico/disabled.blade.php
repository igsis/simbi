@extends('layouts.master')

@section('conteudo')
<div class="container-fluid">
	<h1><i class='glyphicon glyphicon-cog'></i> Tipos de Serviços </h1>
	<hr>
	{{-- <div class="panel-heading">Página {{ $tipoServicos->currentPage() }} de {{ $tipoServicos->lastPage() }}</div> --}}
	<div class="form">
	    <form method="POST" class="form form-inline" action="{{route('searchTipoServico')}}">
	        {{ csrf_field() }}
	        <input type="text" name="cargo" class="form-control" placeholder="Cargo" title="Pesquisa pela Cargo">
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
				<th>Cargo</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			@foreach($tipoServicos as $tipoServico)
			<tr>
				<td>{{$tipoServico->cargo}}</td>
				<td>
					<button class="btn btn-success" data-toggle="modal" data-target="#ativar"
							data-id="{{$tipoServico->id}}" 
							data-title="{{$tipoServico->cargo}}"
							data-route="{{route('toActivateTipoServico', '')}}">
						<i class="glyphicon glyphicon-ok"></i>
					</button>
				</td>
			</tr>
			@endforeach				
		</tbody>
		</table>
	</div>			

	<!-- Editar Serviço -->
	<div class="modal fade" id="tipoServico" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<form method="POST"> {{-- action Pelo js --}}
						{{csrf_field()}}
						<label>Cargo</label>
						<input type="hidden" name="id">
						<input class="form-control" type="text" name="cargo">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						<input type="submit" class="btn btn-success" name="editar" value="">
					</div>
				</form>
			</div>
		</div>
	</div>
	@include('layouts.desativar')
</div>

<div class="text-center"> 
	@if(isset($dataForm))
        {!! $tipoServicos->appends($dataForm)->links() !!} 
    @else
        {!! $tipoServicos->links() !!} 
    @endif
</div>

@endsection
@section('scripts_adicionais')
    @include('scripts.desativar_modal')
@endsection

