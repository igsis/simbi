@extends('layouts.master2')

@section('linksAdicionais')
	@includeIf('links.tabelas_AdminLTE')
@endsection

@section('titulo','Secretarias')

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
				<i class="glyphicon glyphicon-cog"></i> Secretarias
			</h1>
		</section>

		<!-- Main content -->
		<section class="content">

			<!-- Default box -->
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Pesquisa de secretaria</h3>
				</div>
				<div class="box-body">

					<div class="table-responsive">
						<div class="btn-tabela">
							<button class="btn btn-success" data-toggle="modal" data-target="#secretaria"><i class="glyphicon glyphicon-plus"></i> Adicionar</button>
						</div>
						<table id="tabela1" class="table table-bordered table-striped ">
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
							<tfooter>
								<tr>
									<th>Sigla</th>
									<th>Descrição</th>
									<th>Ações</th>
								</tr>
							</tfooter>
						</table>
					</div>

				</div>
			</div>
		</section>



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
								<input class="form-control" type="text" name="sigla" maxlength="6">
							</div>
							<div class="form-group">
								<label for="descricao">Descrição</label>
								<input class="form-control" type="text" name="descricao">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
								<input type="submit" class="btn btn-success" name="novaSecretaria" value="Adicionar">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		@include('layouts.desativar')

	</div>

	<!-- fim codigo novo -->

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

	@include('scripts.tabelas_admin')
    @include('scripts.desativar_modal')

@endsection
