<script type="text/javascript">

   
    $('#addOcorrencia').submit(function(e) {
        e.preventDefault();
        let _token = $('#addOcorrencia input[name="_token"]').val();
        let data = $('#addOcorrencia input[name="data"]').val();
        let ocorrencia = $('#addOcorrencia input[name="ocorrencia"]').val();
        let observacaoOcorrencia = $('#addOcorrencia input[name="observacaoOcorrencia"]').val();
        let idEquipamento = $(e.relatedTarget).attr('data-id');
        $.ajax({
            url: '{{route('equipamento.ocorrencia')}}',
            type: 'POST',
            data: {
                '_token':               _token, 
                'data':                 data, 
                'ocorrencia':           ocorrencia, 
                'observacaoOcorrencia': observacaoOcorrencia, 
                'idEquipamento':        idEquipamento
            },
            success: function(data) {
                $("#tipoServicoblaaaaaaaaaa option").remove();
                $("#sucesso").removeAttr("hidden");
                $("#sucesso").removeClass("alert-danger");
                $("#sucesso").addClass( "alert-success");
                $("#sucesso em").html("Tipo de serviço inserido com sucesso!");
                $("#tipoServicoblaaaaaaaaaa").append(`<option value=''>Selecione uma Opção</option>`);
                $('#addOcorrencia').modal('hide');
                $("#tipoServicoblaaaaaaaaaa").focus();
                for(let item of data ){
                    $("#tipoServicoblaaaaaaaaaa").append(`<option value='${item.id}'>${item.descricao}<otion>`);
                }
            },
            error: function() {
                $("#sucesso").removeAttr("hidden");
                $("#sucesso").removeClass("alert-success");
                $("#sucesso").addClass( "alert-danger");
                $("#sucesso em").html(`Erro ao cadastrar Tipo de serviço! Verifique se o campo já foi cadastrado!`);
                $('#addOcorrencia').modal('hide');
            }
        });
        return false;
    });
</script>