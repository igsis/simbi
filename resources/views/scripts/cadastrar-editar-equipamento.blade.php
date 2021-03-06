@yield('scripts_cadastro_editar_equipamento')

<!-- Scripts para cadastrar modais sem refresh  -->
<script type="text/javascript">

    $('#addServico').submit(function(e) {
        e.preventDefault();
        let novoServico = $('#addServico input[name="novoServico"]').val();
        let _token = $('#addServico input[name="_token"]').val();
        let descricao = $('#addServico input[name="descricao"]').val();
        $.ajax({
            url: '{{route('equipamentos.index')}}', 
            type: 'POST',
            data: {'novoServico': '','_token': _token, 'descricao': descricao},
            success: function(data) {
                $("#tipoServico option").remove();
                $("#sucesso").removeAttr("hidden");
                $("#sucesso em").html("Tipo de serviço inserido com sucesso!");
                $("#tipoServico").append(`<option value=''>Selecione uma Opção</option>`);
                $('#addServico').modal('hide');
                $("#tipoServico").focus();
                for(let item of data ){
                    $("#tipoServico").append(`<option value='${item.id}'>${item.descricao}<otion>`);
                }
            },
            error: function() {
                $("#sucesso").removeAttr("hidden");
                $("#sucesso").removeClass( "alert-success");
                $("#sucesso").addClass( "alert-danger");
                $("#sucesso em").html(`Erro ao cadastrar Tipo de serviço!`);
            }
        });
        return false;
    });

    $('#addSigla').submit(function(e) {
        e.preventDefault();
        let novaSigla = $('#addSigla input[name="novaSigla"]').val();
        let _token = $('#addSigla input[name="_token"]').val();
        let sigla = $('#addSigla input[name="sigla"]').val();
        let descricao = $('#addSigla input[name="descricao"]').val();
        let roteiro = $('#addSigla input[name="roteiro"]').val();
        $.ajax({
            url: '{{route('equipamentos.index')}}', 
            type: 'POST',
            data: {
                    'novaSigla': '',
                    '_token': _token,
                    'sigla':sigla, 
                    'descricao': descricao, 
                    'roteiro': roteiro
                },
            success: function(data) {
                $("#equipamentoSigla option").remove();
                $("#sucesso").removeAttr("hidden");
                $("#sucesso em").html("Sigla do Equipamento inserida com sucesso!");
                $("#equipamentoSigla").append(`<option value=''>Selecione uma Opção</option>`);
                $('#addSigla').modal('hide');
                $("#equipamentoSigla").focus();
                for(let item of data ){
                    $("#equipamentoSigla").append(`<option value='${item.id}'>${item.sigla}<otion>`);
                }
            },
            error: function(jqXHR, textStatus, error) {
                $("#sucesso").removeAttr("hidden");
                $("#sucesso").removeClass( "alert-success");
                $("#sucesso").addClass( "alert-danger");
                $("#sucesso em").html(`Erro ao cadastrar Sigla do Equipamento!`);
                alert("Status: " + textStatus); alert("Error: " + jqXHR.responseText);
            }
        });
        return false;
    });

    $('#addSecretaria').submit(function(e) {
        e.preventDefault();
        let novaSecretaria = $("#addSecretaria input[name='novaSecretaria']").val();
        let _token = $("#addSecretaria input[name='_token']").val();
        let sigla = $("#addSecretaria input[name='sigla']").val();
        let descricao = $("#addSecretaria input[name='descricao']").val();
        $.ajax({
            url: '{{route('equipamentos.index')}}', 
            type: 'POST',
            data: {'novaSecretaria': '','_token': _token, 'sigla':sigla, 'descricao': descricao},
            success: function(data) {
                $("#identificacaoSecretaria option").remove();
                $("#sucesso").removeAttr("hidden");
                $("#sucesso em").html("Secretaria inserida com sucesso!");
                $("#identificacaoSecretaria").append(`<option value=''>Selecione uma Opção</option>`);
                $('#addSecretaria').modal('hide');
                $("#identificacaoSecretaria").focus();
                for(let item of data ){
                    $("#identificacaoSecretaria").append(`<option value='${item.id}'>${item.sigla}<otion>`);
                }
            },
            error: function() {
                $("#sucesso").removeAttr("hidden");
                $("#sucesso").removeClass( "alert-success");
                $("#sucesso").addClass( "alert-danger");
                $("#sucesso em").html(`Erro ao cadastrar Secretaria!`);
            }
        });
        return false;
    });

    $('#addSubAdmin').submit(function(e) {
        e.preventDefault();
        let novaSubordinacaoAdministrativa = $("#addSubAdmin input[name='novaSubordinacaoAdministrativa']").val();
        let _token = $("#addSubAdmin input[name='_token']").val();
        let descricao = $("#addSubAdmin input[name='descricao']").val();
        $.ajax({
            url: '{{route('equipamentos.index')}}', 
            type: 'POST',
            data: {'novaSubordinacaoAdministrativa': '','_token': _token, 'descricao': descricao},
            success: function(data) {
                $("#subordinacaoAdministrativa option").remove();
                $("#sucesso").removeAttr("hidden");
                $("#sucesso em").html("Subordinacao Administrativa inserida com sucesso!");
                $("#subordinacaoAdministrativa").append(`<option value=''>Selecione uma Opção</option>`);
                $('#addSubAdmin').modal('hide');
                for(let item of data ){
                    $("#subordinacaoAdministrativa").append(`<option value='${item.id}'>${item.descricao}<otion>`);
                }
                $("#subordinacaoAdministrativa").focus();
            },
            error: function() {
                $("#sucesso").removeAttr("hidden");
                $("#sucesso").removeClass( "alert-success");
                $("#sucesso").addClass( "alert-danger");
                $("#sucesso em").html(`Erro ao cadastrar Subordinacao Administrativa!`);
            }
        });
        return false;
    });

    $('#addPrefeituraRegional').submit(function(e) {
        e.preventDefault();
        let novaPrefeituraRegional = $("#addPrefeituraRegional input[name='novaPrefeituraRegional']").val();
        let _token = $("#addPrefeituraRegional input[name='_token']").val();
        let descricao = $("#addPrefeituraRegional input[name='descricao']").val();
        $.ajax({
            url: '{{route('equipamentos.index')}}', 
            type: 'POST',
            data: {'novaPrefeituraRegional': '','_token': _token, 'descricao': descricao},
            success: function(data) {
                $("#prefeituraRegional option").remove();
                $("#sucesso").removeAttr("hidden");
                $("#sucesso em").html("Subprefeitura inserida com sucesso!");
                $("#prefeituraRegional").append(`<option value=''>Selecione uma Opção</option>`);
                $('#addPrefeituraRegional').modal('hide');
                for(let item of data ){
                    $("#prefeituraRegional").append(`<option value='${item.id}'>${item.descricao}<otion>`);
                }
                $("#prefeituraRegional").focus();
            },
            error: function() {
                $("#sucesso").removeAttr("hidden");
                $("#sucesso").removeClass( "alert-success");
                $("#sucesso").addClass( "alert-danger");
                $("#sucesso em").html(`Erro ao cadastrar Subprefeitura!`);
            }
        });
        return false;
    });

    $('#addDistrito').submit(function(e) {
        e.preventDefault();
        let novoDistrito = $("#addDistrito input[name='novoDistrito']").val();
        let _token = $("#addDistrito input[name='_token']").val();
        let descricao = $("#addDistrito input[name='descricao']").val();
        $.ajax({
            url: '{{route('equipamentos.index')}}', 
            type: 'POST',
            data: {'novoDistrito': '','_token': _token, 'descricao': descricao},
            success: function(data) {
                $("#distrito option").remove();
                $("#sucesso").removeAttr("hidden");
                $("#sucesso em").html("Distrito inserido com sucesso!");
                $("#distrito").append(`<option value=''>Selecione uma Opção</option>`);
                $('#addDistrito').modal('hide');
                for(let item of data ){
                    $("#distrito").append(`<option value='${item.id}'>${item.descricao}<otion>`);
                }
                $("#distrito").focus();
            },
            error: function() {
                $("#sucesso").removeAttr("hidden");
                $("#sucesso").removeClass( "alert-success");
                $("#sucesso").addClass( "alert-danger");
                $("#sucesso em").html(`Erro ao cadastrar Distrito inserido!`);
            }
        });
        return false;
    });
</script>

<script type="text/javascript">
    //Script habilita campo Nome Tematica
    let radio = $("input[name='tematico']:checked").val();
    if(radio == 0){
        $("#nome_tematica").attr('disabled', true);
    }else{
        $("#nome_tematica").attr('disabled', false);
    }
    $(document).ready(function()
    {
        $('input:radio[name="tematico"]').change(function(e)
        {
            if ($(this).val() == 0)
            {
                $("#nome_tematica").attr('disabled', true);
                $("#nome_tematica").attr('placeholder', '');
                $("#nome_tematica").attr('value', '');
            } else
            {
                $("#nome_tematica").attr('disabled', false);
                $("#nome_tematica").attr('placeholder', 'Insira o nome da Temática');
                $("#nome_tematica").attr('required', true);
            }
        });
    });
</script>

<script type="text/javascript">

    let status = $("#status option:selected").val();
    if(status == '' || status == '1' ){
        $("#observacao").attr('disabled', true);
    }else{
        $("#observacao").attr('disabled', false);
    }
    $(document).ready(function()
    {
        $('select[name="status"]').change(function(e)
        {
            if ($(this).val() == 0 || $(this).val() == 1)
            {
                $("#observacao").attr('disabled', true);
                $("#observacao").attr('placeholder', '');
                $("input[name='observacao']").val('');
            } else if($(this).val() == 2 )
            {
                $("#observacao").attr('disabled', false);
                $("#observacao").attr('placeholder', 'Por que está Inativo?');
                $("#observacao").attr('required', true);
            }
            else if($(this).val() == 3 )
            {
                $("#observacao").attr('disabled', false);
                $("#observacao").attr('placeholder', 'Por que está Fechado?');
                $("#observacao").attr('required', true);
            }
        });
    });
</script>

<script type="text/javascript" >
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
</script>