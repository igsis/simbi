@extends('layouts.master2')

@section('linksAdicionais')
	@includeIf('links.tabelas_AdminLTE')
@endsection

@section('titulo','Prefeituras Regionais')
@section('conteudo')

	<div class="content-wrapper">

		<div class="row">
			<div class="col-xs-12">
				@includeIf('layouts.erros')
			</div>
		</div>

		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1 class="page-header"><i class="glyphicon glyphicon-cog"></i> Siglas dos Equipamentos</h1>
		</section>

		<!-- Main content -->
		<section class="content">

			<!-- Default box -->
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Pesquisa de siglas dos Equipamentos</h3>
				</div>
				<div class="box-body">
					<div class="table-responsive">
						<div class="btn-tabela">
							<button class="btn btn-success" data-toggle="modal" data-target="#equipamentoSigla"><i class="glyphicon glyphicon-plus"></i> Adicionar</button>
						</div>
						<table id="tabela1" class="table table-bordered table-striped">
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
										<button class="btn btn-info mr-10" data-toggle="modal" data-target="#equipamentoSigla"
												data-id="{{$equipamentoSigla->id}}"
												data-sigla="{{$equipamentoSigla->sigla}}"
												data-descricao="{{$equipamentoSigla->descricao}}"
												data-roteiro="{{$equipamentoSigla->roteiro}}">
											<i class="glyphicon glyphicon-pencil"> </i> Editar
										</button>
										<button class="btn btn-danger" data-toggle="modal" data-target="#desativar"
												data-id="{{$equipamentoSigla->id}}"
												data-title="{{$equipamentoSigla->sigla}}"
												data-route="{{route('deleteSiglaEquipamento', '')}}">
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
									<th>Roteiro</th>
									<th>Ações</th>
								</tr>
							</tfooter>
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
				</div>
			</div>
		</section>
	</div>

@endsection
@section('scripts_adicionais')
    <script type="text/javascript">

        // Alimenta o modal com informações de cada Sigla do Equipamento
        $('#equipamentoSigla').on('show.bs.modal', function (e)
        {
        	if ($(e.relatedTarget).attr('data-id'))
        	{
	            let id = $(e.relatedTarget).attr('data-id');
	            let sigla = $(e.relatedTarget).attr('data-sigla');
	            let descricao = $(e.relatedTarget).attr('data-descricao');
	            let roteiro = $(e.relatedTarget).attr('data-roteiro');
	            $(this).find('.modal-title').text(` Editar ${descricao}`);
	            $(this).find('.modal-footer input').attr('value', 'Editar');
	            $(this).find('form input[name="id"]').attr('value', id);
	            $(this).find('form input[name="sigla"]').attr('value', sigla);
	            $(this).find('form input[name="descricao"]').attr('value', descricao);
	            $(this).find('form input[name="roteiro"]').attr('value', roteiro);
	            $(this).find('form').append(`<input type="hidden" name="_method" value="PUT">`);
	            $(this).find('form').attr('action', `{{route('editSiglaEquipamento', '')}}/${id}`);
	        }else
	        {
	        	$(this).find('.modal-title').text('Adicionar Sigla do Equipamento');
	            $(this).find('.modal-footer input').attr('value', 'Adicionar');
	            $(this).find('form input[type="text"]').attr('value', '');
	            $(this).find('form').attr('action', `{{route('createSiglaEquipamento')}}`);
	        }
        });
    </script>

    @include('scripts.desativar_modal')
	@include('scripts.tabelas_admin')

@endsection
