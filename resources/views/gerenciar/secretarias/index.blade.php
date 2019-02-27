@extends('layouts.master')

@section('tituloPagina')
	<i class="glyphicon glyphicon-cog"></i> Secretarias
@endsection

@section('conteudo')

	{{-- <div class="panel-heading">Página {{ $secretarias->currentPage() }} de {{ $secretarias->lastPage() }}</div> --}}

	<div class="form">
	    <form method="POST" class="form form-inline" action="{{route('searchSecretaria')}}">
	        {{ csrf_field() }}
	        <input type="text" name="sigla" class="form-control" placeholder="Sigla" title="Pesquisa pela Sigla">
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
					<button class="btn btn-info" data-toggle="modal" data-target="#secretaria"
							data-id="{{$secretaria->id}}"
							data-sigla="{{$secretaria->sigla}}"
							data-descricao="{{$secretaria->descricao}}">
						<i class="glyphicon glyphicon-pencil"> </i> Editar
					</button>
					<button class="btn btn-danger" data-toggle="modal" data-target="#desativar"
								data-id="{{$secretaria->id}}"
								data-title="{{$secretaria->sigla}}"
								data-route="{{route('deleteSecretaria', '')}}">
						<i class="glyphicon glyphicon-remove"></i> Excluir
					</button>
				</td>
			</tr>
			@endforeach
		</tbody>
		</table>
	</div>
	<button class="btn btn-success" data-toggle="modal" data-target="#secretaria"><i class="glyphicon glyphicon-plus"> Adicionar</i></button> 	

	<!-- Editar Secretaria -->
	<div class="modal fade" id="secretaria" role="dialog" aria-hidden="true">
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
						<div class="form-group">
							<label>Sigla</label>
							<input class="form-control" type="text" name="sigla">
						</div>
						<div class="form-group">
							<label for="descricao">Descrição</label>
							<input class="form-control" type="text" name="descricao">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						<input type="submit" class="btn btn-success" name="novaSecretaria" value="">
					</div>
				</form>
			</div>
		</div>
	</div>
	@include('layouts.desativar')
<div class="text-center">
	@if(isset($dataForm))
        {!! $secretarias->appends($dataForm)->links() !!}
    @else
        {!! $secretarias->links() !!}
    @endif
</div>
@endsection
@section('scripts_adicionais')
    <script type="text/javascript">

        // Alimenta o modal com informações das Secretarias
        $('#secretaria').on('show.bs.modal', function (e)
        {
        	if ($(e.relatedTarget).attr('data-id'))
        	{
	            let id = $(e.relatedTarget).attr('data-id');
	            let sigla = $(e.relatedTarget).attr('data-sigla');
	            let descricao = $(e.relatedTarget).attr('data-descricao');
	            $(this).find('.modal-title').text(` Editar ${descricao}`);
	            $(this).find('.modal-footer input').attr('value', 'Editar');
	            $(this).find('form input[name="id"]').attr('value', id);
	            $(this).find('form input[name="sigla"]').attr('value', sigla);
	            $(this).find('form input[name="descricao"]').attr('value', descricao);
	            $(this).find('form').append(`<input type="hidden" name="_method" value="PUT">`);
	            $(this).find('form').attr('action', `{{route('editSecretaria', '')}}/${id}`);
	        }else
	        {
	        	$(this).find('.modal-title').text('Adicionar Secretaria');
	            $(this).find('.modal-footer input').attr('value', 'Adicionar');
	            $(this).find('form input[type="text"]').attr('value', '');
	            $(this).find('form').attr('action', `{{route('createSecretaria')}}`);
	        }
        });
    </script>

    @include('scripts.desativar_modal')

@endsection
