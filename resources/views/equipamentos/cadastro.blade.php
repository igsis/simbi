@extends ('layouts.master')

@section ('conteudo')
<div class="container">
	<center><h2>Cadastro de Equipamento</h2></center>

	<hr>
	<form method="POST" action="">
		{{ csrf_field() }}
		<div class="form-group">
			<label for="nome">Nome do Equipamento</label>
			<input type="text" class="form-control" name="nome" id="nome">
		</div>
		<div class="form-row">
			<div class="form-group col-md-3" style="padding-left: 0px">
				<label for="tipoServico">Tipo de Serviço</label>
				<input type="text" class="form-control" name="tipoServico" id="tipoServico">
			</div>
			<div class="form-group col-md-3">
				<label for="sigla">Sigla do Equipamento</label>
				<input type="text" class="form-control" name="sigla" id="sigla">
			</div>
			<div class="form-group col-md-3">
				<label for="identificacaoSecretaria">Identificação da Secretaria</label>
				<input type="text" class="form-control" name="identificacaoSecretaria" id="identificacaoSecretaria">
			</div>
			<div class="form-group col-md-3" style="padding-right: 0px">
				<label for="subordinaçãoAdministrativa">Subordinação Administrativa</label>
				<input type="text" class="form-control" name="subordinaçãoAdministrativa" id="subordinaçãoAdministrativa">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-3" style="padding-left: 0px">
				<label>Equipamento Tematico?</label><br>
				
				<input type="radio" name="tematico" value="0" checked>
				<label for=tematico style="padding:0 10px 0 5px;">Não</label>

				<input type="radio" name="tematico" value="1">
				<label for=tematico style="padding:0 10px 0 5px;">Sim</label>
			</div>
			<div class="form-group col-md-9" style="padding-right: 0px">
				<label for=nomeTematica>Nome da Tematica</label>
				<input type="text" class="form-control" name="nomeTematica" id="nomeTematica" disabled>
			</div>
		</div>
		
		<center><h3>Endereço</h3></center>
		<div class="form-group col-md-3" style="padding-left: 0px">
			<label for="cep">CEP</label>
			<input type="text" class="form-control" name="cep" id="cep" data-mask="00000-000">
		</div>
		<div class="form-group col-md-3">
			<label for="tipo">Tipo</label>
			<input type="text" class="form-control" name="tipo" id="tipo" placeholder="Rua, Avenida, etc">
		</div>
		<div class="form-group col-md-3">
			<label for="titulo">Titulo</label>
			<input type="text" class="form-control" name="titulo" id="titulo" placeholder="Doutor, Coronel, Professor, etc">
		</div>
		<div class="form-group col-md-3" style="padding-right: 0px">
			<label for="preposicao">Preposição</label>
			<input type="text" class="form-control" name="preposicao" id="preposicao" placeholder="De, Para, etc">
		</div>
		<div class="form-group col-md-3" style="padding-left: 0px">
			<label for="nomeEndereco">Nome</label>
			<input type="text" class="form-control" name="nomeEndereco" id="nomeEndereco" placeholder="São João">
		</div>
		<div class="form-group col-md-3">
			<label for="numero">Numero</label>
			<input type="text" class="form-control" name="numero" id="numero">				
		</div>
		<div class="form-group col-md-3">
			<label for="complemento">Complemento</label>
			<input type="text" class="form-control" name="complemento" id="complemento">
		</div>
		<div class="form-group col-md-3" style="padding-right: 0px">
			<label for="bairro">Bairro</label>
			<input type="text" class="form-control" name="barrio" id="bairro">
		</div>
		<div class="form-group col-md-3" style="padding-left: 0px">
			<label for="telefone">Telefone</label>
			<input type="text" class="form-control" name="telefone" id="telefone" data-mask="(11) 00000-0000">
		</div>

		<div class="form-group col-md-9" style="padding-right: 0px">
			<label for="subprefeitura">Subprefeitura</label>
			<input type="text" class="form-control" name="subprefeitura" id="subprefeitura">
		</div>
		<div class="form-group col-md-3" style="padding-left: 0px">
			<label for="distrito">Distrito</label>
			<input type="text" class="form-control" name="distrito" id="distrito">
		</div>
		
		<div class="form-group col-md-3">
			<label for="macrorregiao">Macrorregião</label>
			<select class="form-control" name="macrorregiao" id="macrorregiao">
				@foreach ($macrorregioes as $macrorregiao)
					<option value="{{$macrorregiao->idMacrorregiao}}">{{$macrorregiao->descricao}}</option>
				@endforeach
			</select>
		</div>
		
		<div class="form-group col-md-3">
			<label for="regiao">Região</label>
			<select class="form-control" name="regiao" id="regiao">
				@foreach ($regioes as $regiao)
					<option value="{{$regiao->idRegiao}}">{{$regiao->descricao}}</option>
				@endforeach
			</select>
		</div>
		
		<div class="form-group col-md-3" style="padding-right: 0px">
			<label for="regional">Regional</label>
			<select class="form-control" name="regional" id="regional">
			@foreach ($regionais as $regional)
				<option value="{{$regional->idRegional}}">{{$regional->descricao}}</option>
			@endforeach
			</select>
		</div>

		<center><h3>Horario de Funcionamento</h3></center>
		<div class="form-group">
			<div class="col-md-offset-3 col-md-8" style="padding-bottom: 15px">
				<input type="checkbox" name="domingo" id="diasemana07" value="1" /><label  style="padding:0 10px 0 5px;"> Domingo</label>
				<input type="checkbox" name="segunda" id="diasemana01" value="1"/><label style="padding:0 10px 0 5px;"> Segunda</label>
				<input type="checkbox" name="terca" id="diasemana02" value="1" /><label  style="padding:0 10px 0 5px;"> Terça</label>
				<input type="checkbox" name="quarta" id="diasemana03" value="1" /><label style="padding:0 10px 0 5px;"> Quarta</label>
				<input type="checkbox" name="quinta" id="diasemana04" value="1" /><label style="padding:0 10px 0 5px;"> Quinta</label>
				<input type="checkbox" name="sexta" id="diasemana05" value="1" /><label  style="padding:0 10px 0 5px;"> Sexta</label>
				<input type="checkbox" name="sabado" id="diasemana06" value="1" /><label style="padding:0 10px 0 5px;"> Sábado</label>
			</div>                     
		</div>
		<div class="col-md-offset-3 col-md-8">
			<div class="form-group col-md-5" style="padding-left: 0px">
				<label for="horarioAbertura">Horario de Abertura</label>
				<input type="text" class="form-control" name="horarioAbertura" id="horarioAbertura" data-mask="00:00">				
			</div>
			<div class="form-group col-md-5">
				<label for="horarioFechamento">Horario de Fechamento</label>
				<input type="text" class="form-control" name="horarioFechamento" id="horarioFechamento" data-mask="00:00">				
			</div>
		</div>
		<div class="col-md-offset-2 col-md-11">
			<div class="form-group col-md-3">
				<label for="telecentro">Possui Telecentro?</label>
				<select class="form-control" name="telecentro" id="telecentro">
					<option value="0">Não</option>
					<option value="1">Sim</option>
				</select>
			</div>
			<div class="form-group col-md-3">
				<label for="nucleobraile">Possui Nucleo Braile?</label>
				<select class="form-control" name="nucleobraile" id="nucleobraile">
					<option value="0">Não</option>
					<option value="1">Sim</option>
				</select>
			</div>
			<div class="form-group col-md-3">
				<label for="acervoespecializado">Possui Acervo Especializado?</label>
				<select class="form-control" name="acervoespecializado" id="acervoespecializado">
					<option value="0">Não</option>
					<option value="1">Sim</option>
				</select>
			</div>
		</div>
		<div class="form-group col-md-offset-5 col-md-3">
			<input type="submit" class="btn btn-primary" name="enviar" value="Enviar">
		</div>
	</form>
</div>
@endsection
@section('scripts_adicionais')
	<script type="text/javascript">
		$(document).ready(function()
		{
			$('input:radio[name="tematico"]').change(function(e)
            {
                if ($(this).val() == 0) 
                {
                	$("#nomeTematica").attr('disabled', true);
                } else
                {
                	$("#nomeTematica").attr('disabled', false);
                }
			});
		});
	</script>
@endsection