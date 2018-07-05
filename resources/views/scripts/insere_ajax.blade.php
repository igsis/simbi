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
                $("#sucesso").removeClass("alert-danger");
                $("#sucesso").addClass( "alert-success");
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
                $("#sucesso").removeClass("alert-success");
                $("#sucesso").addClass( "alert-danger");
                $("#sucesso em").html(`Erro ao cadastrar Tipo de serviço! Verifique se o campo já foi cadastrado!`);
                $('#addServico').modal('hide');
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
                $("#sucesso").removeClass("alert-danger");
                $("#sucesso").addClass( "alert-success");
                $("#sucesso em").html("Sigla do Equipamento inserida com sucesso!");
                $("#equipamentoSigla").append(`<option value=''>Selecione uma Opção</option>`);
                $('#addSigla').modal('hide');
                $("#equipamentoSigla").focus();
                for(let item of data ){
                    $("#equipamentoSigla").append(`<option value='${item.id}'>${item.sigla}<otion>`);
                }
            },
            error: function() {
                $("#sucesso").removeAttr("hidden");
                $("#sucesso").removeClass("alert-success");
                $("#sucesso").addClass("alert-danger");
                $("#sucesso em").html(`Erro ao cadastrar Sigla do Equipamento! Verifique se o campo já foi cadastrado!`);
                $('#addSigla').modal('hide');
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
                $("#sucesso").removeClass("alert-danger");
                $("#sucesso").addClass( "alert-success");
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
                $("#sucesso").removeClass("alert-success");
                $("#sucesso").addClass("alert-danger");
                $("#sucesso em").html(`Erro ao cadastrar Secretaria! Verifique se o campo já foi cadastrado!`);
                $('#addSecretaria').modal('hide');
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
                $("#sucesso").removeClass("alert-danger");
                $("#sucesso").addClass("alert-success");
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
                $("#sucesso").removeClass("alert-success");
                $("#sucesso").addClass("alert-danger");
                $("#sucesso em").html(`Erro ao cadastrar Subordinacao Administrativa! Verifique se o campo já foi cadastrado!`);
                $('#addSubAdmin').modal('hide');
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
                $("#sucesso").removeClass("alert-danger");
                $("#sucesso").addClass( "alert-success");
                $("#sucesso em").html("Prefeitura Regional inserida com sucesso!");
                $("#prefeituraRegional").append(`<option value=''>Selecione uma Opção</option>`);
                $('#addPrefeituraRegional').modal('hide');
                $("#prefeituraRegional").focus();
                for(let item of data ){
                    $("#prefeituraRegional").append(`<option value='${item.id}'>${item.descricao}<otion>`);
                }
            },
            error: function() {
                $("#sucesso").removeAttr("hidden");
                $("#sucesso").removeClass("alert-success");
                $("#sucesso").addClass("alert-danger");
                $("#sucesso em").html(`Erro ao cadastrar Prefeitura Regional! Verifique se o campo já foi cadastrado!`);
                $('#addPrefeituraRegional').modal('hide');
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
                $("#sucesso").removeClass("alert-danger");
                $("#sucesso").addClass( "alert-success");
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
                $("#sucesso").removeClass("alert-success");
                $("#sucesso").addClass("alert-danger");
                $("#sucesso em").html(`Erro ao cadastrar Distrito inserido! Verifique se o campo já foi cadastrado!`);
                $('#addDistrito').modal('hide');
            }
        });
        return false;
    });
</script>