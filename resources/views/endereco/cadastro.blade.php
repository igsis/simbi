@extends ('layouts.master')

@section ('conteudo')
<div class="container">
	<center><h2>Cadastro de Endereço</h2></center>
	<hr>

	<form method="POST" action="{{ route('equipamentos.index') }}">
		{{ csrf_field() }}
		<div class="row">
			<div class="form-group col-md-2" style="padding-left: 0px">
				<label for="cep">CEP</label>
				<input type="text" class="form-control" name="cep" id="cep" data-mask="00000-000" placeholder="xxxxx-xxx">
			</div>
			<div class="form-group col-md-3">
				<label for="logradouro">Logradouro</label>
				<input type="text" class="form-control" name="logradouro" id="logradouro">
			</div>
			<div class="form-group col-md-3">
				<label for="bairro">Bairro</label>
				<input type="text" class="form-control" name="bairro" id="bairro">
			</div>
			<div class="form-group col-md-2">
				<label for="numero">Número</label>
				<input type="text" class="form-control" name="numero" id="numero">
			</div>
			<div class="form-group col-md-2" style="padding-right: 0px">
				<label for="complemento">Complemento</label>
				<input type="text" class="form-control" name="complemento" id="complemento">
			</div>
		</div>

		<div class="row">
			<div class="form-group col-md-offset-3 col-md-3">
				<label for="cidade">Cidade</label>
				<input type="text" class="form-control" name="cidade" id="cidade">
			</div>
			<div class="form-group col-md-3">
				<label for="uf">UF</label>
				<input type="text" class="form-control" name="uf" id="uf">				
			</div>
		</div>

		<div class="row">
			<div class="form-group col-md-offset-3 col-md-2">
				<label for="macrorregiao">Macrorregião</label>
				<select class="form-control" name="macrorregiao" id="macrorregiao">
					<option value="">Selecione uma Opção</option>
					@foreach ($macrorregioes as $macrorregiao)
						<option value="{{$macrorregiao->idMacrorregiao}}">{{$macrorregiao->descricao}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group col-md-2">
				<label for="regiao">Região</label>
				<select class="form-control" name="regiao" id="regiao">
					<option value="">Selecione uma Opção</option>
					@foreach ($regioes as $regiao)
						<option value="{{$regiao->idRegiao}}">{{$regiao->descricao}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group col-md-2"
			>
				<label for="regional">Regional</label>
				<select class="form-control" name="regional" id="regional">
					<option value="">Selecione uma Opção</option>
				@foreach ($regionais as $regional)
					<option value="{{$regional->idRegional}}">{{$regional->descricao}}</option>
				@endforeach
				</select>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-md-offset-3 col-md-3">
				<label for="subprefeitura">Subprefeitura</label>
				<input type="text" class="form-control" name="subprefeitura" id="subprefeitura">
			</div>
			<div class="form-group col-md-3">
				<label for="distrito">Distrito</label>
				<input type="text" class="form-control" name="distrito" id="distrito">
			</div>
		</div>

		<div class="row">
			<div class="col-md-offset-3 col-md-3">
				<button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#addSubprefeitura">Adicionar Subprefeitura</button>
			</div>
			<div class="col-md-3">
				<button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#addDistrito">Adicionar Distrito</button>
			</div>
		</div>
		<div class="form-group col-md-offset-5 col-md-2" style="padding-top: 10px">
			<input type="submit" class="form-control btn btn-primary" name="enviar" value="Enviar">
		</div>
	</form>
	@include('layouts.equipamento_modal')
</div>
@endsection