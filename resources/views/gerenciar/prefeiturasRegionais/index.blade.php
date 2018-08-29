@extends('layouts.master')

@section('conteudo')
<div class="container-fluid">
	<h1><i class='glyphicon glyphicon-cog'></i> Prefeituras Regionais </h1>
	<hr>
	{{-- <div class="panel-heading">Página {{ $prefeiturasRegionais->currentPage() }} de {{ $prefeiturasRegionais->lastPage() }}</div> --}}

	<div class="form">
	    <form method="POST" class="form form-inline" action="{{route('searchPrefeituraRegional')}}">
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
			@foreach($prefeiturasRegionais as $prefeituraRegional)
			<tr>
				<td>{{$prefeituraRegional->descricao}}</td>
				<td>
					<button class="btn btn-info" data-toggle="modal" data-target="#prefeituraRegional"
							data-id="{{$prefeituraRegional->id}}"
							data-descricao="{{$prefeituraRegional->descricao}}">
						<i class="glyphicon glyphicon-pencil"> </i> Editar
					</button>
					<button class="btn btn-danger" data-toggle="modal" data-target="#desativar"
								data-id="{{$prefeituraRegional->id}}"
								data-title="{{$prefeituraRegional->descricao}}"
								data-route="{{route('deletePrefeituraRegional', '')}}">
						<i class="glyphicon glyphicon-remove"></i> Excluir
					</button>
				</td>
			</tr>
			@endforeach
		</tbody>
		</table>
	</div>
	{{-- Add Prefeitura Regional  --}}
	<button class="btn btn-success" data-toggle="modal" data-target="#prefeituraRegional"><i class="glyphicon glyphicon-plus"></i> Adicionar</button> 	

	<!-- Editar Prefeitura Regional -->
	<div class="modal fade" id="prefeituraRegional" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<form method="POST" > {{-- action Pelo js --}}
						{{csrf_field()}}
						<label>Descrição</label>
						<input class="form-control" type="text" name="descricao">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						<input type="submit" class="btn btn-success" name="novaPrefeituraRegional" value="">
					</div>
				</form>
			</div>
		</div>
	</div>
	@include('layouts.desativar')
</div>
<div class="text-center">
	@if(isset($dataForm))
        {!! $prefeiturasRegionais->appends($dataForm)->links() !!}
    @else
        {!! $prefeiturasRegionais->links() !!}
    @endif
</div>
@endsection
@section('scripts_adicionais')
    <script type="text/javascript">

        // Alimenta o modal com informações de cada Tipo de Serviço
        $('#prefeituraRegional').on('show.bs.modal', function (e)
        {
        	/**
        	*	Modal editar e adicionar
        	*/
        	if ($(e.relatedTarget).attr('data-id'))
        	{
	            let id = $(e.relatedTarget).attr('data-id');
	            let descricao = $(e.relatedTarget).attr('data-descricao');
	            $(this).find('.modal-title').text(` Editar ${descricao}`);
	            $(this).find('.modal-footer input').attr('value', 'Editar');
	            $(this).find('form input[name="id"]').attr('value', id);
	            $(this).find('form input[name="descricao"]').attr('value', descricao);
	            $(this).find('form').append(`<input type="hidden" name="_method" value="PUT">`);
		        $(this).find('form').attr('action', `{{route('editPrefeituraRegional', '')}}/${id}`);
		    }else
	        {
	        	$(this).find('.modal-title').text('Adicionar Prefeitura Regional');
	            $(this).find('.modal-footer input').attr('value', 'Adicionar');
	            $(this).find('form input[name="descricao"]').attr('value', '');
	            $(this).find('form').attr('action', `{{route('createPrefeituraRegional')}}`);
	        }
        });
    </script>

    @include('scripts.desativar_modal')
@endsection
