<script type="text/javascript">


    function quantidadeDeOcorrencias()
    {
         let id = $('#ocorrencia').attr('data-id');
         $.ajax({
            url: `{{route('ocorrencias.count', '')}}/${id}`,
            type: 'GET',
            data: {
                '_token': '{{csrf_field()}}'
            },
            success: function(data) {
                $('#totalOcorrencia b').html(data);
            },
            error: function(request, status, erro) {

            }
        });
        
    }

    quantidadeDeOcorrencias()


    $('#addOcorrencia').on('show.bs.modal', function (e)
    {
        let idEquipamento = $(e.relatedTarget).attr('data-id');
        $(this).find('form input[name="idEquipamento"]').attr('value', idEquipamento);
    });

   
    $('#addOcorrencia').submit(function(e) {
        e.preventDefault();
        let _token = $('#addOcorrencia input[name="_token"]').val();
        let data = $('#addOcorrencia input[name="data"]').val();
        let ocorrencia = $('#addOcorrencia input[name="ocorrencia"]').val();
        let observacao = $('#addOcorrencia input[name="observacao"]').val();
        let idEquipamento = $('#addOcorrencia input[name="idEquipamento"]').val();
        $.ajax({
            url: '{{route('equipamento.ocorrencia')}}',
            type: 'POST',
            data: {
                '_token':               _token, 
                'data':                 data, 
                'ocorrencia':           ocorrencia, 
                'observacao': observacao, 
                'idEquipamento':        idEquipamento
            },
            success: function(data) {
                
                $("#sucesso").removeAttr("hidden");
                $("#sucesso").removeClass("alert-danger");
                $("#sucesso").addClass( "alert-success");
                $("#sucesso em").html("Ocorrência inserida com sucesso!");
                
                $('#addOcorrencia').modal('hide');
                quantidadeDeOcorrencias();
            },
            error: function(request, status, erro) {
                $("#sucesso").removeAttr("hidden");
                $("#sucesso").removeClass("alert-success");
                $("#sucesso").addClass( "alert-danger");
                $("#sucesso em").html(`${request}, ${status}, ${erro}`);
                $('#addOcorrencia').modal('hide');
            }
        });
        return false;
    });
</script>