@extends('layouts.master')

@section('conteudo')

<h1><i class="glyphicon glyphicon-home"></i>
{{-- Equipamento ativo --}}
@if($type == 1)
	Equipamentos Cadastrados
@else 
	Equipamentos Desativados
@endif
</h1>
<div class="panel-heading">Pagina {{$equipamentos->currentPage()}} de {{$equipamentos->lastPage()}}</div>
<div class="form">
    <form action="{{ route('search-equipamento') }}" method="POST" class="form form-inline">
        {{ csrf_field() }}
        <input type="hidden" name="types" value="{{ $type }}">
        <input type="text" name="nome" class="form-control" placeholder="Nome do equipamento">
        <div class="form-group">
        	 <select class="form-control" name="status" id="status">
        	 	<option value="">-- Status --</option>
        	 	<option value="1">Ativo</option>
        	 	<option value="2">Inativo</option>
        	 	<option value="3">Fechado</option>
        	 </select>
        </div>
         <div class="form-group">
        	 <select class="form-control" name="sigla" id="sigla">
        	 	<option value="">-- Sigla --</option>
        	 	@foreach($siglas as $sigla)
					<option value="{{ $sigla->id }}">{{$sigla->sigla}}</option>
        	 	@endforeach
        	 </select>
        </div>
        {{-- <input type="text" name="email" class="form-control" placeholder="E-mail"> --}}
        <button class="btn btn-primary"><i class="glyphicon glyphicon-search"></i>
        Pesquisar</button>
    </form>
</div>
<hr>
<div class="table-responsive">
	<table class="table table-bordered table-striped">
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
							<form method="POST" action="{{ route('equipamentos.destroy', $equipamento->id) }}" style="display: inline;">
								{{ csrf_field() }}
								<input type="hidden" name="_method" value="DELETE">
								<button class="btn btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Excluir {{$equipamento->nome}}?" data-message='Desejar realmente excluir este Equipamento?'><i class="glyphicon glyphicon-trash"></i> Excluir
								</button>
							</form>
						@else
							<form method="POST" action="{{ route('ativar.equipamento') }}" style="display: inline;">
                                {{ csrf_field() }}
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
	</table>
</div>
<div class="text-center"> 
	@if(isset($dataForm))
        {!! $equipamentos->appends($dataForm)->links() !!} 
    @else
        {!! $equipamentos->links() !!} 
    @endif

</div>
<a href="{{ route('equipamentos.cadastro') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i>
Adicionar Equipamento</a>
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

@endsection