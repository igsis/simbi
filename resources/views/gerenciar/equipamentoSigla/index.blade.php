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
					<button class="btn btn-info" data-toggle="modal" data-target="#editar"
							data-id="{{$equipamentoSigla->id}}" 
							data-sigla="{{$equipamentoSigla->sigla}}" 
							data-descricao="{{$equipamentoSigla->descricao}}" 
							data-roteiro="{{$equipamentoSigla->roteiro}}">
						<i class="glyphicon glyphicon-pencil"> </i>
					</button>
					<button class="btn btn-danger"><i class="glyphicon glyphicon-remove"> </i></button>					
				</td>
			</tr>
			@endforeach				
		</tbody>
		</table>
	</div>			
	<button class="btn btn-success"><i class="glyphicon glyphicon-plus"></i></button> 	

	<!-- Editar Sigla -->
	<div class="modal fade" id="editar" role="dialog" aria-hidden="true">
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
						<input type="submit" class="btn btn-success" name="novaSigla" value="Editar">
					</div>
				</form>
			</div>
		</div>
	</div>

</div>
<div class="text-center"> 
	@if(isset($dataForm))
        {!! $equipamentoSiglas->appends($dataForm)->links() !!} 
    @else
        {!! $equipamentoSiglas->links() !!} 
    @endif
</div>

@endsection
@section('scripts_adicionais')
    <script type="text/javascript">

        // Alimenta o modal com informações de cada Sigla do Equipamento
        $('#editar').on('show.bs.modal', function (e)
        {
        	if ($(e.relatedTarget).attr('data-id')) 
        	{
	            let id = $(e.relatedTarget).attr('data-id');
	            let sigla = $(e.relatedTarget).attr('data-sigla');
	            let descricao = $(e.relatedTarget).attr('data-descricao');
	            let roteiro = $(e.relatedTarget).attr('data-roteiro');
	            $(this).find('.modal-title').text(` Editar ${descricao}`);
	            $(this).find('form input[name="id"]').attr('value', id);
	            $(this).find('form input[name="sigla"]').attr('value', sigla);
	            $(this).find('form input[name="descricao"]').attr('value', descricao);
	            $(this).find('form input[name="roteiro"]').attr('value', roteiro);
	            $(this).find('form').append(`<input type="hidden" name="_method" value="PUT">`);
	            $(this).find('form').attr('action', `{{route('editSiglaEquipamento', '')}}/${id}`);
	        }else
	        {
	        	
	        }
        });
    </script>

@endsection