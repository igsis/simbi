@extends ('layouts.master')

@section('tituloPagina','Cadastro de Endereço')

@section ('conteudo')

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
						<option value="{{$macrorregiao->macrorregiao_id}}">{{$macrorregiao->descricao}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group col-md-2">
				<label for="regiao">Região</label>
				<select class="form-control" name="regiao" id="regiao">
					<option value="">Selecione uma Opção</option>
					@foreach ($regioes as $regiao)
						<option value="{{$regiao->regiao_id}}">{{$regiao->descricao}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group col-md-2"
			>
				<label for="regional">Regional</label>
				<select class="form-control" name="regional" id="regional">
					<option value="">Selecione uma Opção</option>
				@foreach ($regionais as $regional)
					<option value="{{$regional->regional_id}}">{{$regional->descricao}}</option>
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
@endsection
@section('scripts_adicionais')
	{{--    <script src="{{asset('AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>--}}
	@include('scripts.tabelas_admin')
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
		$(function() {
			$( ".calendario" ).datepicker({
				dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
				dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
				dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
				monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
				monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
			});
			$('.calendario').datepicker("option","showAnim","blind");
            $('.calendario').datepicker( "option", "dateFormat", "dd/mm/yy");
		});
	</script>
@endsection
@section('linksAdicionais')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection
