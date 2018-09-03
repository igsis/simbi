@extends('layouts.master')

@section('conteudo')
<div class="container-fluid">
	<h1><i class='glyphicon glyphicon-cog'></i> Tipos de Serviços </h1>
	<hr>
	{{-- <div class="panel-heading">Página {{ $tipoServicos->currentPage() }} de {{ $tipoServicos->lastPage() }}</div> --}}
	<div class="form">
	    <form method="POST" class="form form-inline" action="{{route('searchTipoServico')}}">
	        {{ csrf_field() }}
	        <input type="text" name="descricao" class="form-control" placeholder="Descrição" title="Pesquisa pela Descrição">
	        <select name="publicado" class="form-control">
	        	<option value="1">Selecione</option>
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
				<th width="50%">Descrição</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			@foreach($tipoServicos as $tipoServico)
			<tr>
				<td>{{$tipoServico->descricao}}</td>
				<td>
					<button class="btn btn-info" data-toggle="modal" data-target="#tipoServico"
							data-id="{{$tipoServico->id}}"
							data-descricao="{{$tipoServico->descricao}}">
						<i class="glyphicon glyphicon-pencil"> </i> Editar
					</button>
						<button class="btn btn-danger" data-toggle="modal" data-target="#desativar"
								data-id="{{$tipoServico->id}}"
								data-title="{{$tipoServico->descricao}}"
								data-route="{{route('deleteTipoServico', '')}}">
							<i class="glyphicon glyphicon-remove"></i> Excluir
						</button>
				</td>
			</tr>
			@endforeach
		</tbody>
		</table>
	</div>
	<button class="btn btn-success" data-toggle="modal" data-target="#tipoServico"><i class="glyphicon glyphicon-plus"></i> Adicionar</button> 

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
						<label>Descrição</label>
						<input type="hidden" name="id">
						<input class="form-control" type="text" name="descricao">
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
    <script type="text/javascript">

        // Alimenta o modal com informações de cada Tipo de Serviço
        $('#tipoServico').on('show.bs.modal', function (e)
        {
        	if ($(e.relatedTarget).attr('data-id'))
        	{
	            let id = $(e.relatedTarget).attr('data-id');
	            let descricao = $(e.relatedTarget).attr('data-descricao');
	            $(this).find('.modal-title').text(` Editar ${descricao}`);
	            $(this).find('.modal-footer input').attr('value', 'Editar');
	            $(this).find('form input[name="id"]').attr('value', id);
	            $(this).find('form input[name="descricao"]').attr('value', descricao);
	            $(this).find('form').append(`<input type="hidden" name="_method" value="PUT">`);
		        $(this).find('form').attr('action', `{{route('editTipoServico', '')}}/${id}`);
			}else
	        {
	        	$(this).find('.modal-title').text('Adicionar Tipo de Serviço');
	            $(this).find('.modal-footer input').attr('value', 'Adicionar');
	            $(this).find('form input[type="text"]').attr('value', '');
	            $(this).find('form').attr('action', `{{route('createTipoServico')}}`);
	        }
        });

    </script>

    @include('scripts.desativar_modal')

@endsection
