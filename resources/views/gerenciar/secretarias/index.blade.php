@extends('layouts.master')

@section('conteudo')
<div class="container-fluid">
<div class="container-fluid">
	<h1><i class='glyphicon glyphicon-cog'></i> Secretarias </h1>
	<hr>
	{{-- <div class="panel-heading">Página {{ $secretarias->currentPage() }} de {{ $secretarias->lastPage() }}</div> --}}

	<div class="form">
	    <form method="POST" class="form form-inline">
	        {{ csrf_field() }}
	        <input type="text" name="sigla" class="form-control" placeholder="Sigla" title="Pesquisa pela Sigla">
	        <input type="text" name="descricao" class="form-control" placeholder="Descrição" title="Pesquisa pela Descrição">
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
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			@foreach($secretarias as $secretaria)
			<tr>
				<td>{{$secretaria->sigla}}</td>
				<td>{{$secretaria->descricao}}</td>
				<td>
					<button class="btn btn-info" data-toggle="modal" data-target="#editar" 
							data-id="{{$secretaria->id}}"
							data-sigla="{{$secretaria->sigla}}"
							data-descricao="{{$secretaria->descricao}}">
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

	<!-- Editar Secretaria -->
	<div class="modal fade" id="editar" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<form method="POST" action="">
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
						<input type="submit" class="btn btn-success" name="novaSecretaria" value="Editar">
					</div>
				</form>
			</div>
		</div>
	</div>

</div>
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
        $('#editar').on('show.bs.modal', function (e)
        {
            let id = $(e.relatedTarget).attr('data-id');
            let sigla = $(e.relatedTarget).attr('data-sigla');
            let descricao = $(e.relatedTarget).attr('data-descricao');
            $(this).find('.modal-title').text(` Editar ${descricao}`);
            $(this).find('form input[name="id"]').attr('value', id);
            $(this).find('form input[name="sigla"]').attr('value', sigla);
            $(this).find('form input[name="descricao"]').attr('value', descricao);
        });
    </script>

@endsection