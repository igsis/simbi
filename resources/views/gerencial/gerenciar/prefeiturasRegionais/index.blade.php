@extends('layouts.master2')

@section('linksAdicionais')
	@includeIf('links.tabelas_AdminLTE')
@endsection

@section('titulo','Subprefeituras')

@section('conteudo')

	<div class="content-wrapper">

		<div class="row">
			<div class="col-xs-12">
				@includeIf('layouts.erros')
			</div>
		</div>

		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1 class="page-header">
				<i class="glyphicon glyphicon-cog"></i> Subprefeituras
			</h1>
		</section>

		<!-- Main content -->
		<section class="content">

			<!-- Default box -->
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Pesquisa de Subprefeituras</h3>
				</div>
				<div class="box-body">
					<div class="table-responsive">
						<div class="btn-tabela">
							{{-- Add Subprefeitura --}}
							<button class="btn btn-success" data-toggle="modal" data-target="#prefeituraRegional"><i class="glyphicon glyphicon-plus"></i> Adicionar</button>
						</div>
						<table id="tabela1" class="table table-bordered table-striped">
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
							<tfooter>
								<tr>
									<th width="50%">Descrição</th>
									<th>Ações</th>
								</tr>
							</tfooter>
						</table>
					</div>

					<!-- Editar Subprefeitura -->
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
			</div>
		</section>
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
	        	$(this).find('.modal-title').text('Adicionar Subprefeitura');
	            $(this).find('.modal-footer input').attr('value', 'Adicionar');
	            $(this).find('form input[name="descricao"]').attr('value', '');
	            $(this).find('form').attr('action', `{{route('createPrefeituraRegional')}}`);
	        }
        });
    </script>

    @include('scripts.desativar_modal')
	@include('scripts.tabelas_admin')
@endsection
