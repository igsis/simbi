@extends ('layouts.master')

@section ('conteudo')
	<div class="container">
		<div style="text-align: center;">
			<h2>
				Edição do Equipamento<br>
				<small>{{$equipamento->nome}}</small>
			</h2>
		</div>
		<hr>

		<form method="POST" action="{{ url('equipamentos', [$equipamento->id]) }}">
			{{ csrf_field() }}

			<div class="row">
				<div class="form-group">
					<label for="nome">Nome do Equipamento</label>
					<input type="text" class="form-control" name="nome" id="nome" value="{{ $equipamento->nome }}">
				</div>
			</div>

			<div class="row">
				<div class="form-group col-md-3" style="padding-left: 0px">
					<label for="tipoServico">Tipo de Serviço</label>
					<select class="form-control" name="tipoServico" id="tipoServico">
						<option value="">Selecione uma Opção</option>
						@foreach ($tipoServicos as $tipoServico)
							<option value="{{$tipoServico->id}}">{{$tipoServico->descricao}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group col-md-3">
					<label for="equipamentoSigla">Sigla do Equipamento</label>
					<select class="form-control" name="equipamentoSigla" id="equipamentoSigla">
						<option value="">Selecione uma Opção</option>
						@foreach ($siglas as $sigla)
							<option value="{{$sigla->id}}">{{$sigla->sigla}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group col-md-3">
					<label for="identificacaoSecretaria">Identificação da Secretaria</label>
					<select class="form-control" name="identificacaoSecretaria" id="identificacaoSecretaria">
						<option value="">Selecione uma Opção</option>
						@foreach ($secretarias as $secretaria)
							<option value="{{$secretaria->id}}">{{$secretaria->sigla}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group col-md-3" style="padding-right: 0px">
					<label for="subordinacaoAdministrativa">Subordinação Administrativa</label>
					<select class="form-control" name="subordinacaoAdministrativa" id="subordinacaoAdministrativa">
						<option value="">Selecione uma Opção</option>
						@foreach ($subordinacoesAdministrativas as $subordinacaoAdministrativa)
							<option value="{{$subordinacaoAdministrativa->id}}">{{$subordinacaoAdministrativa->descricao}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="row">
				<div class="col-md-3" style="padding-left: 0px">
					<button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#addServico">Adicionar Serviço</button>
				</div>
				<div class="col-md-3">
					<button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#addSigla">Adicionar Sigla</button>
				</div>
				<div class="col-md-3">
					<button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#addSecretaria">Adicionar Secretaria</button>
				</div>
				<div class="col-md-3" style="padding-right: 0px">
					<button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#addSubAdmin">Adicionar Sub. Administrativa</button>
				</div>
			</div>

			<div class="row" style="padding-top: 10px;">
				<div class="form-group col-md-3" style="padding-left: 0px">
					<label>Equipamento Tematico?</label><br>

					<input type="radio" name="tematico" value="0" checked>
					<label for=tematico style="padding:0 10px 0 5px;">Não</label>

					<input type="radio" name="tematico" value="1">
					<label for=tematico style="padding:0 10px 0 5px;">Sim</label>
				</div>
				<div class="form-group col-md-6">
					<label for=nomeTematica>Nome da Tematica</label>
					<input type="text" class="form-control" name="nomeTematica" id="nomeTematica" value="{{$equipamento->nomeTematica}}" disabled>
				</div>
				<div class="form-group col-md-3" style="padding-right: 0px">
					<label for="telefone">Telefone</label>
					<input type="text" class="form-control" name="telefone" id="telefone" data-mask="(11) 0000-0000" placeholder="(11) xxxx-xxxx" value="{{ $equipamento->telefone }}">
				</div>
			</div>

			<div style="text-align: center;"><h2>Endereço</h2></div>
			<hr>

			<div class="row">
				<div class="form-group col-md-2" style="padding-left: 0px">
					<label for="cep">CEP</label>
					<input type="text" class="form-control" name="cep" id="cep" data-mask="00000-000" placeholder="xxxxx-xxx" value="{{ $equipamento->endereco->cep }}">
				</div>
				<div class="form-group col-md-3">
					<label for="logradouro">Logradouro</label>
					<input type="text" class="form-control" name="logradouro" id="logradouro" value="{{$equipamento->endereco->logradouro}}" readonly>
				</div>
				<div class="form-group col-md-3">
					<label for="bairro">Bairro</label>
					<input type="text" class="form-control" name="bairro" id="bairro" value="{{$equipamento->endereco->bairro}}" readonly>
				</div>

				<div class="form-group col-md-2">
					<label for="numero">Número</label>
					<input type="text" class="form-control" name="numero" id="numero" value="{{$equipamento->endereco->numero}}">
				</div>
				<div class="form-group col-md-2" style="padding-right: 0px">
					<label for="complemento">Complemento</label>
					<input type="text" class="form-control" name="complemento" id="complemento" value="{{$equipamento->endereco->complemento}}">
				</div>
			</div>

			<div class="row">
				<div class="form-group col-md-2" style="padding-left: 0px">
					<label for="cidade">Cidade</label>
					<input type="text" class="form-control" name="cidade" id="cidade" value="{{$equipamento->endereco->cidade}}" readonly>
				</div>
				<div class="form-group col-md-1">
					<label for="uf">UF</label>
					<input type="text" class="form-control" name="uf" id="uf" value="{{$equipamento->endereco->estado}}" readonly>
				</div>
				<div class="form-group col-md-3">
					<label for="macrorregiao">Macrorregião</label>
					<select class="form-control" name="macrorregiao" id="macrorregiao">
						<option value="">Selecione uma Opção</option>
						@foreach ($macrorregioes as $macrorregiao)
							<option value="{{$macrorregiao->id}}">{{$macrorregiao->descricao}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group col-md-3">
					<label for="regiao">Região</label>
					<select class="form-control" name="regiao" id="regiao">
						<option value="">Selecione uma Opção</option>
						@foreach ($regioes as $regiao)
							<option value="{{$regiao->id}}">{{$regiao->descricao}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group col-md-3">
					<label for="regional">Regional</label>
					<select class="form-control" name="regional" id="regional">
						<option value="">Selecione uma Opção</option>
						@foreach ($regionais as $regional)
							<option value="{{$regional->id}}">{{$regional->descricao}}</option>
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

			{{-- <div class="form-row">
                <center><h3>Horario de Funcionamento</h3></center>
            </div>
            <div class="row">
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
            </div>

            <div class="row">
                <div class="form-group col-md-offset-3 col-md-3">
                    <label for="horarioAbertura">Horario de Abertura</label>
                    <input type="text" class="form-control" name="horarioAbertura" id="horarioAbertura" data-mask="00:00">
                </div>
                <div class="form-group col-md-3">
                    <label for="horarioFechamento">Horario de Fechamento</label>
                    <input type="text" class="form-control" name="horarioFechamento" id="horarioFechamento" data-mask="00:00">
                </div>
            </div> --}}

			<div class="row" style="padding-top: 10px">
				<div class="form-group col-md-offset-2 col-md-2">
					<label for="telecentro">Possui Telecentro?</label>
					<select class="form-control" name="telecentro" id="telecentro">
						<option value="0">Não</option>
						<option value="1">Sim</option>
					</select>
				</div>
				<div class="form-group col-md-2">
					<label for="nucleobraile">Possui Nucleo Braile?</label>
					<select class="form-control" name="nucleobraile" id="nucleobraile">
						<option value="0">Não</option>
						<option value="1">Sim</option>
					</select>
				</div>
				<div class="form-group col-md-2">
					<label for="acervoespecializado">Acervo Especializado?</label>
					<select class="form-control" name="acervoespecializado" id="acervoespecializado">
						<option value="0">Não</option>
						<option value="1">Sim</option>
					</select>
				</div>
				<div class="form-group col-md-2">
					<label for="status">Status do Equipamento</label>
					<select class="form-control" name="status" id="status">
						<option value="">Selecione uma Opção</option>
						@foreach ($status as $stats)
							<option value="{{$stats->id}}">{{$stats->descricao}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group col-md-offset-5 col-md-2">
				<input type="submit" class="form-control btn btn-primary" name="enviar" value="Cadastrar">
			</div>
		</form>
		@include('layouts.equipamento_modal')
	</div>
@endsection
@section('scripts_adicionais')
	<script type="text/javascript">
        //Script habilita campo Nome Tematica
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

        //Script CEP
        $(document).ready(function() {
            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#logradouro").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
            }

            //Quando o campo cep perde o foco.
            $("#cep").blur(function () {
                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if (validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#logradouro").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#logradouro").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                            }
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    }
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                }
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });

        // Script resgata valor comboBox e Radio Buttons
        $(document).ready(function () {
            $('input:radio[name="tematico"][value={{$equipamento->tematico}}]').attr('checked', true);
            $('#tipoServico').val("{{$equipamento->tipoServico->id}}");
            $('#equipamentoSigla').val("{{$equipamento->equipamentoSigla->id}}");
            $('#identificacaoSecretaria').val("{{$equipamento->secretaria->id}}");
            $('#subordinacaoAdministrativa').val("{{$equipamento->subordinacaoAdministrativa->id}}");
            $('#macrorregiao').val("{{$equipamento->endereco->macrorregiao->id}}");
            $('#regiao').val("{{$equipamento->endereco->regiao->id}}");
            $('#regional').val("{{$equipamento->endereco->regional->id}}");
            $('#telecentro').val("{{$equipamento->telecentro}}");
            $('#acervoespecializado').val("{{$equipamento->acervoEspecializado}}");
            $('#nucleobraile').val("{{$equipamento->nucleoBraile}}");
            $('#status').val("{{$equipamento->status->id}}");
        });
	</script>
@endsection