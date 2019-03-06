@extends('layouts.master2')

@section('linksAdicionais')
	@includeIf('links.tabelas_AdminLTE')
@endsection

@section('titulo')
	@if($type == 1)
		{{$pagina = "Equipamentos Cadastrados"}}
	@else
		{{$pagina = "Equipamentos Desativados"}}
	@endif
	{{$pagina}}
@endsection

@section('conteudo')

<div class="content-wrapper">

	<div class="row">
		<div class="col-xs-12">
			@includeIf('layouts.erros')
		</div>
	</div>

	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1 class="page-header"><i class="glyphicon glyphicon-home"></i>
			{{-- Equipamento ativo --}}
			<?= $pagina ?>
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">

		<!-- Default box -->
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Pesquisa de equipamentos</h3>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table id="tabela1" class="table table-bordered table-striped">
						<thead>
						<tr>
							<th>Nome do Equipamento</th>
							<th>Sigla do Equipamento</th>
							<th>Telefone</th>
							<th>Status</th>
							<th>Operações</th>
						</tr>
						</thead>
						<tbody>
						@foreach($equipamentos as $equipamento)
							<tr>
								<td>{{$equipamento->nome}}</td>
								<td>{{$equipamento->equipamentoSigla->sigla}}</td>
								<td>{{$equipamento->telefone}}</td>
								<td>{{$equipamento->status->descricao}}</td>
								<td>
									@hasrole('Administrador')
									<a href="{{ route('equipamentos.editar', $equipamento->id) }}" class="btn btn-info"><i class="glyphicon glyphicon-pencil"></i> Editar Equipamento</a>
									@endhasrole
									<a href="{{ route('equipamentos.show', $equipamento->id) }}" class="btn btn-warning" style="margin-right: 3px"><i class="glyphicon glyphicon-eye-open"></i> Mais Detalhes</a>
									@hasrole('Administrador')
									@if($equipamento->publicado == 1)
										<form method="POST" action="{{ route('equipamentos.destroy', $equipamento->id, $type) }}" style="display: inline;">
											{{ csrf_field() }}
											<input type="hidden" name="type" value="{{ $type }}">
											<input type="hidden" name="_method" value="DELETE">
											<button class="btn btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Desativar {{$equipamento->nome}}?" data-message='Desejar realmente desativar este Equipamento?' data-footer="Desativar"><i class="glyphicon glyphicon-trash"></i> Desativar
											</button>
										</form>
									@else
										<form method="POST" action="{{ route('ativar.equipamento') }}" style="display: inline;">
											{{ csrf_field() }}
											<input type="hidden" name="type" value="{{ $type }}">
											<input type="hidden" name="id" value="{{ $equipamento->id }}">
											<input type="hidden" name="_method" value="PUT">
											<button class="btn btn-success" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Ativar {{$equipamento->name}}?" data-message='Desejar realmente ativar este usuario?' data-footer="Ativar"><i class="glyphicon glyphicon-ok"></i> Ativar
											</button>
										</form>
									@endif
									@endhasrole
								</td>
							</tr>
						@endforeach
						@include('layouts.excluir_confirm')
						</tbody>
						<tfoot>
							<tr>
								<th>Nome do Equipamento</th>
								<th>Sigla do Equipamento</th>
								<th>Telefone</th>
								<th>Status</th>
								<th>Operações</th>
							</tr>
						</tfoot>
					</table>
				</div>
				<div class="text-center">
					@if(isset($dataForm))
						{!! $equipamentos->appends($dataForm)->links() !!}
					@else
						{!! $equipamentos->links() !!}
					@endif

				</div>
				@if($type == 1)
					<a href="{{ route('equipamentos.cadastro') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Adicionar Equipamento</a>
					<a href="{{ route('equipamentos.importar') }}" class="btn btn-info"><i class="glyphicon glyphicon-list-alt"></i> Importar do IGSIS</a>
				@endif

			</div>
		</div>
	</section>
</div>

@endsection

@section('scripts_adicionais')
    <script type="text/javascript">
    // Script Msg Excluir Equipamento
        $('#confirmDelete').on('show.bs.modal', function (e)
        {
            $message = $(e.relatedTarget).attr('data-message');
            $(this).find('.modal-body p').text($message);
            $title = $(e.relatedTarget).attr('data-title');
            $(this).find('.modal-title').text($title);
            $message = $(e.relatedTarget).attr('data-footer');
            $(this).find('.modal-footer #confirm ').text($message);
             
            // Pass form reference to modal for submission on yes/ok
            var form = $(e.relatedTarget).closest('form');
            $(this).find('.modal-footer #confirm').data('form', form);
        });
         
        // Form confirm (yes/ok) handler, submits form
        $('#confirmDelete').find('.modal-footer #confirm').on('click', function()
        {
            $(this).data('form').submit();
        });

    </script>
	@includeIf('scripts.tabelas_admin')
@endsection