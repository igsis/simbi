<script type="text/javascript">
    //preenche os campos dos detalhes do equipamento

    $(document).ready(function () {
        $('#contratoUso').val("{{$equipamento->detalhe->contratoUso->id}}");
        $('#utilizacao').val("{{$equipamento->detalhe->utilizacao->id}}");
        $('#porte').val("{{$equipamento->detalhe->porte->id}}");
        $('#padrao').val("{{$equipamento->detalhe->padrao->id}}");
        $('#acessibilidadeArquitetonica').val("{{$equipamento->detalhe->acessibilidade->acessibilidadeArquitetonica->id}}");
        $('#banheiros').val("{{$equipamento->detalhe->acessibilidade->banheiros_adaptados}}");
        $('#rampas').val("{{$equipamento->detalhe->acessibilidade->rampas_acesso}}");
        $('#elevador').val("{{$equipamento->detalhe->acessibilidade->elevador_id}}");
        $('#pisoTatil').val("{{$equipamento->detalhe->acessibilidade->piso_tatil}}");
        $('#estacionamentoAcessivel').val("{{$equipamento->detalhe->acessibilidade->estacionamento_acessivel}}");
    });

</script>