@extends('layouts.master2')

@section('linksAdicionais')
	@includeIf('links.tabelas_AdminLTE')
@endsection

@section('titulo','Distritos')

@section('conteudo')

	<div class="content-wrapper">

		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1 class="page-header">
				<i class='glyphicon glyphicon-cog'></i> Distritos
			</h1>
		</section>

		<!-- Main content -->
		<section class="content">

			<!-- Default box -->
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Pesquisa de Distrito</h3>
				</div>
				<div class="box-body">

					<div class="table-responsive">
						<div class="btn-tabela">
							<button class="btn btn-success" data-toggle="modal" data-target="#distrito"><i class="glyphicon glyphicon-plus"></i> Adicionar</button>
						</div>
						<table id="tabela1" class="table table-bordered table-striped">
							<thead>
							<tr>
								<th width="50%">Descrição</th>
								<th>Ações</th>
							</tr>
							</thead>
							<tbody>
							@foreach($distritos as $distrito)
								<tr>
									<td>{{$distrito->descricao}}</td>
									<td>
										<button class="btn btn-info mr-10" data-toggle="modal" data-target="#distrito"
												data-id="{{$distrito->id}}"
												data-descricao="{{$distrito->descricao}}">
											<i class="glyphicon glyphicon-pencil"> </i> Editar
										</button>
										<button class="btn btn-danger" data-toggle="modal" data-target="#desativar"
												data-id="{{$distrito->id}}"
												data-title="{{$distrito->descricao}}"
												data-route="{{route('deleteDistrito', '')}}">
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

					<!-- Editar Distrito -->
					<div class="modal fade" id="distrito" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h4 class="modal-title"></h4>
								</div>
								<div class="modal-body">
									<form method="POST"> {{-- action Pelo js --}}
										{{ csrf_field() }}
										<label>Descrição</label>
										<input class="form-control" type="text" name="descricao">
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
									<input type="submit" class="btn btn-success" name="novoDistrito" value="">
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
        $('#distrito').on('show.bs.modal', function (e)
        {
        	if ($(e.relatedTarget).attr('data-id'))
        	{
	            let id = $(e.relatedTarget).attr('data-id');
	            let descricao = $(e.relatedTarget).attr('data-descricao');
	            $(this).find('.modal-title').text(` Editar ${descricao}`);
	            $(this).find('.modal-footer input').attr('value', 'Editar');
	            $(this).find('form input[name="descricao"]').attr('value', descricao);
	            $(this).find('form').append(`<input type="hidden" name="_method" value="PUT">`)
            	$(this).find('form').attr('action', `{{route('editDistrito', '')}}/${id}`);
            }else
            {
            	$(this).find('.modal-title').text('Adicionar Distrito');
	            $(this).find('.modal-footer input').attr('value', 'Adicionar');
	            $(this).find('form input[type="text"]').attr('value', '');
	            $(this).find('form').attr('action', `{{route('createDistrito')}}`);
            }
        });
    </script>

    @include('scripts.desativar_modal')

	@include('scripts.tabelas_admin')
@endsection
